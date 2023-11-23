<?php

use Livewire\Volt\Component;

new class extends Component {
    public string $message = '';
}; ?>

<div>
    <x-form wire:submit="store">
        <x-textarea wire:model="message" placeholder="What's on your mind?" />

        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <x-slot:actions>
            <x-button label='Chirp' type="submit" class="btn-primary" />
        </x-slot:actions>
    </x-form>
</div>
</div>
