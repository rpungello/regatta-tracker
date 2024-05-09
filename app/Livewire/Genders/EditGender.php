<?php

namespace App\Livewire\Genders;

use App\Models\Gender;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditGender extends Component
{
    public Gender $gender;

    #[Validate(['required', 'string'])]
    public string $name;

    #[Validate(['required', 'regex:/[0-9a-fA-F]{6}/'])]
    public string $color;

    #[Validate('boolean')]
    public bool $pluralize;

    public function mount(): void
    {
        $this->name = $this->gender->name;
        $this->color = $this->gender->color;
        $this->pluralize = $this->gender->pluralize;
    }

    public function render(): View
    {
        return view('livewire.genders.edit-gender');
    }

    public function save(): void
    {
        $this->gender->update(
            $this->validate()
        );

        $this->redirectRoute('genders.list');
    }
}
