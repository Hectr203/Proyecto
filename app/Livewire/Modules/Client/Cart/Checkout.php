<?php

namespace App\Livewire\Modules\Client\Cart;

use Livewire\Component;
use App\Core\Checkout\Models\Order;
use App\Core\Checkout\Models\OrderDetail;
use App\Core\Catalog\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Core\Catalog\Services\ExchangeRateService;

class Checkout extends Component
{
    public $cart = [];
    public $email = '';
    
    public $subtotalMxn = 0;
    public $ivaMxn = 0;
    public $totalMxn = 0;
    
    public $totalUsd = 0;
    public $exchangeRate = 20.00;

    public $paymentStatus = null;
    
    public function mount()
    {
        $this->cart = session()->get('cart', []);
        if(empty($this->cart)) {
            return redirect('/');
        }

        // Si el usuario dijo "con la sesion de login", verificamos:
        if(auth()->check()) {
            $this->email = auth()->user()->email;
        }
        
        $this->exchangeRate = ExchangeRateService::getUsdToMxnRate();
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotalMxn = 0;
        foreach ($this->cart as $item) {
            $this->subtotalMxn += $item['precio_mxn'] * $item['quantity'];
        }
        
        $this->ivaMxn = $this->subtotalMxn * 0.16;
        $this->totalMxn = $this->subtotalMxn + $this->ivaMxn;
        $this->totalUsd = $this->totalMxn / $this->exchangeRate;
    }

    public function processPayment()
    {
        $this->validate([
            'email' => 'required|email'
        ]);

        if (empty($this->cart)) {
            return redirect()->route('store');
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $line_items = [];
        foreach ($this->cart as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'mxn',
                    'product_data' => [
                        'name' => $item['nombre'],
                    ],
                    'unit_amount' => (int) round($item['precio_mxn'] * 100),
                ],
                'quantity' => $item['quantity'],
            ];
        }

        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout'),
                'customer_email' => $this->email,
            ]);

            // Guardamos el email en sesión para poder asignarlo al pedido si se necesita
            session()->put('checkout_email', $this->email);

            return redirect($checkout_session->url);
        } catch (\Exception $e) {
            $this->paymentStatus = 'error';
            // Log::error($e->getMessage());
        }
    }

    public function render()
    {
        return view('modules.Client.Cart.pages.checkout')->layout('components.layouts.app');
    }
}
