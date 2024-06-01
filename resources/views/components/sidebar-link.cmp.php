<nav class="p-6 w-full flex flex-col flex-wrap" aria-label="aside navigation">
  <ul class="space-y-1.5">
    <li>
      <a class="<?= route('/dashboard') ? 'bg-primary text-white' : 'hover:bg-primary hover:text-slate-50' ?> flex items-center gap-x-3.5 py-2 px-2.5  text-sm  text-neutral-700 rounded-lg " href="/dashboard">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard">
          <rect width="7" height="9" x="3" y="3" rx="1" />
          <rect width="7" height="5" x="14" y="3" rx="1" />
          <rect width="7" height="9" x="14" y="12" rx="1" />
          <rect width="7" height="5" x="3" y="16" rx="1" />
        </svg>
        Dashboard
      </a>
    </li>

    <li>
      <a class="<?= uriContains('/projects') ? 'bg-primary text-white' : 'hover:bg-primary hover:text-slate-50' ?> flex items-center gap-x-3.5 py-2 px-2.5  text-sm  text-neutral-700 rounded-lg " href="/projects">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hotel">
          <path d="M10 22v-6.57" />
          <path d="M12 11h.01" />
          <path d="M12 7h.01" />
          <path d="M14 15.43V22" />
          <path d="M15 16a5 5 0 0 0-6 0" />
          <path d="M16 11h.01" />
          <path d="M16 7h.01" />
          <path d="M8 11h.01" />
          <path d="M8 7h.01" />
          <rect x="4" y="2" width="16" height="20" rx="2" />
        </svg>
        Projects
      </a>

    <li>
      <a class="<?= uriContains('/messages') ? 'bg-primary text-white' : 'hover:bg-primary hover:text-slate-50' ?> flex items-center gap-x-3.5 py-2 px-2.5  text-sm  text-neutral-700 rounded-lg " href="/messages">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle-more">
          <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
          <path d="M8 12h.01" />
          <path d="M12 12h.01" />
          <path d="M16 12h.01" />
        </svg>
        Messages
      </a>
    </li>

    <li>
      <a class="<?= uriContains('/reviews') ? 'bg-primary text-white' : 'hover:bg-primary hover:text-slate-50' ?> flex items-center gap-x-3.5 py-2 px-2.5  text-sm  text-neutral-700 rounded-lg " href="/reviews">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star">
          <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
        </svg>
        Reviews
      </a>
    </li>
    <li>
      <a class="<?= uriContains('/architect') ?> ? 'bg-primary text-white' : 'hover:bg-primary hover:text-slate-50' ?> flex items-center gap-x-3.5 py-2 px-2.5  text-sm  text-neutral-700 rounded-lg " href="/architect">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round">
          <path d="M18 21a8 8 0 0 0-16 0" />
          <circle cx="10" cy="8" r="5" />
          <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
        </svg>
        Architects
      </a>
    </li>
  </ul>
</nav>
