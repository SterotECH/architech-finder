<?php resource('dashboard/header') ?>

<!-- ========== MAIN CONTENT ========== -->
<div x-data="{ sidebarToggle: false }" class="relative">
  <div class="lg:hidden">
    <button @click="sidebarToggle = !sidebarToggle" type="button"
      class="absolute right-5 top-1 py-2 px-3 z-50 flex justify-center items-center gap-x-1.5 text-xs rounded-lg border border-gray-200 text-gray-500 hover:text-gray-600"
      aria-controls="application-sidebar"
      aria-label="Sidebar"
      >
      <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M17 8L21 12L17 16M3 12H13M3 6H13M3 18H13" />
      </svg>
      <span class="sr-only">Sidebar</span>
    </button>
  </div>
  <!-- Backdrop -->
  <div x-show="sidebarToggle" x-cloak x-transition @click="sidebarToggle = false" class="fixed inset-0 bg-white/10 backdrop-blur-sm z-40 md:hidden"></div>

  <!-- Sidebar for Mobile -->
  <div x-show="sidebarToggle" x-cloak x-transition:enter="transition ease-in-out duration-[500ms]" x-transition:enter-start="opacity-0 translate-x-[100%]" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in-out duration-[500ms]" x-transition:leave-start="opacity-100 -translate-x-100" x-transition:leave-end="opacity-0 translate-x-[100%]" @click.away="sidebarToggle = false" class="fixed top-14 right-0 bg-white w-64 z-50 shadow-lg h-screen md:hidden">
    <?php component('sidebar-link') ?>
  </div>

  <!-- Sidebar for Desktop -->
  <div class="hidden md:block">
    <?php resource('dashboard/sidebar') ?>
  </div>
</div>
<div class="w-full lg:ps-64">
  <div class="">
    <div x-data="{ sidebarToggle: $persist(false).as('sidebar_toggle') }" class="sticky top-0 inset-x-0 z-20">
      <div class="flex justify-between items-center py-2">
        <!-- Breadcrumb -->
        <ol class="ms-3 flex items-center whitespace-nowrap">
          <?php

          function generateBreadcrumbs()
          {
            $currentPath = trim($_SERVER['REQUEST_URI'], '/');
            $pathParts = explode('/', $currentPath);

            $baseURL = '/';

            $breadcrumbs = [
              [
                'label' => 'Dashboard',
                'url' => $baseURL . 'dashboard'
              ]
            ];

            if (!empty($currentPath) && $currentPath !== 'dashboard') {
              foreach ($pathParts as $index => $part) {
                $url = $baseURL . implode('/', array_slice($pathParts, 0, $index + 1));
                $breadcrumbs[] = [
                  'label' => ucfirst(str_replace('-', ' ', $part)),
                  'url' => $url
                ];
              }
            }

            return $breadcrumbs;
          }

          $breadcrumbs = generateBreadcrumbs();
          foreach ($breadcrumbs as $index => $breadcrumb) {
            if ($index !== count($breadcrumbs) - 1) {
              echo '<li class="flex items-center text-sm text-slate-800">';
              echo '<a href="' . htmlspecialchars($breadcrumb['url']) . '">' . htmlspecialchars($breadcrumb['label']) . '</a>';
              echo '<svg class="flex-shrink-0 mx-3 overflow-visible size-2.5 text-slate-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">';
              echo '<path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />';
              echo '</svg>';
              echo '</li>';
            } else {
              echo '<li class="text-sm font-semibold text-slate-800 truncate" aria-current="page">' . htmlspecialchars($breadcrumb['label']) . '</li>';
            }
          }
          ?>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- ========== END MAIN CONTENT ========== -->
