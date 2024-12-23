<?php

namespace App\Livewire\ManageProduction;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Show Production')]
class ProductionShow extends Component {

    public $title = "Show Production";
    public $text_subtitle = "This page displays details of production data.";

    public function render() {
        return view('livewire.manage-production.production-show');
    }
}
