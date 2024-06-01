@resource('dashboard/master')
<section class="w-full lg:ps-64">
  <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
    <!-- Start coding here -->
    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
        <div class="w-full md:w-1/2">
          <form class="flex items-center">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
              </div>
              <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2" placeholder="Search" required="">
            </div>
          </form>
        </div>
        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
          <?php if (auth()->user()->role ===  App\Enums\UserRole::CLIENT->value) : ?>
            <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href = '/projects/create'">
              <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
              </svg>
              Create product
            </button>
          <?php endif ?>
          <?php if (auth()->user()->role ===  App\Enums\UserRole::ARCHITECT->value) : ?>
            <div class="flex items-center space-x-3 w-full md:w-auto">
              <div x-data="{ isOpen: false, selectedUserId: null }">
                <button @click="isOpen = !isOpen" id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="btn btn-outline btn-sm" type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                  </svg>
                  Filter by User
                  <svg x-bind:class="{'rotate-180': isOpen}" class="-mr-1 ml-1.5 w-5 h-5 transition-transform transform" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                  </svg>
                </button>
                <div x-show="isOpen" @click.away="isOpen = false" id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                  <h6 class="mb-3 text-sm font-medium text-gray-900">Choose User</h6>
                  <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                    <?php foreach ($users as $user) : ?>
                      <li class="flex items-center">
                        <input id="user_<?= $user->id ?>" type="checkbox" value="<?= $user->id ?>" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500" x-on:click="selectedUserId = $event.target.value" <?= ($user->id == $selectedUserId) ? 'checked' : '' ?>>
                        <label for="user_<?= $user->id ?>" class="ml-2 text-sm font-medium text-gray-900"><?= $user->name ?></label>
                      </li>
                    <?php endforeach ?>
                  </ul>
                </div>
              </div>
            </div>
          <?php endif ?>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <?php if (auth()->user()->role === \App\Enums\UserRole::ARCHITECT->value) : ?>
                <th scope="col" class="px-4 py-3">Client</th>
              <?php endif ?>
              <th scope="col" class="px-4 py-3">Project</th>
              <th scope="col" class="px-4 py-3">Description</th>
              <th scope="col" class="px-4 py-3">Status</th>
              <th scope="col" class="px-4 py-3">
                <span class="sr-only">Actions</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($projects as $project) : ?>

              <tr class="border-b items-center">
                <?php if (auth()->user()->role === \App\Enums\UserRole::ARCHITECT->value) : ?>
                  <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                    <div class="flex items-center gap-x-3">
                      <img class="inline-block size-[38px] rounded-full object-cover" src="<?= $project->avatar ?>" alt="Client Avatar">
                      <div class="grow">
                        <span class="block text-sm font-semibold text-gray-800"><?= $project->first_name . ' ' . $project->last_name ?></span>
                        <span class="block text-sm text-gray-500"><?= $project->email ?></span>
                      </div>
                    </div>
                  </th>
                <?php endif ?>
                <td class="px-4 py-3">
                  <span class="block text-sm font-semibold text-gray-800">
                    <?= $project->title ?>
                  </span>
                  <span class="text-sm text-gray-500 inline-flex items-center py-1 line-clamp-1">
                    <?= \App\Enums\ProjectType::from($project->type)->getIcon() ?>
                    <?= \App\Enums\ProjectType::from($project->type)->getLabel() ?>
                  </span>
                </td>
                <td class="px-4 py-3">
                  <span class="block text-sm font-semibold text-gray-800">
                    <?= substr($project->description, 0, 50) ?>...
                  </span>
                </td>
                <td class="px-4 py-3">
                  <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium <?= \App\Enums\ProjectStatus::from($project->status)->getColor() ?> <?= \App\Enums\ProjectStatus::from($project->status)->getTextColor() ?> rounded-full line-clamp-1">
                    <?= \App\Enums\ProjectStatus::from($project->status)->getSVG() ?>
                    <?= \App\Enums\ProjectStatus::from($project->status)->getLabel() ?>
                  </span>
                </td>
                <td class="px-4 py-3">

                  <a class="inline-flex items-center btn btn-secondary btn-sm" href="/projects/<?= $project->slug ?>">
                    View
                  </a>
                </td>

              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
      <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 ">
          Showing
          <span class="font-semibold text-gray-900">1-10</span>
          of
          <span class="font-semibold text-gray-900">1000</span>
        </span>

      </nav>
    </div>
  </div>
</section>
