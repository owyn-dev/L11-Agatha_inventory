<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Update Production')]
class ProductionUpdate extends Component {

    public $title = "Update Production";
    public $text_subtitle = "This page displays the production data to be changed.";

    public function render() {
        return view('livewire.manage-production.production-update');
    }
}
