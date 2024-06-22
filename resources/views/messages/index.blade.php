<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Project Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg p-4">
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($projects as $project)
                        @php
                            $lastMessage = $project->lastMessage;
                            $unreadCount = $project
                                ->messages()
                                ->where('recipient_id', Auth::id())
                                ->whereNull('read_at')
                                ->count();
                            $otherUser = Auth::id() === $project->client_id ? $project->architect : $project->client;
                        @endphp
                        <a href="{{ route('messages.chat', $project) }}">
                            <div class="bg-white p-4 rounded-lg shadow flex items-center justify-between">
                                <div class="flex items-center mb-2">
                                    <img src="{{ $otherUser->user->profile_photo_url }}"
                                        alt="{{ $otherUser->user->full_name }}"
                                        class="size-16 rounded-full mr-4 object-cover">
                                    <div>
                                        <h2 class="text-xl font-bold">{{ $project->title }}</h2>
                                        <p class="text-gray-600">
                                            {{ $lastMessage ? $lastMessage->content : 'No messages yet' }}</p>
                                    </div>
                                </div>
                                <div class="flex-col space-y-1 justify-between items-center mt-4">
                                    <div class="text-gray-600">
                                        <x-filament::badge>
                                            {{ $unreadCount }}
                                        </x-filament::badge>
                                    </div>
                                    <div class="text-gray-600">
                                        <x-filament::badge color="danger">
                                            {{ $lastMessage ? $lastMessage->created_at->format('M d, Y H:i') : '' }}
                                        </x-filament::badge>

                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
