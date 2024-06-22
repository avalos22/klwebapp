<?php

namespace App\Livewire;

use Livewire\Component;

class SidePanel extends Component
{
    public $open = true;

    public function toggleMenu()
    {
        $this->open = !$this->open;
    }

    public function render()
    {
        return view('livewire.side-panel');
    }
}