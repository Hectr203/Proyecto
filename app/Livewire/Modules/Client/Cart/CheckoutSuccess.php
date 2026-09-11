<?php

namespace App\Livewire\Modules\Client\Cart;

use Livewire\Component;
use App\Core\Checkout\Models\Order;
use App\Core\Checkout\Models\OrderDetail;
use App\Core\Catalog\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class CheckoutSuccess extends Component
{
    public $orderFolio = '';

    public function mount()
    {
        $sessionId = request()->query('session_id');
        
        if (!$sessionId) {
            return redirect()->route('store');
        }

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                $cart = session()->get('cart', []);
                if (empty($cart)) {
                    // Order probably already processed (page reload)
                    return;
                }

                $email = session()->get('checkout_email', $session->customer_details->email ?? 'cliente@tienda.com');
                
                $subtotalMxn = 0;
                foreach ($cart as $item) {
                    $subtotalMxn += $item['precio_mxn'] * $item['quantity'];
                }
                $ivaMxn = $subtotalMxn * 0.16;
                $totalMxn = $subtotalMxn + $ivaMxn;

                DB::beginTransaction();
                
                $order = Order::create([
                    'folio' => 'ORD-' . strtoupper(uniqid()),
                    'correo' => $email,
                    'subtotal' => $subtotalMxn,
                    'impuestos' => $ivaMxn,
                    'total' => $totalMxn,
                    'estatus' => 'pagado',
                    'fecha' => now()
                ]);

                $this->orderFolio = $order->folio;

                foreach ($cart as $productId => $item) {
                    OrderDetail::create([
                        'pedido_id' => $order->id,
                        'producto_id' => $productId,
                        'cantidad' => $item['quantity'],
                        'precio_usd' => $item['precio_usd'] ?? 0,
                        'precio_mxn' => $item['precio_mxn'],
                    ]);

                    $product = Product::find($productId);
                    if ($product) {
                        $product->decrement('stock', $item['quantity']);
                    }
                }

                DB::commit();
                session()->forget('cart');
                session()->forget('checkout_email');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Stripe Success Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('modules.Client.Cart.pages.checkout-success');
    }
}
