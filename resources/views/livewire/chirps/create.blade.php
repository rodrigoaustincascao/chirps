<?php

use Livewire\Attributes\Rule;
use Livewire\Volt\Component;

new class extends Component {
    #[Rule('required|string|max:255')]
    public string $message = '';

    public function store(): void
    {
        $validated = $this->validate();

        auth()
            ->user()
            ->chirps()
            ->create($validated);

        $this->message = '';

        $this->dispatch('chirp-created');
    }
}; ?>

<div>
    <x-form wire:submit="store">
        <x-textarea wire:model="message" placeholder="What's on your mind?" />

        {{-- <x-input-error :messages="$errors->get('message')" class="mt-2" /> --}}
        <x-slot:actions>
            <x-button label='Chirp' type="submit" class="btn-primary" />
        </x-slot:actions>
    </x-form>
</div>
