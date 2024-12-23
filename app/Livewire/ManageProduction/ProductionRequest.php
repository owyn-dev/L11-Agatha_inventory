<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Production Request List')]
class ProductionRequest extends Component {

    public $title = "Production Request List";
    public $text_subtitle = "Production Request List is used to display, manage, and monitor production data in the system";

    public function render() {
        return view('livewire.manage-production.production-request');
    }
}
