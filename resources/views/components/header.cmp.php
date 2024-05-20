<header class="bg-white absolute top-0 z-50 backdrop-blur-md inset-x-0">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex-1 md:flex md:items-center md:gap-12">
                <a class="block text-xl font-bold" href="/">
                    <span class="sr-only">Home</span>
                    Architect Booking
                </a>
            </div>

            <div class="md:flex md:items-center md:gap-12">
                <nav aria-label="Global" class="hidden md:block">
                    <ul class="flex items-center gap-6 text-sm">
                        <li>
                            <a class="transition" href="/architect"> Browse Architect </a>
                        </li>
                        <?php if (\App\Core\Authenticator::check()): ?>
                            <li>
                                <a class="transition" href="#"> Post a Project </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

                <div class="flex items-center gap-4">
                    <div class="sm:flex sm:gap-4">
                        <?php if (!\App\Core\Authenticator::check()): ?>
                            <a class="btn btn-primary"
                               href="/auth/login">
                                Login
                            </a>

                            <div class="hidden sm:flex">
                                <a class="btn btn-outline-secondary"
                                   href="#">
                                    Register
                                </a>
                            </div>
                        <?php else: ?>
                            <a class="btn btn-primary"
                               href="/dashboard">
                                Dashboard
                            </a>
                        <?php endif; ?>
                        <div class="hidden sm:flex">
                            <a class="btn"
                               href="/about-us">
                                About Us
                            </a>
                        </div>
                    </div>

                    <div class="block md:hidden">
                        <button class="rounded bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
