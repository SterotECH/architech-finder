<div>
    <form wire:submit="create" >
        {{ $this->form }}

        {{-- <div class="mt-4 flex space-x-2">
            <x-filament::button type="submit" ">
                Create Architect
            </x-filament::button>
            <x-filament::button type="button" wire:click="redirectToIndex" color="slate">
                Cancel
            </x-filament::button>
        </div> --}}
    </form>

    <x-filament-actions::modals />
</div>
