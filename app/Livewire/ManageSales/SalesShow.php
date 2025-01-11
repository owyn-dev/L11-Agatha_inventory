<?php

namespace App\Livewire\ManageSales;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Show Sales')]
class SalesShow extends Component
{
    public $title = 'Show Sales';

    public $text_subtitle = 'This page displays details of sales data.';

    public function render()
    {
        return view('livewire.manage-sales.sales-show');
    }
}
