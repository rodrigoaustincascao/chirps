<?php

use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Livewire\Attributes\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

new class extends Component {
    use Toast;

    #[Rule('required|email')]
    public string $email;

    public function reset_link()
    {
        $dados = $this->validate();

        Password::sendResetLink($dados);
    }
}; ?>

<div class="flex justify-center">
    <x-toast />
    <x-card>
        <x-form wire:submit="reset_link">
            <x-input label="E-mail" wire:model="email" icon="o-envelope" inline />
            <x-slot:actions>
                <x-button label="Reenviar" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="login" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
