<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Dashboard')]
class Dashboard extends Component {

    public $title = "Dashboard";
    public $text_subtitle = "Get an overview of the latest data and information";

    public function render() {
        return view('livewire.dashboard');
    }
}
