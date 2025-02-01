<?php

namespace App\Livewire;

use App\Models\DetailSales;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Livewire\Component;

class PriorityAnalysis extends Component
{
    public $title = 'Priority Analysis';

    public $text_subtitle = 'Product Priority Analysis Makes it Easier for You to Make Decisions';

    public $date_start;

    public $date_end;

    public $search = '';

    public $sortField = 'total_percentage';

    public $sortDirection = 'desc';

    public $results = [];

    public function mount()
    {
        $this->loadResults();
    }

    public function render()
    {
        return view('livewire.priority-analysis');
    }

    public function updatedSearch()
    {
        $this->loadResults();
    }

    public function loadResults()
    {
        $query = DetailSales::whereHas('sales', function ($query) {
            $query->whereBetween('transaction_date', [$this->date_start, $this->date_end]);
        })
            ->selectRaw('product_id, SUM(quantity) as total_sold, SUM(sub_total) as total_sales')
            ->groupBy('product_id');

        // Menambahkan filter pencarian jika ada
        if ($this->search) {
            $query->whereHas('product', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('code', 'like', '%'.$this->search.'%')
                    ->orWhere('variant', 'like', '%'.$this->search.'%');
            });
        }

        $salesData = $query->get();

        $totalQuantity = $salesData->sum('total_sold');
        $totalSales = $salesData->sum('total_sales');

        $this->results = $salesData->map(function ($item) use ($totalQuantity, $totalSales) {
            $product = Product::find($item->product_id);
            $percentageQuantity = ($totalQuantity > 0) ? ($item->total_sold / $totalQuantity) * 100 : 0;
            $percentageSales = ($totalSales > 0) ? ($item->total_sales / $totalSales) * 100 : 0;
            $totalPercentage = $percentageQuantity + $percentageSales;

            $classification = 'C';
            $badgeClass = 'badge bg-danger';
            if ($totalPercentage >= 51) {
                $classification = 'A';
                $badgeClass = 'badge bg-success';
            } elseif ($totalPercentage >= 31) {
                $classification = 'B';
                $badgeClass = 'badge bg-warning';
            }

            return [
                'code' => $product->code,
                'product' => $product->name,
                'variant' => $product->variant->label(),
                'percentage_quantity' => round($percentageQuantity, 2),
                'percentage_sales' => round($percentageSales, 2),
                'total_percentage' => round($totalPercentage, 2),
                'classification' => $classification,
                'badge_class' => $badgeClass,
            ];
        });

        $this->sortResults();
    }

    public function sortResults()
    {
        $this->results = collect($this->results)->sortBy([
            [$this->sortField, $this->sortDirection],
        ])->values()->all();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->sortResults();
    }

    public function exportPdf()
    {
        $data = [
            'title' => $this->title,
            'text_subtitle' => $this->text_subtitle,
            'results' => $this->results,
        ];

        $pdf = Pdf::loadView('livewire.priority-analysis-export', $data)->setPaper('a4', 'landscape');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'priority-analysis-'.Str::slug(now()).'.pdf');
    }
}
