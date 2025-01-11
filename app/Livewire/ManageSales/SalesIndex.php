<?php

namespace App\Livewire\ManageSales;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sales List')]
class SalesIndex extends Component
{
    public $title = 'Sales List';

    public $text_subtitle = 'Sales List is used to display, manage, and monitor sales data in the system';

    public function render()
    {
        return view('livewire.manage-sales.sales-index');
    }
}
