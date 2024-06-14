@resource('dashboard/master')
<div class="container mx-auto py-10" x-data="{ activeChat: null, chats: [{id: 1, name: 'John Doe', avatar: 'https://via.placeholder.com/40', messages: []}, {id: 2, name: 'Jane Smith', avatar: 'https://via.placeholder.com/40', messages: []}], newMessage: ''}">
  <div class="flex bg-white shadow-lg rounded-lg overflow-hidden">

    <!-- Chat List -->
    <div class="w-1/3 border-r border-gray-300">
      <ul>
        <template x-for="chat in chats" :key="chat.id">
          <li @click="activeChat = chat" :class="{'bg-gray-200': activeChat?.id === chat.id}" class="cursor-pointer flex items-center p-4 hover:bg-gray-100">
            <img :src="chat.avatar" alt="Avatar" class="w-10 h-10 rounded-full mr-4">
            <div>
              <p class="font-semibold" x-text="chat.name"></p>
              <p class="text-xs text-gray-500" x-text="chat.messages.length > 0 ? chat.messages[chat.messages.length - 1].text : 'No messages yet'"></p>
            </div>
          </li>
        </template>
      </ul>
    </div>

    <!-- Chat Window -->
    <div class="w-2/3 flex flex-col">
      <div class="flex-1 p-4 overflow-y-auto">
        <template x-if="activeChat">
          <div>
            <template x-for="message in activeChat.messages" :key="message.id">
              <div :class="{'text-right': message.sender === 'me'}" class="mb-2">
                <p class="inline-block p-2 rounded-lg" :class="{'bg-blue-100 text-blue-800': message.sender === 'me', 'bg-gray-100 text-gray-800': message.sender !== 'me'}" x-text="message.text"></p>
              </div>
            </template>
          </div>
        </template>
        <template x-if="!activeChat">
          <p class="text-center text-gray-500">Select a chat to start messaging</p>
        </template>
      </div>

      <!-- Message Input -->
      <div class="p-4 border-t border-gray-300">
        <input type="text" x-model="newMessage" @keydown.enter="if (activeChat && newMessage.trim() !== '') { activeChat.messages.push({id: Date.now(), sender: 'me', text: newMessage.trim()}); newMessage = ''; }" placeholder="Type a message..." class="w-full p-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500">
      </div>
    </div>

  </div>
</div>
