@resource('dashboard/master')
<div class="w-full lg:ps-64">
  <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
    <div class="bg-white rounded-lg shadow-md p-6">
      <h1 class="text-2xl font-bold mb-4">Edit Project</h1>

      <form action="/projects/{{ $project->id}}" method="POST">
        <input type="hidden" name="id" value="{{ $project->id }}">
        <?= csrf_field() ?>
        <?= method_field('PATCH') ?>
        <div class="mb-4">
          <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
          <input type="text" id="title" name="title" value="{{ $project->title }}" class="input input-primary">
        </div>
        <div class="grid grid-cols-6 gap-6">
          <div class="col-span-6 sm:col-span-3">
            <label for="type" class="block text-gray-700 font-semibold mb-2">Type</label>
            <select id="type" name="type" class="input input-primary">
              <?php foreach (App\Enums\ProjectType::cases() as $type) : ?>
                <option value="<?= $type->value; ?>" <?= $type->value === $project->type ? 'selected' : ''; ?>>
                  <?= $type->getLabel() ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-span-6 sm:col-span-3">
            <label for="status" class="block text-gray-700 font-semibold mb-2">Status</label>
            <select id="status" name="status" class="input input-primary">
              <?php foreach (App\Enums\ProjectStatus::cases() as $status) : ?>
                <option value="<?= $status->value; ?>" <?= $status->value === $project->status ? 'selected' : ''; ?>>
                  <?= $status->getLabel() ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>


        <div class="mb-4">
          <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
          <textarea id="description" name="description" rows="5" class="textarea textarea-primary">{{ $project->description }}</textarea>
        </div>

        <div class="flex justify-end">
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const textarea = document.getElementById('description');

  function resizeTextarea() {
    const halfViewportHeight = window.innerHeight / 2;
    textarea.style.height = `${halfViewportHeight}px`;
  }

  // Initial resize and add event listener for window resize
  resizeTextarea();
  window.addEventListener('resize', resizeTextarea);
</script>
