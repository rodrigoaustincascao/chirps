<?php

use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Illuminate\Auth\Events\Registered;
use Livewire\Attributes\Rule;
use App\Models\User;

new class extends Component {
    use Toast;

    #[Rule('required|min:3|max:255')]
    public string $name;

    #[Rule('required|email')]
    public string $email;

    #[Rule('required|min:8')]
    public string $password;

    #[Rule('required|min:8|same:password')]
    public string $passwordConfirmacao;

    public function create()
    {
        $dados = $this->validate();
        try {
            $user = User::create([
                'name' => $dados['name'],
                'password' => Hash::make($dados['password']),
                'email' => $dados['email'],
            ]);

            event(new Registered($user));

            $this->reset();
            $this->success(title: 'Sucesso', description: 'Cadastro criado com sucesso!', redirectTo: '/cadastro');
        } catch (Throwable $erro) {
            $this->error(title: 'Erro', description: $erro->getMessage(), redirectTo: '/cadastro');
        }
    }
}; ?>

<div class="flex justify-center">
    <x-toast />
    <x-card>
        <x-form wire:submit="create">
            <x-input label="Name" wire:model="name" icon="o-user" inline />
            <x-input label="E-mail" wire:model="email" icon="o-envelope" inline />
            <x-input label="Password" wire:model="password" type="password" icon="o-key" inline />
            <x-input label="Repita o Password" wire:model="passwordConfirmacao" type="password" icon="o-key" inline />

            <x-slot:actions>
                <x-button label="Criar" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="login" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
