<?php

namespace App\Livewire\ManageSales;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Sales')]
class SalesCreate extends Component
{
    public $title = 'Create Sales';

    public $text_subtitle = 'This page displays for create data sales.';

    public function render()
    {
        return view('livewire.manage-sales.sales-create');
    }
}
