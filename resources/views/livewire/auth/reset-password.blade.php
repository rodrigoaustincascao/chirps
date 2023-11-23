<?php

use Mary\Traits\Toast;
use App\Models\User;
use Livewire\Volt\Component;
use Livewire\Attributes\Rule;

new class extends Component {
    use Toast;

    #[Rule('required|email')]
    public string $email;

    #[Rule('required|min:8')]
    public string $password;

    #[Rule('required|min:8|same:password')]
    public string $passwordConfirmacao;

    public function reset_password()
    {
        $dados = $this->validate();

        $user = User::where('email', $dados['email'])->first();

        $user
            ->forceFill([
                'password' => Hash::make($dados['password']),
            ])
            ->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
    }
}; ?>

<div class="flex justify-center">
    <x-toast />
    <x-card>
        <x-form wire:submit="reset_password">
            <x-input label="E-mail" wire:model="email" icon="o-envelope" inline />
            <x-input label="Password" wire:model="password" type="password" icon="o-key" inline />
            <x-input label="Repita o Password" wire:model="passwordConfirmacao" type="password" icon="o-key" inline />

            <x-slot:actions>
                <x-button label="Atualizar" type="submit" icon="o-paper-airplane" class="btn-primary"
                    spinner="login" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
