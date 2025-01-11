<?php

namespace App\Livewire\ManageProduction;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Production Report')]
class ProductionReport extends Component
{
    public $title = 'Production Report';

    public $text_subtitle = 'Generate Production Reports instantly';

    public function render()
    {
        return view('livewire.manage-production.production-report');
    }
}
