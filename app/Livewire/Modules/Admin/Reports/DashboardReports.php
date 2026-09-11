<?php

namespace App\Livewire\Modules\Admin\Reports;

use Livewire\Component;
use App\Core\Checkout\Models\Order;
use App\Core\Catalog\Models\Product;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class DashboardReports extends Component
{
    public $dateRange = 'all';

    public function render()
    {
        $query = Order::query();

        if ($this->dateRange === 'month') {
            $query->whereMonth('fecha', now()->month);
        } elseif ($this->dateRange === 'week') {
            $query->whereBetween('fecha', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->dateRange === 'today') {
            $query->whereDate('fecha', now()->toDateString());
        }

        $orders = $query->with('orderDetails.product')->latest('fecha')->get();
        $totalEarnings = $orders->sum('total');

        // Top 3 productos (se podría optimizar con una query más avanzada)
        $topProducts = \App\Core\Checkout\Models\OrderDetail::selectRaw('producto_id, SUM(cantidad) as total_vendido')
            ->groupBy('producto_id')
            ->orderByDesc('total_vendido')
            ->take(3)
            ->with('product')
            ->get();

        // Preparar datos para la gráfica (Agrupamos por fecha)
        // Obtenemos solo la fecha (Y-m-d) para agrupar
        $chartData = $orders->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->fecha)->format('Y-m-d');
        })->map(function ($row) {
            return $row->sum('total');
        });

        return view('modules.Admin.Reports.pages.index', [
            'orders' => $orders,
            'totalEarnings' => $totalEarnings,
            'topProducts' => $topProducts,
            'chartLabels' => $chartData->keys()->toJson(),
            'chartValues' => $chartData->values()->toJson()
        ]);
    }
}
