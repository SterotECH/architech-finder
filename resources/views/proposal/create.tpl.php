@resource('dashboard/master')
<div class="w-full lg:ps-64">
  <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
    <h2 class="text-2xl font-bold mb-4">Create Proposal</h2>
    <div class="flex flex-col lg:flex-row gap-6">
      <div class="bg-white border shadow-sm rounded-xl p-4 w-full">
        <form action="/projects/<?= $project->slug ?>/proposals" method="POST" x-data="{ timeline: [
    { title: 'Conceptual Design', description: 'Understanding the client\'s requirements, site analysis, and developing initial design concepts with rough sketches and ideas.' },
    { title: 'Schematic Design', description: 'Refining the conceptual design into more detailed drawings, including floor plans, elevations, and basic 3D models.' },
    { title: 'Design Development', description: 'Developing the design further with structural, mechanical, and electrical systems, and creating detailed drawings and specifications.' },
    { title: 'Construction Documentation', description: 'Preparing detailed drawings and specifications required for construction, providing all necessary information for contractors.' },
    { title: 'Construction Administration', description: 'Overseeing the construction process to ensure it aligns with the design intent, contract documents, and ensuring quality control.' }
] }">
          <?= csrf_field() ?>
          <?php if (isset($errors['project_id'])) : ?>
            <?= showError('project_id', $errors) ?>
          <?php endif ?>
          <?php if (isset($errors['architect_id'])) : ?>
            <?= showError('architect_id', $errors) ?>
          <?php endif ?>
          <input type="hidden" name="project_id" value="<?= $project->id ?>" />
          <input type="hidden" name="architect_id" value="<?= $architect ?>" />

          <div class="mb-4">
            <label for="approach" class="block text-gray-700 text-sm font-bold mb-2">Approach</label>
            <textarea id="approach" name="approach" class="textarea textarea-bordered w-full" placeholder="Describe your approach"><?= old('approach') ?></textarea>
            <?php if (isset($errors['approach'])) : ?>
              <?= showError('approach', $errors) ?>
            <?php endif ?>
          </div>

          <div class="mb-4">
            <label for="timeline" class="block text-gray-700 text-sm font-bold mb-2">Timeline</label>
            <div class="relative pl-8">
              <div class="absolute h-full border-l-4 border-gray-200" style="left: 1rem;"></div>
              <template x-for="(milestone, index) in timeline" :key="index">
                <div class="mb-8 relative">
                  <div class="absolute w-8 h-8 bg-accent rounded-full flex items-center justify-center text-white -left-8">
                    <span x-text="index + 1"></span>
                  </div>
                  <div class="ml-4">
                    <label :for="'milestone_title_' + index" class="block text-gray-700 text-sm font-bold mb-2">Milestone Title</label>
                    <input x-model="milestone.title" :id="'milestone_title_' + index" type="text" class="input input-bordered w-full mb-2" :placeholder="milestone.title">
                    <label :for="'milestone_description_' + index" class="block text-gray-700 text-sm font-bold mb-2">Milestone Description</label>
                    <textarea x-model="milestone.description" :id="'milestone_description_' + index" class="textarea textarea-bordered w-full" :placeholder="milestone.description"></textarea>
                  </div>
                </div>
              </template>
              <button type="button" class="btn btn-secondary" @click="timeline.push({title: '', description: ''})">Add Milestone</button>
            </div>
          </div>

          <input type="hidden" name="timeline" x-model="JSON.stringify(timeline)">

          <div class="mb-4">
            <label for="fees" class="block text-gray-700 text-sm font-bold mb-2">Fees</label>
            <input type="number" id="fees" name="fees" class="input input-bordered w-full" placeholder="Fees in GHC" value="<?= old('fees') ?>" />
            <?php if (isset($errors['fees'])) : ?>
              <?= showError('fees', $errors) ?>
            <?php endif ?>
          </div>

          <div class="flex items-center justify-between">
            <button type="submit" class="btn btn-primary">Submit Proposal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function autoGrow(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
  }

  document.getElementById('approach').addEventListener('input', function() {
    autoGrow(this);
  });
</script>
