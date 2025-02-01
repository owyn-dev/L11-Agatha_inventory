<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Production;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public $title = 'Dashboard';

    public $text_subtitle = 'Get an overview of the latest data and information';

    public $currentMonth;

    public $currentYear;

    public $totalUsers = 0;

    public $totalProducts = 0;

    public $totalTransactions = 0;

    public $latestSales;

    public $latestProductions;

    public $salesChartData;

    public $productionChartData;

    public function mount()
    {
        $this->currentMonth = Carbon::createFromDate(2023, 8, 1)->month;
        $this->currentYear = Carbon::createFromDate(2023, 8, 1)->year;

        $this->loadDashboardData();
    }

    public function render()
    {
        $this->dispatch('contentLoaded');

        return view('livewire.dashboard');
    }

    public function loadDashboardData()
    {
        $months = collect([
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0,
        ]);

        $this->totalProducts = Product::count();

        $this->totalTransactions = Sale::whereMonth('transaction_date', $this->currentMonth)
            ->whereYear('transaction_date', $this->currentYear)
            ->count();

        $this->totalUsers = User::count();

        $this->latestSales = Sale::with('salesUser')
            ->withCount('detailSales')
            ->whereMonth('transaction_date', $this->currentMonth)
            ->whereYear('transaction_date', $this->currentYear)
            ->latest('transaction_date')
            ->take(5)
            ->get();

        $this->latestProductions = Production::with('inventoryUser')
            ->withCount('detailProductions')
            ->whereMonth('production_date', $this->currentMonth)
            ->whereYear('production_date', $this->currentYear)
            ->latest('production_date')
            ->take(5)
            ->get();

        $salesData = Sale::selectRaw("DATE_FORMAT(transaction_date, '%b') as month, SUM(total_amount) as total")
            ->whereYear('transaction_date', $this->currentYear)
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(month, '%b')")
            ->pluck('total', 'month');

        $this->salesChartData = $months->merge($salesData);

        $productionData = Production::selectRaw("DATE_FORMAT(production_date, '%b') as month, COUNT(id) as total")
            ->whereYear('production_date', $this->currentYear)
            ->groupBy('month')
            ->orderByRaw("STR_TO_DATE(month, '%b')")
            ->pluck('total', 'month');

        $this->productionChartData = $months->merge($productionData);

        $this->dispatch('updateChart', [
            'sales' => $this->salesChartData,
            'production' => $this->productionChartData,
        ]);
    }
}
