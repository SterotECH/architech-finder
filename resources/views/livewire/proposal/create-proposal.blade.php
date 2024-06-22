<div class="mx-auto py-6">
    <!-- Proposal Form -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <form wire:submit.prevent="create">
            {{ $this->form }}

            <div class="mt-4">
                <x-filament::button type="submit" color="secondary">Submit Proposal</x-filament::button>
            </div>
        </form>
        <x-filament-actions::modals />
    </div>
</div>
