<div class="group select-none cursor-pointer transition ease-in-out delay-50 duration-300" firstName="<?= $architect['first_name'] ?>" lastName="<?= $architect['first_name'] ?>" x-data="{ front: true }" title="<?= $architect['first_name'] . ' ' . $architect['last_name']; ?> | <?= $architect['speciality']; ?> | <?= $architect['years_of_experience']; ?> Years Experience" x-cloak>
  <div class="aspect-w-7 aspect-h-8">
    <div @click="front = ! front">
      <div class="relative w-full h-full">
        <img class="object-cover w-full h-full transition delay-50 duration-300 grayscale group-hover:grayscale-0 bg-white"
        src="<?= $architect['avatar'] ?>"
        alt="<?= $architect['first_name'] . ' ' . $architect['last_name']; ?>"
        title="<?= $architect['first_name'] . ' ' . $architect['last_name']; ?> | <?= $architect['speciality']; ?> | <?= $architect['years_of_experience']; ?> Years Experience">

        <div class="absolute z-10 cursor-pointer top-4 right-4 text-yellow">
          <svg class="flex-shrink-0 w-8 h-8" aria-label="Tighten logo" id="icon-tighten-mark-filled" viewBox="0 0 104.8774 106.3796">
            <polygon points="71.986 44.467 60.893 33.762 60.893 0 43.774 0 43.774 33.681 32.585 44.467 0 44.467 0 62.028 32.663 62.028 43.774 72.726 43.774 106.38 60.893 106.38 60.893 72.725 71.986 62.028 104.877 62.028 104.877 44.467 71.986 44.467" style="fill: currentColor" />
          </svg>
        </div>

        <div class="absolute z-10 bottom-4 left-7 right-7">
          <h3 class="pb-2 font-serif text-3xl text-white font-extralight text-shadow leading-tight-2 2xl:text-4xl 2xl:leading-tight-2" title="<?= $architect['first_name'] . ' ' . $architect['last_name']; ?> | <?= $architect['speciality']; ?> | <?= $architect['years_of_experience']; ?> Years Experience">
            <?= $architect['first_name'] ?><br><?= $architect['first_name'] ?>
          </h3>
          <p class="font-mono text-sm font-bold tracking-widest uppercase word-spacing-tight text-yellow" title="<?= $architect['first_name'] . ' ' . $architect['last_name']; ?> | <?= $architect['speciality']; ?> | <?= $architect['years_of_experience']; ?> Years Experience">
            <?= $architect['speciality']; ?> | <?= $architect['years_of_experience']; ?> Years Experience
          </p>
        </div>
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-b from-transparent to-black h-1/3 opacity-80"></div>
      </div>
      <div x-show="! front" x-transition:enter="transition-all duration-300 ease-out" x-transition:enter-start="opacity-0 clip-path-circle-closed" x-transition:enter-end="opacity-100 clip-path-circle-open" x-transition:leave="transition-all duration-300 ease-in" x-transition:leave-start="opacity-100 clip-path-circle-open" x-transition:leave-end="opacity-0 clip-path-circle-closed" class="absolute inset-0 z-20 h-full py-5 bg-yellow px-7">
        <div class="font-mono font-bold word-spacing-tight tracking-widest uppercase text-sm leading-none text-yellow-800 pt-0.5">
          Featured Contributions
        </div>

        <div class="flex flex-col pt-4 space-y-3">
          <a onclick="event.stopPropagation()" class="group" href="/">
            <div class="flex border  border-yellow-800 transition-colors hover:bg-yellow-400">
              <div class="flex items-center justify-center flex-none text-black border-r border-black w-14">
                <svg viewBox="0 0 28 28" fill="none" stroke="none" class="w-8 h-8 md:w-10 md:h-10" aria-hidden="true">
                  <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M22.6742 2.1564C23.0945 1.73611 23.6645 1.5 24.2589 1.5C24.8532 1.5 25.4233 1.73611 25.8436 2.1564C26.2638 2.57669 26.5 3.14672 26.5 3.74109C26.5 4.33546 26.2638 4.90549 25.8436 5.32578L13.666 17.5034L9.44011 18.5598L10.4966 14.334L22.6742 2.1564ZM24.2589 0.5C23.3993 0.5 22.5749 0.841471 21.9671 1.44929L9.69154 13.7248C9.62746 13.7889 9.582 13.8692 9.56002 13.9571L8.26786 19.1258C8.22526 19.2962 8.27519 19.4764 8.39938 19.6006C8.52357 19.7248 8.70381 19.7747 8.8742 19.7321L14.0428 18.4399C14.1308 18.418 14.2111 18.3725 14.2751 18.3084L26.5507 6.03288C27.1585 5.42506 27.5 4.60068 27.5 3.74109C27.5 2.8815 27.1585 2.05711 26.5507 1.44929C25.9428 0.841471 25.1185 0.5 24.2589 0.5ZM3.58432 3.24097C2.76631 3.24097 1.9818 3.56592 1.40338 4.14434C0.824954 4.72277 0.5 5.50728 0.5 6.32529V24.4156C0.5 25.2336 0.824955 26.0181 1.40338 26.5965C1.9818 27.1749 2.76631 27.4999 3.58432 27.4999H21.6746C22.4926 27.4999 23.2771 27.1749 23.8555 26.5965C24.434 26.0181 24.7589 25.2336 24.7589 24.4156V15.3704C24.7589 15.0943 24.5351 14.8704 24.2589 14.8704C23.9828 14.8704 23.7589 15.0943 23.7589 15.3704V24.4156C23.7589 24.9684 23.5393 25.4985 23.1484 25.8894C22.7575 26.2803 22.2274 26.4999 21.6746 26.4999H3.58432C3.03153 26.4999 2.50137 26.2803 2.11048 25.8894C1.7196 25.4985 1.5 24.9684 1.5 24.4156V6.32529C1.5 5.77249 1.7196 5.24234 2.11048 4.85145C2.50137 4.46056 3.03153 4.24097 3.58432 4.24097H12.6295C12.9056 4.24097 13.1295 4.01711 13.1295 3.74097C13.1295 3.46482 12.9056 3.24097 12.6295 3.24097H3.58432Z" />
                </svg>
              </div>

              <div class="flex flex-col justify-center py-2 pl-3 pr-2 overflow-hidden md:py-3">
                <div class="pb-1 font-mono text-lg font-semibold leading-none tracking-tight text-black truncate word-spacing-tight">
                  Accra
                </div>

                <div class="font-mono text-xs font-bold leading-none tracking-widest text-yellow-800 uppercase word-spacing-tight">
                  Ghana
                </div>
              </div>
            </div>
          </a>
          <a onclick="event.stopPropagation()" class="group" href="<?= $architect['portfolio_link']; ?>">
            <div class="flex border border-yellow-800 transition-colors hover:bg-yellow-400">
              <div class="flex items-center justify-center flex-none text-black border-r border-black w-14">
                <svg viewBox="0 0 28 28" fill="none" stroke="none" class="w-8 h-8 md:w-10 md:h-10" aria-hidden="true">
                  <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M22.6742 2.1564C23.0945 1.73611 23.6645 1.5 24.2589 1.5C24.8532 1.5 25.4233 1.73611 25.8436 2.1564C26.2638 2.57669 26.5 3.14672 26.5 3.74109C26.5 4.33546 26.2638 4.90549 25.8436 5.32578L13.666 17.5034L9.44011 18.5598L10.4966 14.334L22.6742 2.1564ZM24.2589 0.5C23.3993 0.5 22.5749 0.841471 21.9671 1.44929L9.69154 13.7248C9.62746 13.7889 9.582 13.8692 9.56002 13.9571L8.26786 19.1258C8.22526 19.2962 8.27519 19.4764 8.39938 19.6006C8.52357 19.7248 8.70381 19.7747 8.8742 19.7321L14.0428 18.4399C14.1308 18.418 14.2111 18.3725 14.2751 18.3084L26.5507 6.03288C27.1585 5.42506 27.5 4.60068 27.5 3.74109C27.5 2.8815 27.1585 2.05711 26.5507 1.44929C25.9428 0.841471 25.1185 0.5 24.2589 0.5ZM3.58432 3.24097C2.76631 3.24097 1.9818 3.56592 1.40338 4.14434C0.824954 4.72277 0.5 5.50728 0.5 6.32529V24.4156C0.5 25.2336 0.824955 26.0181 1.40338 26.5965C1.9818 27.1749 2.76631 27.4999 3.58432 27.4999H21.6746C22.4926 27.4999 23.2771 27.1749 23.8555 26.5965C24.434 26.0181 24.7589 25.2336 24.7589 24.4156V15.3704C24.7589 15.0943 24.5351 14.8704 24.2589 14.8704C23.9828 14.8704 23.7589 15.0943 23.7589 15.3704V24.4156C23.7589 24.9684 23.5393 25.4985 23.1484 25.8894C22.7575 26.2803 22.2274 26.4999 21.6746 26.4999H3.58432C3.03153 26.4999 2.50137 26.2803 2.11048 25.8894C1.7196 25.4985 1.5 24.9684 1.5 24.4156V6.32529C1.5 5.77249 1.7196 5.24234 2.11048 4.85145C2.50137 4.46056 3.03153 4.24097 3.58432 4.24097H12.6295C12.9056 4.24097 13.1295 4.01711 13.1295 3.74097C13.1295 3.46482 12.9056 3.24097 12.6295 3.24097H3.58432Z" />
                </svg>
              </div>

              <div class="flex flex-col justify-center py-2 pl-3 pr-2 overflow-hidden md:py-3">
                <div class="pb-1 font-mono text-lg font-semibold leading-none tracking-tight text-black truncate word-spacing-tight">
                  Projects Completed
                </div>

                <div class="font-mono text-xs font-bold leading-none tracking-widest text-yellow-800 uppercase word-spacing-tight">
                  30
                </div>
              </div>
            </div>
          </a>
          <a onclick="event.stopPropagation()" class="group hidden lg:block" href="/">
            <div class="flex border border-yellow-800 transition-colors hover:bg-yellow-400 line-clamp-4">
              <div class="flex flex-col justify-center py-2 pl-3 pr-2 overflow-hidden md:py-3">
                <div class="pb-1 font-mono text-lg font-semibold leading-none tracking-tight text-black truncate word-spacing-tight">
                  A passionate architect with a knack for innovative designs and sustainable solutions
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="absolute z-10 bottom-4 left-7 right-7">
          <h3 class="pb-1 font-serif text-3xl text-black sm:pb-2 font-extralight leading-tight-2 2xl:text-4xl 2xl:leading-tight-2" title="<?= $architect['first_name'] . ' ' . $architect['last_name']; ?> | <?= $architect['speciality']; ?> | <?= $architect['years_of_experience']; ?> Years Experience">
            <?= $architect['first_name'] ?><br><?= $architect['last_name'] ?>
          </h3>

          <p class="font-mono text-sm font-bold tracking-widest text-yellow-800 uppercase word-spacing-tight" title="<?= $architect['first_name'] . ' ' . $architect['last_name']; ?> | <?= $architect['speciality']; ?> | <?= $architect['years_of_experience']; ?> Years Experience">
            <?= $architect['speciality']; ?> | <?= $architect['years_of_experience']; ?> Years Experience
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
