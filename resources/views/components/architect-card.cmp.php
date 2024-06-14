<div class="team-card-animate-in">
  <div class="group select-none cursor-pointer transition ease-in-out delay-50 duration-300 relative" firstName="<?= $architect->first_name ?>" lastName="<?= $architect->first_name ?>" x-data="{ front: true }" title="<?= $architect->first_name . ' ' . $architect->last_name; ?> | <?= $architect->qualifications; ?> | <?= $architect->experience; ?> Years Experience" x-cloak>
    <div class="h-[480px] w-[385px]">
      <div @click="front = ! front">
        <div class="relative w-full h-full">
          <img class="object-cover h-[487px] w-[390px] transition delay-50 duration-300 grayscale group-hover:grayscale-0 bg-black" src="<?= $architect->avatar ?>" alt="<?= $architect->first_name . ' ' . $architect->last_name; ?>" title="<?= $architect->first_name . ' ' . $architect->last_name; ?> | <?= $architect->qualifications; ?> | <?= $architect->experience; ?> Years Experience">

          <div class="absolute z-10 cursor-pointer top-4 right-4 text-yellow-500">
            <svg class="flex-shrink-0 w-8 h-8" id="icon-tighten-mark-filled" viewBox="0 0 104.8774 106.3796">
              <polygon points="71.986 44.467 60.893 33.762 60.893 0 43.774 0 43.774 33.681 32.585 44.467 0 44.467 0 62.028 32.663 62.028 43.774 72.726 43.774 106.38 60.893 106.38 60.893 72.725 71.986 62.028 104.877 62.028 104.877 44.467 71.986 44.467" style="fill: currentColor" />
            </svg>
          </div>

          <div class="absolute z-10 bottom-4 left-7 right-7">
            <h3 class="pb-2 font-serif text-3xl text-white font-extralight text-shadow leading-tight-2 2xl:text-4xl 2xl:leading-tight-2" title="<?= $architect->first_name . ' ' . $architect->last_name; ?> | <?= $architect->qualifications; ?> | <?= $architect->experience; ?> Years Experience">
              <?= $architect->first_name ?><br><?= $architect->last_name ?>
            </h3>
            <p class="font-mono text-sm font-bold tracking-widest uppercase word-spacing-tight text-yellow" title="<?= $architect->first_name . ' ' . $architect->last_name; ?> | <?= $architect->qualifications; ?> | <?= $architect->experience; ?> Years Experience">
              <?= $architect->qualifications; ?> | <?= $architect->experience; ?> Years Experience
            </p>
          </div>
          <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-b from-transparent to-yellow-700 h-1/3 opacity-80"></div>
        </div>
        <div x-show="! front" x-transition:enter="transition-all duration-300 ease-out" x-transition:enter-start="opacity-0 clip-path-circle-closed" x-transition:enter-end="opacity-100 clip-path-circle-open" x-transition:leave="transition-all duration-300 ease-in" x-transition:leave-start="opacity-100 clip-path-circle-open" x-transition:leave-end="opacity-0 clip-path-circle-closed" class="absolute inset-0 z-20 h-full py-5 bg-yellow-600 px-7 scale-y-105 transition-all duration-500 ease-in-out animate-['clip-path-circle-open']">
          <div class="font-mono font-bold word-spacing-tight tracking-widest uppercase text-sm leading-none text-yellow-800 pt-0.5 ">
            Profile Information
          </div>

          <div class="flex flex-col pt-4 space-y-3">
            <a onclick="event.stopPropagation()" class="group" href="/architect/1">
              <div class="flex border border-yellow-800 transition-colors hover:bg-yellow-400">

                <div class="flex flex-col justify-center py-2 pl-3 pr-2 overflow-hidden md:py-3">
                  <div class="pb-1 font-mono text-lg font-semibold leading-none tracking-tight text-black truncate word-spacing-tight">
                    View Profile
                  </div>

                  <div class="font-mono text-xs font-bold leading-none tracking-widest text-yellow-800 uppercase word-spacing-tight line-clamp-1">
                    <?= $architect->portfolio_link ?>
                  </div>
                </div>
              </div>
            </a>

          </div>

          <div class="absolute z-10 bottom-4 left-7 right-7">
            <h3 class="pb-1 font-serif text-3xl text-black sm:pb-2 font-extralight leading-tight-2 2xl:text-4xl 2xl:leading-tight-2" title="<?= $architect->first_name . ' ' . $architect->last_name; ?> | <?= $architect->qualifications; ?> | <?= $architect->experience; ?> Years Experience">
              <?= $architect->first_name ?><br><?= $architect->last_name ?>
            </h3>

            <p class="font-mono text-sm font-bold tracking-widest text-yellow-800 uppercase word-spacing-tight" title="<?= $architect->first_name . ' ' . $architect->last_name; ?> | <?= $architect->qualifications; ?> | <?= $architect->experience; ?> Years Experience">
              <?= $architect->qualifications; ?> | <?= $architect->experience; ?> Years Experience
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
