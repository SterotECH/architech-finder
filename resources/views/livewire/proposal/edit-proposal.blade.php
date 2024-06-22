<div>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-4">
            <x-filament::button tooltip="Update the proposal" badge-color="danger"
                type="submit">
                Submit
            </x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>
