<?php

namespace App\Livewire\ManageProduction;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Production Request ')]
class ProductionRequestCreate extends Component
{
    public $title = 'Create Production Request';

    public $text_subtitle = 'This page displays for create data production.';

    public function render()
    {
        return view('livewire.manage-production.production-request-create');
    }
}
