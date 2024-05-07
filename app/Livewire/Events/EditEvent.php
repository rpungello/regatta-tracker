<?php

namespace App\Livewire\Events;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditEvent extends Component
{
    public function render(): View
    {
        return view('livewire.events.edit-event');
    }
}
