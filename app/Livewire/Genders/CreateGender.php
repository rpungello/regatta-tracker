<?php

namespace App\Livewire\Genders;

use App\Models\Gender;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateGender extends Component
{
    #[Validate(['required', 'string'])]
    public string $name;

    #[Validate(['required', 'regex:/[0-9a-fA-F]{6}/'])]
    public string $color;

    #[Validate('boolean')]
    public bool $pluralize = false;

    public function render(): View
    {
        return view('livewire.genders.create-gender');
    }

    public function save(): void
    {
        Gender::create(
            $this->validate()
        );

        $this->redirectRoute('genders.list');
    }
}
