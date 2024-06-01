@resource('dashboard/master')
<div class="w-full lg:ps-64">
  <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
    <div class="container mx-auto p-6">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">Create Architect</h1>
        <form action="/architect" method="POST" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <input type="hidden" name="role" value="<?= App\Enums\UserRole::ARCHITECT->value ?>" />
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
          <div class="col-span-2" x-data="imagePreview()">
            <div class="flex flex-col items-center space-y-4">
              <div class="relative">
                <img :src="imageUrl ? imageUrl : 'https://via.placeholder.com/150'" alt="Avatar Preview" class="size-32 rounded-full object-cover" />
                <input type="file" id="ProfilePicture" name="avatar" class="hidden" accept="image/*" @change="previewImage" value="<?= old('avatar') ?>" required />
                <button type="button" class="absolute bottom-0 left-1/2 transform -translate-x-1/2 btn btn-secondary btn-sm" :class="{'btn-primary': imagePreview:,  'btn-error': !imagePreview}" @click="document.getElementById('ProfilePicture').click()">
                  <template x-if="!imageUrl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-up size-4">
                      <path d="M10.3 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10l-3.1-3.1a2 2 0 0 0-2.814.014L6 21" />
                      <path d="m14 19.5 3-3 3 3" />
                      <path d="M17 22v-5.5" />
                      <circle cx="9" cy="9" r="2" />
                    </svg>
                  </template>
                  <template x-if="imageUrl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash size-4">
                      <path d="M3 6h18" />
                      <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                      <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                    </svg>
                  </template>
                </button>
              </div>
              <?php if (isset($errors['avatar'])) : ?>
                <?= showError(key: 'avatar', errors: $errors) ?>
              <?php endif ?>
            </div>
          </div>
            <div class="mb-4">
              <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
              <input type="email" name="email" id="email" class="input input-bordered w-full" required>
            </div>
            <div class="mb-4">
              <label for="password" class="block text-gray-700 font-bold mb-2">Password:</label>
              <input type="password" name="password" id="password" class="input input-bordered w-full" required>
            </div>
            <div class="mb-4">
              <label for="first_name" class="block text-gray-700 font-bold mb-2">First Name:</label>
              <input type="text" name="first_name" id="first_name" class="input input-bordered w-full" required>
            </div>
            <div class="mb-4">
              <label for="last_name" class="block text-gray-700 font-bold mb-2">Last Name:</label>
              <input type="text" name="last_name" id="last_name" class="input input-bordered w-full" required>
            </div>
            <div class="mb-4">
              <label for="phone_number" class="block text-gray-700 font-bold mb-2">Phone Number:</label>
              <input type="text" name="phone_number" id="phone_number" class="input input-bordered w-full">
            </div>
            <div class="mb-4">
              <label for="gender" class="block text-gray-700 font-bold mb-2">Gender:</label>
              <select name="gender" id="gender" class="select select-bordered w-full" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="mb-4">
              <label for="location" class="block text-gray-700 font-bold mb-2">Location:</label>
              <input type="text" name="location" id="location" class="input input-bordered w-full">
            </div>

            <div class="mb-4 lg:col-span-2">
              <label for="portfolio_link" class="block text-gray-700 font-bold mb-2">Portfolio Link:</label>
              <input type="text" name="portfolio_link" id="portfolio_link" class="input input-bordered w-full" required>
            </div>

            <div class="mb-4 lg:col-span-2">
              <label for="experience" class="block text-gray-700 font-bold mb-2">Experience:</label>
              <textarea name="experience" id="experience" class="textarea textarea-bordered w-full" required></textarea>
            </div>
            <div class="mb-4 lg:col-span-2">
              <label for="biography" class="block text-gray-700 font-bold mb-2">Biography:</label>
              <textarea name="biography" id="biography" class="textarea textarea-bordered w-full" required></textarea>
            </div>


          </div>
          <div class="mb-4 col-span-2">
            <label for="qualifications" class="block text-gray-700 font-bold mb-2">Qualifications:</label>
            <textarea name="qualifications" id="qualifications" class="textarea textarea-bordered w-full" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary w-full">Create Architect</button>
        </form>
      </div>
    </div>

    <script>
      function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
          const output = document.getElementById('avatar-preview');
          output.src = reader.result;
          output.classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
      }
    </script>

  </div>
</div>
