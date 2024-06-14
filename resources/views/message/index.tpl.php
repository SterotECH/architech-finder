@resource('dashboard/master')
<section class="w-full lg:ps-64">
  <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
    <div x-data="chatApp()" x-init="init()" class="flex h-[calc(100vh - 50px)]">
      <!-- Project List -->
      <div class="w-full md:w-1/3 bg-white shadow-md overflow-y-auto" x-show="!showChat || window.innerWidth >= 768">
        <ul class="list-none p-4">
          <template x-for="project in projects" :key="project.id">
            <li class="p-2 hover:bg-gray-200 cursor-pointer" @click="selectProject(project.id)">
              <div class="font-bold" x-text="project.title"></div>
              <pre x-text="project.first_name"></pre>
            </li>
          </template>
        </ul>
      </div>

      <!-- Chat Window -->
      <div class="w-full md:w-2/3 flex flex-col bg-white shadow-md" x-show="showChat || window.innerWidth >= 768">
        <div class="flex-1 overflow-y-auto p-4" x-ref="chat">
          <template x-for="message in messages" :key="message.id">
            <div class="p-2 border-b" x-text="message.message"></div>
            <p x-text="message.id"></p>
          </template>
        </div>
        <div class="p-4 flex">
          <input id="message" x-model="message" type="text" class="flex-1 border p-2 rounded-l">
          <button @click="sendMessage()" class="bg-blue-500 text-white p-2 rounded-r">Send</button>
        </div>
        <div class="p-4">
          <input type="file" id="file" @change="uploadFile" class="hidden">
          <button @click="document.getElementById('file').click()" class="bg-green-500 text-white p-2 rounded">Upload File</button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function chatApp() {
    return {
      message: '',
      messages: [],
      projects: <?= json_encode($projects); ?>,
      showChat: false,
      init() {
        this.initSSE();
      },
      selectProject(projectId) {
        this.showChat = true;
        this.fetchMessages(projectId);
      },
      fetchMessages(projectId) {
        fetch(`/api/projects/${projectId}/messages`)
          .then(response => response.json())
          .then(data => {
            console.log(data);
            console.log(this.messages)
            this.messages = data;
          });
      },
      initSSE() {
        const eventSource = new EventSource(`/sse/stream`);
        eventSource.onmessage = (event) => {
          this.addMessage(JSON.parse(event.data));
        };
      },
      sendMessage() {
        fetch('/sse/send-message', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              message: this.message,
              sender_id: <?= auth()->user()->id ?>,
              receiver_id: this.getCurrentProjectId(),
              project_id: this.getCurrentProjectId()

            })
          }).then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              this.message = '';
            } else {
              console.error(data.message);
            }
          });
      },
      uploadFile(event) {
        let file = event.target.files[0];
        let formData = new FormData();
        formData.append('file', file);

        fetch('/sse/upload-file', {
            method: 'POST',
            body: formData
          }).then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              fetch('/sse/send-message', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  message: `File uploaded: ${data.file_path}`,
                  receiver_id: 1,
                  project_id: this.getCurrentProjectId()
                })
              });
            } else {
              console.error(data.message);
            }
          });
      },
      addMessage(message) {
        this.messages.push(message);
        this.$nextTick(() => {
          this.$refs.chat.scrollTop = this.$refs.chat.scrollHeight;
        });
      },
      getCurrentProjectId() {
        return this.projects.length > 0 ? this.projects[0].id : null;
      },
      getCurrentReceiverId() {

      }
    }
  }
</script>
</body>

</html>
