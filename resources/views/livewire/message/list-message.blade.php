<div>
    <div class="grid grid-cols-1 gap-4">
        @foreach ($projects as $project)
            @php
                $lastMessage = $project->lastMessage;
                $unreadCount = $project
                    ->messages()
                    ->where('recipient_id', Auth::id())
                    ->where('status', 'unread')
                    ->count();
                $otherUser = Auth::id() === $project->client_id ? $project->architect : $project->client;
            @endphp
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="flex items-center mb-2">
                    <img src="{{ $otherUser->profile_picture }}" alt="{{ $otherUser->name }}"
                        class="size-12 rounded-full mr-4">
                    <div>
                        <h2 class="text-xl font-bold">{{ $project->name }}</h2>
                        <p class="text-gray-600">{{ $lastMessage ? $lastMessage->content : 'No messages yet' }}</p>
                    </div>
                </div>
                <div class="items-center mt-4">
                    <div class="text-gray-600">
                        <x-filament::badge>
                            {{ $unreadCount }}
                        </x-filament::badge>
                    </div>
                    <div class="text-gray-600">
                        {{ $lastMessage ? $lastMessage->created_at->format('M d, Y H:i') : '' }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
