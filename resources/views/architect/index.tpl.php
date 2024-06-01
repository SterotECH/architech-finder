@resource('layouts/master')
@component("resources/views/components/header.cmp.php");
<div class="max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16 mx-auto">
    <div class="text-yellow-700" id="content">
        <div class="max-w-screen-2xl mx-auto">
            <h1 class="font-serif font-extralight mb-0 text-6xl xs:text-8xl sm:text-10xl md:text-11xl lg:text-12xl" title="Team">
                Our Architects
            </h1>

            <h2 class="w-full mb-2 font-serif text-2xl leading-snug font-extralight sm:text-3xl sm:leading-snug md:text-4xl md:leading-snug lg:mb-6">
                The people that make us who we are, and make it a joy to come into work every day.
            </h2>
        </div>
    </div>
    <div class="py-4 flex justify-between items-center border-t border-gray-200">
    <div class="w-3/4">
    <form method="GET" class="mb-6 flex items-center">
        <input type="search" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Search" class="input w-1/3 mr-2">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    </div>

    <details class="dropdown">
        <summary class="m-1 btn">Filter By Speciality</summary>
        <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
            <li><a>Item 1</a></li>
            <li><a>Item 2</a></li>
        </ul>
    </details>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
        <?php foreach ($architects as $architect) : ?>
            @component("resources/views/components/architect-card.cmp.php")
        <?php endforeach; ?>
    </div>
    <!-- Pagination -->
    <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
        <div>
            <p class="text-sm text-gray-600 ">
            Page <span class="font-semibold text-gray-800"><?= $page ?> of <?= $totalPages ?></span> out of <span class="font-semibold text-gray-800"><?= $totalItems ?></span> Architects
            </p>
        </div>
        <div class="flex">
            <?php if ($page > 1) : ?>
                <button type="button" onclick="window.location.href='?page=<?= $page - 1 ?>&q=<?= urlencode($search) ?>'" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                    Prev
                </button>
            <?php endif; ?>
            <?php if ($page < $totalPages) : ?>
                <button type="button" onclick="window.location.href='?page=<?= $page + 1 ?>&q=<?= urlencode($search) ?>'" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                    Next
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </button>
            <?php endif; ?>
        </div>
    </div>

</div>
@resource('layouts/footer')
