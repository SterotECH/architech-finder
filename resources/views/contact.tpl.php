@resource('layouts/master')
@component("resources/views/components/header.cmp.php")
<div class="absolute inset-0 flex -z-10 bg-black">
</div>
<div>
  <div class="px-6 md:px-16 lg:px-28 pt-4 pb-12 text-white bg-black sm:py-12 lg:py-20">
    <div class="max-w-screen-2xl mx-auto">
      <div class="flex items-center">
        <div class="sm:w-2/3">
          <h2 class="font-serif text-4xl font-extralight text-charcoal-40 lg:text-5xl 2xl:text-6xl">
            Ready to chat?
          </h2>

          <h1 class="mb-6 font-serif text-7xl lg:text-8xl xl:text-9xl 2xl:text-10xl font-extralight md:mb-10 xl:mb-12">
            Contact us
          </h1>

          <div class="w-full mb-2 font-serif text-xl leading-snug font-extralight sm:text-2xl sm:leading-snug xl:text-3xl xl:leading-snug lg:mb-6 text-charcoal-30">
            Send us a note below, or email us
            <br class="xl:hidden">
            at <a href="mailto:agyeisterogh@gmail.como" aria-label="email address" class="underline decoration-1 decoration-charcoal-40 underline-offset-8 text-yellow hover:decoration-yellow">agyeisterogh@gmail.com</a>.
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="px-6 md:px-16 lg:px-28 py-0 bg-black text-charcoal-10">
    <div class="max-w-screen-2xl mx-auto px-6 py-8 bg-[#1a1a1a] sm:py-8 sm:px-12 lg:py-12 lg:px-16">
      <div class="max-w-5xl mx-auto">
        <form action="https://fieldgoal.io/f/AGz9ZcOcd0nXSBLM38wsGiiTkLhuaUxZ" method="POST" x-show="! submitted" @recaptcha-submitted.window="submitForm">
          <div class="mb-20 grid grid-cols-2 gap-y-10 sm:gap-y-6 gap-x-10 sm:mb-12">
            <div class="relative col-span-2 lg:col-span-1 text-white/90 focus-within:text-yellow-500">
              <label for="first_name" class="items-center justify-between absolute left-0 -bottom-8 sm:bottom-0 pb-2.5 block text-sm sm:text-lg font-serif">
                First name
              </label>

              <input id="first_name" class="block w-full py-1 pl-0 pr-0 mt-1 font-mono text-lg tracking-tight text-white bg-transparent border-t-0 rounded-none word-spacing-tighter border-x-0 border-b-white/90 focus:outline-none focus:ring-transparent focus:text-white focus:border-b-yellow-500 md:text-2xl selection:bg-charcoal-70 sm:pl-32 lg:pl-36 sm:py-2">
            </div>

            <div class="relative col-span-2 lg:col-span-1 text-white/90 focus-within:text-yellow-500">
              <input id="url" class="absolute -mx-[86127px] font-mono word-spacing-tighter tracking-tight border-t-0 border-x-0 border-b-white/90 mt-1 focus:outline-none focus:ring-transparent text-white focus:text-white focus:border-b-yellow-500 block w-full text-lg md:text-2xl rounded-none bg-transparent selection:bg-charcoal-70 pl-0 sm:pl-32 lg:pl-36 pr-0 py-1 sm:py-2" type="text" name="url" tabindex="-1" autocomplete="off" aria-hidden="true">
              <label for="last_name" class="items-center justify-between absolute left-0 -bottom-8 sm:bottom-0 pb-2.5 block text-sm sm:text-lg font-serif">
                Last name
              </label>

              <input id="last_name" class="block w-full py-1 pl-0 pr-0 mt-1 font-mono text-lg tracking-tight text-white bg-transparent border-t-0 rounded-none word-spacing-tighter border-x-0 border-b-white/90 focus:outline-none focus:ring-transparent focus:text-white focus:border-b-yellow-500 md:text-2xl selection:bg-charcoal-70 sm:pl-32 lg:pl-36 sm:py-2" type="text" name="last_name" autocomplete="family-name" autocorrect="off" autocapitalize="sentences" spellcheck="false">
            </div>

            <div class="relative col-span-2 text-white/90 focus-within:text-yellow-500">
              <label for="email" class="items-center justify-between absolute left-0 -bottom-8 sm:bottom-0 pb-2.5 block text-sm sm:text-lg font-serif">
                Email
              </label>
              <input id="email" class="block w-full py-1 pl-0 pr-0 mt-1 font-mono text-lg tracking-tight text-white bg-transparent border-t-0 rounded-none word-spacing-tighter border-x-0 border-b-white/90 focus:outline-none focus:ring-transparent focus:text-white focus:border-b-yellow-500 md:text-2xl selection:bg-charcoal-70 sm:pl-32 lg:pl-20 sm:py-2" type="email" name="email" autocomplete="email" autocorrect="off" autocapitalize="off" spellcheck="false" />
            </div>
          </div>

          <div class="flex mb-12 space-x-10">
            <div class="relative w-full text-white/90 focus-within:text-yellow-500">
              <label for="message" class="flex items-center justify-between w-full font-serif text-sm sm:text-lg">
                Tell us about your idea:
              </label>
              <textarea id="message" class="block w-full px-4 py-3 mt-3 font-mono tracking-tight text-white bg-transparent rounded-none word-spacing-tighter border-white/90 focus:outline-none focus:ring-transparent focus:text-white focus:border-yellow-500 md:text-lg lg:text-xl selection:bg-yellow-500" rows="5" name="message" autocomplete="off" autocorrect="off" autocapitalize="sentences" spellcheck="false" x-model="form.message" @input="checkError('message')" data-gramm="false" wt-ignore-input="true"></textarea>
            </div>
          </div>

          <div class="flex mb-12 space-x-10">
            <div class="relative w-full text-white/90 flex items-center">
              <label class="flex items-center cursor-pointer">
                <input id="subscribe_to_newsletter" name="subscribe_to_newsletter" type="checkbox" class="cursor-pointer object-left align-middle h-8 w-8 bg-transparent border-white/90 focus:outline-none focus:ring-transparent focus:border-yellow-500 checked:bg-transparent checked:border-yellow-500">

                <span class="object-left align-middle mx-4 font-serif text-sm sm:text-lg leading-tight text-wrap whitespace-normal">Sign me up to receive occasional email insights from us</span>
              </label>
            </div>
          </div>

          <div class="flex mb-12 space-x-10">
            <div class="relative w-full text-white/90 text-xs">
              <p>By submitting this form, you acknowledge our <a href="/privacy-policy" class="underline hover:text-yellow-500">Privacy Notice</a>.</p>
            </div>
          </div>

          <div class="flex justify-end w-full mt-10 mb-6">
            <div class="flex">
              <a class="rounded-full appearance-none cursor-pointer" aria-label="Submit" type="submit" tabindex="0">
                <div class="text-sm md:text-base box-border transition-colors duration-300 font-mono word-spacing-tight font-bold tracking-widest rounded-full py-3 px-6 uppercase leading-none
                bg-yellow-500 hover:bg-white text-black">
                  <span class="px-4">Send Message</span>
                </div>
              </a>
            </div>
          </div>
        </form>

        <div x-show="submitted" style="display: none;">
          <div class="py-12 font-serif text-center font-extralight">
            <h1 class="mb-10 text-5xl sm:text-6xl text-yellow-500">Thank you!</h1>

            <p class="font-mono text-xl sm:text-2xl">
              We appreciate your interest. <br class="hidden sm:block xl:hidden">We will get right back to you.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@resource('layouts/footer')
