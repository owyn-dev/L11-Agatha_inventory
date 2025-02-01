<?php

namespace App\Livewire\ManageSales;

use App\Models\Sale;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Show Sales')]
class SalesShow extends Component
{
    public $title = 'Show Sales';

    public $text_subtitle = 'This page displays details of sales data.';

    #[Locked]
    public Sale $sales;

    public function mount(Sale $sales)
    {
        $this->sales = $sales->with('detailSales', 'detailSales.product', 'salesUser')->find($sales->id);
    }

    public function render()
    {
        return view('livewire.manage-sales.sales-show');
    }
}
