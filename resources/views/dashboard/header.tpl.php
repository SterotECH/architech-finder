<?php resource('layouts/master') ?>
<header class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full border-b text-sm py-2.5 sm:py-4 lg:ps-64 bg-neutral-50/10 backdrop-blur-lg">
  <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6" aria-label="Global">
    <div class="me-5 lg:me-0 lg:hidden">
      <!-- Logo -->
      <?php component('logo') ?>
      <!-- End Logo -->
    </div>

    <div class="w-full flex items-center justify-end ms-auto sm:justify-between sm:gap-x-3 sm:order-3">
      <div class="sm:hidden">
        <button type="button" class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8" />
            <path d="m21 21-4.3-4.3" />
          </svg>
        </button>
      </div>

      <div></div>

      <div class="flex flex-row items-center justify-end gap-2">
        <div class="" x-data="{open: $persist(false).as('notification_toggle')}">
          <button @click="open = !open" type="button" class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
              <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
            </svg>
          </button>
          <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute top-12 right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg p-4 z-50" x-cloak>
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Notifications</h3>
            <ul>
              <li class="p-2 hover:bg-gray-100 rounded-md">
                <a href="#" class="text-gray-600 text-sm">Notification 1</a>
              </li>
              <li class="p-2 hover:bg-gray-100 rounded-md">
                <a href="#" class="text-gray-600 text-sm">Notification 2</a>
              </li>
              <li class="p-2 hover:bg-gray-100 rounded-md">
                <a href="#" class="text-gray-600 text-sm">Notification 3</a>
              </li>
            </ul>
          </div>
        </div>

        <div x-data="{ open: $persist(false).as('user_toggle') }" class=" [--placement:bottom-right] relative inline-flex">
          <button @click="open = !open" type="button" class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
            <img class="inline-block size-[38px] rounded-full ring-2 ring-white object-cover" src="<?= auth()->user()->avatar ?>" alt="Description">
          </button>

          <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-in-out duration-[500ms]" x-transition:enter-start="opacity-0 translate-x-[100%]" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in-out duration-[500ms]" x-transition:leave-start="opacity-100 -translate-x-100" x-transition:leave-end="opacity-0 translate-x-[100%]" class="absolute top-16 right-1 min-w-60 shadow-md rounded-lg p-2 bg-white/10 backdrop-blur-lg" aria-labelledby="-with-header" x-cloak>
            <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg">
              <p class="text-sm text-gray-500 ">Signed in as</p>
              <p class="text-sm font-medium text-gray-800"><?= auth()->user()->email ?></p>
            </div>
            <div class="mt-2 py-2 first:pt-0 last:pb-0">
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-cog">
                  <circle cx="18" cy="15" r="3" />
                  <circle cx="9" cy="7" r="4" />
                  <path d="M10 15H6a4 4 0 0 0-4 4v2" />
                  <path d="m21.7 16.4-.9-.3" />
                  <path d="m15.2 13.9-.9-.3" />
                  <path d="m16.6 18.7.3-.9" />
                  <path d="m19.1 12.2.3-.9" />
                  <path d="m19.6 18.7-.4-1" />
                  <path d="m16.8 12.3-.4-1" />
                  <path d="m14.3 16.6 1-.4" />
                  <path d="m20.7 13.8 1-.4" />
                </svg>
                Profile
              </a>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings">
                  <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                  <circle cx="12" cy="12" r="3" />
                </svg>
                Settings
              </a>
              <form method="POST" action="/auth/logout" class="flex items-center gax-x-3.5" href="#">
                <?= csrf_field() ?>
                <?= method_field('DELETE') ?>
                <button class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" x2="9" y1="12" y2="12" />
                  </svg>
                  Logout
                </button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
