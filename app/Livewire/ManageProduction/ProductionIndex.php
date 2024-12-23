<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Production List')]
class ProductionIndex extends Component {

    public $title = "Production List";
    public $text_subtitle = "Production List is used to display, manage, and monitor production data in the system";

    public function render() {
        return view('livewire.manage-production.production-index');
    }
}
