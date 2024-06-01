@resource('dashboard/master')

<div class="w-full lg:ps-64">
  <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
    <div class="container mx-auto p-4">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $project->title }}</h1>

        <div class="mb-4">
          <span class="text-gray-700 font-semibold">Type: </span>
          <span class="text-gray-900">{{ $project->type }}</span>
        </div>

        <div class="mb-4">
          <span class="text-gray-700 font-semibold">Status: </span>
          <span class="text-gray-900 inline-flex items-center <?= App\Enums\ProjectStatus::from($project->status)->getTextColor() ?> rounded-md px-3 text-sm">
            <?= App\Enums\ProjectStatus::from($project->status)->getSVG() ?>&nbsp;
            <?= App\Enums\ProjectStatus::from($project->status)->getLabel() ?>
          </span>
        </div>

        <div class="mb-4">
          <span class="text-gray-700 font-semibold">Description: </span>
          <p class="text-gray-900">{{ $project->description }}</p>
        </div>

        <h2 class="text-xl font-semibold mb-4">Proposals</h2>
        <?php

        use App\Core\Session;

        if (!empty($proposals)) : ?>
          <div class="space-y-4">
            <?php foreach ($proposals as $index => $proposal) : ?>
              <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <h3 class="text-lg font-bold mb-2">Proposal #<?= $index + 1 ?> from <?= htmlspecialchars($proposal->architect_id) ?></h3>
                <p><span class="font-semibold">Approach:</span> <?= htmlspecialchars($proposal->approach) ?></p>
                <p><span class="font-semibold">Fees:</span> GHC <?= htmlspecialchars($proposal->fees) ?></p>

                <!-- Milestones Timeline -->
                <div class="my-4">
                  <h4 class="text-lg font-semibold mb-2">Timeline</h4>
                  <div class="timeline">
                    <ul class="space-y-4">
                      <?php
                      $milestones = json_decode($proposal->timeline, true);
                      foreach ($milestones as $step => $milestone) : ?>
                        <li class="relative pb-8">
                          <?php if ($step < count($milestones) - 1) : ?>
                            <span class="absolute top-0 left-2.5 mt-1.5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                          <?php endif; ?>
                          <div class="relative flex items-start group">
                            <span class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-500 text-white ring-8 ring-white">
                              <?= $step + 1 ?>
                            </span>
                            <div class="ml-4">
                              <h4 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($milestone['title']) ?></h4>
                              <p class="text-gray-700"><?= htmlspecialchars($milestone['description']) ?></p>
                            </div>
                          </div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
                <!-- End Milestones Timeline -->

                <form action="/proposal/accept" method="POST" class="mt-4">
                  <?= csrf_field() ?>
                  <input type="hidden" name="proposal_id" value="<?= $proposal->id ?>">
                  <input type="hidden" name="project_id" value="<?= $proposal->project_id ?>" />
                  <button type="submit" class="btn btn-primary">Accept Proposal</button>
                </form>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else : ?>
          <p>No proposals available for this project.</p>
        <?php endif; ?>

        <div class="flex justify-end items-center mt-6">
          <a href="/projects/<?= $project->slug ?>/edit" class="btn btn-primary btn-sm mx-4">Edit Project</a>
          <div x-data="{ showModal: false }" class="inline-flex items-center">
            <!-- Delete Button -->
            <form @submit.prevent="showModal = true">
              <?= csrf_field() ?>
              <?= method_field('DELETE') ?>
              <button class="btn btn-error btn-sm bg-red-500 text-white hover:bg-red-600" type="submit">Delete</button>
            </form>

            <!-- Modal Backdrop -->
            <div x-show="showModal" x-cloak x-transition class="fixed inset-0 bg-gray-800 bg-opacity-30 flex items-center justify-center z-50">
              <div @click.away="showModal = false" class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-4">
                  <h2 class="text-xl font-semibold">Confirm Deletion</h2>
                  <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                  </button>
                </div>
                <!-- Modal Body -->
                <div class="mb-4">
                  <p>Are you sure you want to delete this project? <br /> This action cannot be undone.</p>
                </div>
                <!-- Modal Footer -->
                <div class="flex justify-end">
                  <button @click="showModal = false" class="btn btn-outline mr-2">Cancel</button>
                  <form method="POST" action="/projects/<?= $project->id ?>" class="inline-flex items-center">
                    <?= csrf_field() ?>
                    <?= method_field('DELETE') ?>
                    <button class="btn btn-error bg-red-500 text-white" type="submit">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
