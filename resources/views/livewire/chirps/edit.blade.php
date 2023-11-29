<?php

use App\Models\Chirp;
use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public Chirp $chirp;

    #[Rule('required|string|max:255')]
    public string $message = '';

    public function mount(): void
    {
        $this->message = $this->chirp->message;
    }

    public function update(): void
    {
        // $this->authorize('update', $this->chirp);

        $validated = $this->validate();

        $this->chirp->update($validated);

        $this->dispatch('chirp-updated');
    }

    public function cancel(): void
    {
        $this->dispatch('chirp-edit-canceled');
    }
}; ?>

<div>
    <x-form wire:submit="update">
        <x-textarea wire:model="message" />

        <x-slot:actions>
            <x-button class="btn-primary" type="submit" label="Atualizar" />
            <x-button class="btn-outline" wire:click.prevent="cancel" label="Cancelar" />
        </x-slot:actions>
    </x-form>
</div>
