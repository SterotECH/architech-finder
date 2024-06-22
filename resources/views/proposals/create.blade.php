<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Create Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="  mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg p-4">
                <livewire:proposal.create-proposal :project="$project" />
            </div>
        </div>
    </div>
</x-app-layout>
