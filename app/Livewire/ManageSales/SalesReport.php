<?php

namespace App\Livewire\ManageSales;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sales Report')]
class SalesReport extends Component
{
    public $title = 'Sales Report';

    public $text_subtitle = 'Generate Sales Reports instantly';

    public function render()
    {
        return view('livewire.manage-sales.sales-report');
    }
}
