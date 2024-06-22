<div x-data="{
    scrollToBottom() {
        this.$refs.messageContainer.scrollTop = this.$refs.messageContainer.scrollHeight;
    },
    init() {
        this.scrollToBottom();
        this.$watch('messages', () => {
            this.scrollToBottom();
        });
    }
}">
    <div class="mb-4 max-w-7xl mx-auto space-y-3 relative">
        <div x-ref="messageContainer" class="overflow-y-auto max-h-96">
            @foreach ($messages as $message)
                <div class="flex {{ $message['sender_id'] === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $message['sender_id'] === auth()->id() ? 'bg-blue-800 text-white border border-gray-200 rounded-2xl p-4 space-y-3 dark:bg-neutral-900 dark:border-neutral-700 mb-4' : 'bg-white border border-primary-200 rounded-2xl p-4 space-y-3 dark:bg-neutral-900 dark:border-neutral-700 mb-4' }}">
                        <p>{{ $message['content'] }}</p>
                        <small>{{ \Carbon\Carbon::parse($message['created_at'])->format('M d, Y H:i') }}</small>
                        @if ($message['read_at'])
                            <span class="text-green-500 inline-flex items-center"><x-heroicon-o-check-badge  class="size-5" /></span>
                        @else
                            <span class="text-red-500 inline-flex items-center"><x-heroicon-o-check class="size-4" /></span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <button class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black text-white p-2 rounded-full shadow-lg size-10" @click="scrollToBottom">
            ↓
        </button>
    </div>
    <form wire:submit.prevent="sendMessage">
        <div class="flex gap-x-4 items-center">
            <x-input type="text" wire:model="message" class="w-full border p-2" placeholder="Type your message" />
            <x-button type="submit" class="px-4 py-2 mt-2">Send</x-button>
        </div>
    </form>
</div>
