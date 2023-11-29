<?php

use App\Models\Chirp;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public ?Chirp $editing = null;

    #[On('chirp-created')]
    public function abc()
    {
    }

    public function with()
    {
        return [
            'chirps' => $this->getChirps(),
        ];
    }
    public function getChirps(): Collection
    {
        return Chirp::with('user')
            ->latest()
            ->get();
    }

    public function edit(Chirp $chirp): void
    {
        $this->editing = $chirp;
    }

    #[On('chirp-edit-canceled')]
    #[On('chirp-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        // $this->getChirps();
    }

    public function delete(Chirp $chirp): void
    {
        // $this->authorize('delete', $chirp);

        $chirp->delete();

        // $this->getChirps();
    }
}; ?>

<div class="mt-9">
    @foreach ($chirps as $chirp)
        <x-card shadow separator wire:key="{{ $chirp->id }}" class="m-5">

            @if ($chirp->is($editing))
                <livewire:chirps.edit :chirp="$chirp" :key="$chirp->id" />
            @else
                <p>{{ $chirp->message }}</p>
            @endif
            <x-slot:subtitle>
                <x-icon name="o-chat-bubble-oval-left-ellipsis"
                    label="{{ $chirp->user->name }} {{ $chirp->created_at->format('j M Y, g:i a') }}" />
            </x-slot:subtitle>
            @if ($chirp->user->is(auth()->user()))
                <x-slot:menu>

                    <x-button wire:click="edit({{ $chirp->id }})" icon="o-pencil-square" class="btn-circle btn-sm" />
                    <x-button wire:click="delete({{ $chirp->id }})" wire:confirm="Are you sure to delete this chirp?"
                        icon="o-trash" class="cursor-pointer btn-circle btn-sm" />
                </x-slot:menu>
            @endif
        </x-card>
    @endforeach
</div>
