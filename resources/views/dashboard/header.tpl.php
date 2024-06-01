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
          <div
            x-show="open"
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="absolute top-12 right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg p-4 z-50"
            x-cloak
          >
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
            <img class="inline-block size-[38px] rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Description">
          </button>

          <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-in-out duration-[500ms]" x-transition:enter-start="opacity-0 translate-x-[100%]" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in-out duration-[500ms]" x-transition:leave-start="opacity-100 -translate-x-100" x-transition:leave-end="opacity-0 translate-x-[100%]" class="absolute top-16 right-1 min-w-60 shadow-md rounded-lg p-2 bg-white/10 backdrop-blur-lg" aria-labelledby="-with-header" x-cloak>
            <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg">
              <p class="text-sm text-gray-500 ">Signed in as</p>
              <p class="text-sm font-medium text-gray-800"><?= auth()->user()->email ?></p>
            </div>
            <div class="mt-2 py-2 first:pt-0 last:pb-0">
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="#">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                  <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                </svg>
                Newsletter
              </a>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="#">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                  <path d="M3 6h18" />
                  <path d="M16 10a4 4 0 0 1-8 0" />
                </svg>
                Purchases
              </a>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="#">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242" />
                  <path d="M12 12v9" />
                  <path d="m8 17 4 4 4-4" />
                </svg>
                Downloads
              </a>
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500" href="#">
                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                  <circle cx="9" cy="7" r="4" />
                  <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                  <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                Team Account
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
