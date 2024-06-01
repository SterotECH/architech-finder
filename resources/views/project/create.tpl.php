@resource('dashboard/master')
<div class="w-full lg:ps-64">
  <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <form method="POST" action="/projects">
      <?= csrf_field(); ?>
      <div class="bg-white rounded-xl shadow">
        <div class="pt-0 p-4 sm:pt-0 sm:p-7">
          <div class="space-y-4 sm:space-y-6">
            <div class="space-y-2">
              <label for="project-name" class="inline-block text-sm font-medium text-gray-800 mt-2.5">
                Project name
              </label>

              <input id="project-name" name="name" type="text" class="input input-secondary" placeholder="Enter project name" value="<?= old('name') ?>" />
              <?php if (isset($errors['name'])) : ?>
                <?= showError(key: 'name', errors: $errors) ?>
              <?php endif ?>
            </div>

            <div class="space-y-2">
              <label for="projectType" class="inline-block text-sm font-medium text-gray-800 mt-2.5">
                Project Type
              </label>

              <select id="projectType" class="select select-primary w-full max-w-xs" name="type">
                <?php foreach (App\Enums\ProjectType::cases() as $type) : ?>
                  <option value="<?= $type->value; ?>" <?= $type->value === old('type') ? 'selected' : ''; ?>>
                    <?= $type->getLabel() ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <?php if (isset($errors['type'])) : ?>
                <?= showError(key: 'type', errors: $errors) ?>
              <?php endif ?>
            </div>

            <div class="space-y-2">
              <label for="description" class="inline-block text-sm font-medium text-gray-800 mt-2.5">
                Description
              </label>

              <textarea id="description" name="description" class="textarea textarea-primary" rows="6" placeholder="A detailed summary will better explain your products to the architect. Our Architects will see this in the project description."><?= old('description') ?></textarea>
              <?php if (isset($errors['description'])) : ?>
                <?= showError(key: 'description', errors: $errors) ?>
              <?php endif ?>
            </div>
          </div>

          <div class="mt-5 flex justify-end gap-x-2">
            <button type="submit" class="btn btn-primary">
              Submit your project
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
