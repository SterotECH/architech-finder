<div class="mx-auto py-6">
    <form wire:submit="save" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8">
        <div class="mb-4 col-span-6 sm:col-span-4">
            <x-label for="form.title" value="{{ __('Title') }}" />
            <x-input type="text" wire:model="form.title" class="mt-1 block w-full" id="title" />
            <x-input-error for="title" class="mt-1" />
        </div>

        <div class="mb-4 col-span-6 sm:col-span-4">
            <x-label for="type" value="{{ __('Type') }}" />
            <select wire:model="form.type" id="type" class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                @foreach (App\Enums\ProjectType::cases() as $projectType)
                    <option value="{{ $projectType->value }}">{{ $projectType->name }}</option>
                @endforeach
            </select>
            <x-input-error for="form.type" class="mt-1" />
        </div>

        <div class="mb-4 col-span-6 sm:col-span-4">
            <x-label for="description" value="{{ __('Description') }}" />
            <textarea
                wire:model.blur="form.description"
                wire:ignore
                wire:key="description-textarea"
                class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                id="description"
                oninput="resizeTextarea(this)"
            ></textarea>
            <x-input-error for="form.description" class="mt-1" />

            <script>
                function resizeTextarea(el) {
                    el.style.height = 'auto';
                    const maxHeight = window.innerHeight * 0.5;
                    el.style.height = Math.min(el.scrollHeight, maxHeight) + 'px';
                }

                document.addEventListener('livewire:load', function () {
                    Livewire.hook('message.processed', (message, component) => {
                        const textarea = document.getElementById('description');
                        if (textarea) {
                            resizeTextarea(textarea);
                        }
                    });
                });
            </script>
        </div>

        <div class="flex items-center justify-end px-4 py-3 text-end sm:px-6">
            <x-button type="submit">Create Project </x-button>
        </div>
        <div wire:loading.flex wire:target="save" class="absolute inset-0 bg-slate-500 bg-opacity-75 flex items-center justify-center">
            <div class="text-white">
                Saving Project...
            </div>
    </form>
</div>
<style>
    textarea {
        transition: height 0.2s ease;
    }
</style>
