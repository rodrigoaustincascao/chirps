<?php
use Mary\Traits\Toast;
use Livewire\Volt\Component;
use Livewire\Attributes\Rule;
use App\Models\User;

new class extends Component {
    use Toast;

    #[Rule('required|email')]
    public string $email;

    #[Rule('required|min:8')]
    public string $password;

    public function login()
    {
        $credenciais = $this->validate();

        if (Auth::attempt($credenciais)) {
            Auth::login(User::where('email', $credenciais['email'])->first());

            request()
                ->session()
                ->regenerate();
            return redirect()->intended('/chirps');
        }

        $this->reset();
        $this->warning('E-mail ou senha incorretos!!!');
    }
}; ?>

<div class="flex justify-center">
    <x-toast />
    <x-card>
        <x-form wire:submit="login">
            <x-input label="E-mail" wire:model="email" icon="o-envelope" inline />
            <x-input label="Password" wire:model="password" type="password" icon="o-key" inline />

            <x-slot:actions>
                <x-button label="Cadastrar" link="/cadastro" icon="o-user" />
                <x-button label="Login" type="submit" icon="o-paper-airplane" class="btn-primary" spinner="login" />

            </x-slot:actions>
        </x-form>
    </x-card>
</div>
