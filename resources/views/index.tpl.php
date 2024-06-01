@component("resources/views/components/header.cmp.php")
<div x-data="followMouse()" @mousemove="handleMousemove" @mouseout="handleMouseout" class="relative md:-mt-[114px] w-full h-[540px] sm:h-[580px] md:h-[770px] lg:h-[880px] xl:h-[940px]">
    <div>
        <div class="absolute inset-0 flex -z-10">
            <div class="flex-1 hidden lg:block" :style="{ backgroundColor: '#' + bottomColors[0] }" style="background-color: rgb(255, 156, 182);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + bottomColors[1] }" style="background-color: rgb(241, 156, 178);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + bottomColors[2] }" style="background-color: rgb(226, 156, 173);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + bottomColors[3] }" style="background-color: rgb(212, 156, 169);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + bottomColors[4] }" style="background-color: rgb(198, 155, 164);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + bottomColors[5] }" style="background-color: rgb(184, 155, 160);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + bottomColors[6] }" style="background-color: rgb(169, 155, 155);"></div>
            <div class="flex-1 hidden lg:block" :style="{ backgroundColor: '#' + bottomColors[7] }" style="background-color: rgb(155, 155, 151);"></div>
        </div>

        <div class="absolute inset-0 flex -z-10" :style="{ opacity: topOpacity }" style="opacity: 0.865;">
            <div class="flex-1 hidden lg:block" :style="{ backgroundColor: '#' + topColors[0] }" style="background-color: rgb(195, 167, 249);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + topColors[1] }" style="background-color: rgb(189, 165, 235);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + topColors[2] }" style="background-color: rgb(184, 164, 221);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + topColors[3] }" style="background-color: rgb(178, 162, 207);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + topColors[4] }" style="background-color: rgb(172, 160, 193);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + topColors[5] }" style="background-color: rgb(166, 158, 179);"></div>
            <div class="flex-1" :style="{ backgroundColor: '#' + topColors[6] }" style="background-color: rgb(161, 157, 165);"></div>
            <div class="flex-1 hidden lg:block" :style="{ backgroundColor: '#' + topColors[7] }" style="background-color: rgb(155, 155, 151);"></div>
        </div>
    </div>
    <div class="px-6 md:px-16 lg:px-28 py-10 md:py-16 lg:py-24 h-full">
        <div class="max-w-screen-2xl mx-auto h-full flex flex-col items-start justify-center md:pt-24" id="content">
            <h1 class="font-serif text-4xl xs:text-4xl sm:text-6xl lg:text-7xl xl:text-8.5xl leading-tight-1 xs:leading-tight-1 sm:leading-tight-1 lg:leading-tight-1 xl:leading-tight-1 font-extralight">
                We <span class="italic">collaborate</span> to <span class="italic">create</span>
                <br class="hidden sm:block">
                Architecture designed with you, for you
            </h1>

            <div class="w-full my-6 tracking-snug text-base sm:text-lg md:text-xl leading-relaxed sm:leading-relaxed md:leading-relaxed xl:leading-relaxed md:my-10">
                In today’s market, the success of your business hinges on the quality of your spaces and structures.
                <br class="hidden lg:block">
                BenSkilli Trims &amp; Designs expert architects design and consult on world-class buildings and environments,
                <br class="hidden lg:block">
                helping our clients solve complex challenges and achieve remarkable results.
            </div>

            <div class="pt-2 md:pt-4">
                <div class="flex">
                    <a class="rounded-full" aria-label="See how we can help you" href="/services/">
                        <div class="text-sm sm:text-base md:text-lg box-border transition-colors duration-300 font-mono word-spacing-tight font-bold tracking-widest rounded-full py-4 px-8 sm:px-10 uppercase leading-none bg-black text-white border border-white hover:border-yellow-500 hover:bg-yellow-500 hover:text-black">
                            See how we can help you
                            <span class="inline-block -mr-2.5">→</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const t = [
        [
            '9B9B97',
            'A9A081',
            'B8A46C',
            'C6A956',
            'D4AE41',
            'E2B32B',
            'F1B716',
            'FFBC00',
        ],
        [
            'FF9CB6',
            'FFA19C',
            'FFA582',
            'FFAA68',
            'FFAE4E',
            'FFB334',
            'FFB71A',
            'FFBC00',
        ],
        [
            'ff9cb6',
            'f19cb2',
            'e29cad',
            'd49ca9',
            'c69ba4',
            'b89ba0',
            'a99b9b',
            '9b9b97',
        ],
        [
            'c3a7f9',
            'bda5eb',
            'b8a4dd',
            'b2a2cf',
            'aca0c1',
            'a69eb3',
            'a19da5',
            '9b9b97',
        ],
        [
            'c3a7f9',
            'ccaad5',
            'd4adb2',
            'ddb08e',
            'e5b36b',
            'eeb647',
            'f6b924',
            'ffbc00',
        ],
        [
            '74cae8',
            '88c8c7',
            '9cc6a6',
            'b0c485',
            'c3c263',
            'd7c042',
            'ebbe21',
            'ffbc00',
        ],
        [
            '74cae8',
            '7ac3dc',
            '7fbdd1',
            '85b6c5',
            '8aafba',
            '90a8ae',
            '95a2a3',
            '9b9b97',
        ],
        [
            'a7dd8c',
            'a5d48e',
            'a4ca8f',
            'a2c191',
            'a0b792',
            '9eae94',
            '9da495',
            '9b9b97',
        ],
        [
            'a7dd8c',
            'b4d878',
            'c0d464',
            'cdcf50',
            'd9ca3c',
            'e6c528',
            'f2c114',
            'ffbc00',
        ],
    ];
    window.followMouse = function() {
        return {
            lastDistanceFromOrigin: 0,
            opacityRatio: 0,
            topOpacity: 0,
            topOpacityIsIncreasing: !0,
            currentGradientIndex: 0,
            bottomColors: t[0],
            topColors: t[1],
            init: function() {
                this.gradient_count = t.length;
            },
            handleMousemove: function(t) {
                const a = Math.round(
                    Math.sqrt(Math.pow(t.clientX, 2) + Math.pow(t.clientY, 2))
                );
                a != this.lastDistanceFromOrigin &&
                    (this.lastDistanceFromOrigin &&
                        this.updateOpacity(Math.abs(this.lastDistanceFromOrigin - a)),
                        (this.lastDistanceFromOrigin = a));
            },
            handleMouseout: function(t) {
                this.lastDistanceFromOrigin = 0;
            },
            updateOpacity: function(t) {
                (this.opacityRatio += t / 8 / 100),
                this.opacityRatio > 1 && this.advanceToNextGradient(),
                    (this.topOpacity = this.topOpacityIsIncreasing ?
                        this.opacityRatio :
                        1 - this.opacityRatio);
            },
            advanceToNextGradient: function() {
                (this.opacityRatio = 0),
                (this.currentGradientIndex =
                    (this.currentGradientIndex + 1) % this.gradient_count),
                (this.topOpacityIsIncreasing = !this.topOpacityIsIncreasing);
                const a = (this.currentGradientIndex + 1) % this.gradient_count;
                this.topOpacityIsIncreasing ?
                    (this.topColors = t[a]) :
                    (this.bottomColors = t[a]);
            },
        };
    };
</script>


<div class="bg-neutral-900">
    <!-- Approach -->
    <div class="max-w-5xl px-4 xl:px-0 py-10 lg:pt-20  mx-auto">
        <!-- Title -->
        <div class="max-w-3xl mb-10 lg:mb-14">
            <h2 class="text-white font-semibold text-2xl md:text-4xl md:leading-tight">Our approach</h2>
            <p class="mt-1 text-neutral-400">From Blueprint to Reality: We meticulously translate your architectural vision into reality. Through in-depth research and strategic planning, we design stunning spaces that seamlessly blend functionality with technical expertise. We manage construction to ensure flawless execution.</p>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 lg:items-center">
            <div class="aspect-w-16 aspect-h-9 lg:aspect-none">
                <img class="w-full object-cover rounded-xl" src="https://images.unsplash.com/photo-1587614203976-365c74645e83?q=80&w=480&h=600&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image Description">
            </div>
            <!-- End Col -->

            <!-- Timeline -->
            <div>
                <!-- Heading -->
                <div class="mb-4">
                    <h3 class="text-xs font-medium uppercase text-[#ff0]">
                        Steps
                    </h3>
                </div>
                <!-- End Heading -->

                <!-- Item -->
                <div class="flex gap-x-5 ms-1">
                    <!-- Icon -->
                    <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                        <div class="relative z-10 size-8 flex justify-center items-center">
                            <span class="flex flex-shrink-0 justify-center items-center size-8 border border-neutral-800 text-[#ff0] font-semibold text-xs uppercase rounded-full">
                                1
                            </span>
                        </div>
                    </div>
                    <!-- End Icon -->

                    <!-- Right Content -->
                    <div class="grow pt-0.5 pb-8 sm:pb-12">
                        <p class="text-sm lg:text-base text-neutral-400">
                            <span class="text-white">Find the Right Architect:</span>
                            Browse through a curated list of experienced architects based on location, specialization, and project requirements.
                        </p>
                    </div>
                    <!-- End Right Content -->
                </div>
                <!-- End Item -->

                <!-- Item -->
                <div class="flex gap-x-5 ms-1">
                    <!-- Icon -->
                    <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                        <div class="relative z-10 size-8 flex justify-center items-center">
                            <span class="flex flex-shrink-0 justify-center items-center size-8 border border-neutral-800 text-[#ff0] font-semibold text-xs uppercase rounded-full">
                                2
                            </span>
                        </div>
                    </div>
                    <!-- End Icon -->

                    <!-- Right Content -->
                    <div class="grow pt-0.5 pb-8 sm:pb-12">
                        <p class="text-sm lg:text-base text-neutral-400">
                            <span class="text-white">Post Your Project:</span>
                            Create a project listing with details such as project type, size, budget, and timeline.
                        </p>
                    </div>
                    <!-- End Right Content -->
                </div>
                <!-- End Item -->

                <!-- Item -->
                <div class="flex gap-x-5 ms-1">
                    <!-- Icon -->
                    <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                        <div class="relative z-10 size-8 flex justify-center items-center">
                            <span class="flex flex-shrink-0 justify-center items-center size-8 border border-neutral-800 text-[#ff0] font-semibold text-xs uppercase rounded-full">
                                3
                            </span>
                        </div>
                    </div>
                    <!-- End Icon -->

                    <!-- Right Content -->
                    <div class="grow pt-0.5 pb-8 sm:pb-12">
                        <p class="text-sm md:text-base text-neutral-400">
                            <span class="text-white">Receive Proposals:</span>
                            Architects submit proposals outlining their approach, timeline, and fees for the project.
                        </p>
                    </div>
                    <!-- End Right Content -->
                </div>
                <!-- End Item -->

                <!-- Item -->
                <div class="flex gap-x-5 ms-1">
                    <!-- Icon -->
                    <div class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800">
                        <div class="relative z-10 size-8 flex justify-center items-center">
                            <span class="flex flex-shrink-0 justify-center items-center size-8 border border-neutral-800 text-[#ff0] font-semibold text-xs uppercase rounded-full">
                                4
                            </span>
                        </div>
                    </div>
                    <!-- End Icon -->

                    <!-- Right Content -->
                    <div class="grow pt-0.5 pb-8 sm:pb-12">
                        <p class="text-sm md:text-base text-neutral-400">
                            <span class="text-white">Collaborate on Your Project:</span>
                            Collaborate with your selected architect through secure messaging and file sharing.
                        </p>
                    </div>
                    <!-- End Right Content -->
                </div>
                <!-- End Item -->

                <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-[#ff0] font-medium text-sm text-neutral-800 rounded-full focus:outline-none" href="/contact">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        <path class="opacity-0 group-hover:opacity-100 group-focus:opacity-100 group-hover:delay-100 transition" d="M14.05 2a9 9 0 0 1 8 7.94"></path>
                        <path class="opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition" d="M14.05 6A5 5 0 0 1 18 10"></path>
                    </svg>
                    Schedule a call
                </a>
            </div>
            <!-- End Timeline -->
        </div>
        <!-- End Grid -->
    </div>
</div>
<!-- End Approach -->


<!-- <div class="px-6 md:px-16 lg:px-28 py-0 text-white bg-gray-500">
    <div class="max-w-screen-2xl mx-auto flex flex-col-reverse lg:flex-row">
        <div class="flex flex-col justify-end pt-12 pb-24 pr-8 text-black xl:w-2/5">
            <div class="mb-4 font-mono text-base font-bold tracking-widest uppercase word-spacing-tighter">
                Never Settle
            </div>

            <h2 class="font-serif text-6xl font-extralight lg:text-7xl leading-tight-1">
                <span class="italic">The Best Team</span>
                <br class="hidden lg:block">
                in the Business
            </h2>

            <p class="pt-8 pb-12 text-base leading-loose md:text-lg md:leading-loose">
                We’ve spent a decade assembling and nurturing the industry’s finest development team. We’re here to do the best work of our lives on behalf of your business.
            </p>

            <div class="flex flex-wrap items-center">
                <div class="flex">
                    <a class="rounded-full" aria-label="Team" href="/team/">
                        <div class="text-sm md:text-base box-border transition-colors duration-300 font-mono word-spacing-tight font-bold tracking-widest rounded-full py-3 px-6 uppercase leading-none
                bg-yellow hover:bg-white text-black">
                            Meet the Team
                            <span class="inline-block -mr-1.5">→</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="relative flex-grow">
            <div class="hidden sm:block absolute top-24 left-1/5 md:-left-1/3 xl:-left-1/4 w-[500px] text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 292 49.9">
                    <path d="M24,40.9v2.8l-1,1H20.2V46H23l1,1v2.9h1.3V47l1-1h2.8V44.7H26.3l-1-1V40.9Zm20.2,0v2.8l-1,.9H40.4v1.5h2.8l1,.9v2.9h1.4V47l.9-.9h2.8V44.6H46.5l-.9-.9V40.9Zm20.1,0v2.8l-.9.9H60.7v1.5h2.7l.9.9v2.9h1.6V47l.9-.9h2.8V44.6H66.8l-.9-.9V40.9Zm20.2,0v2.8l-.9.8H80.9v1.7h2.7l.9.8v2.9h1.6V47l.9-.8h2.8V44.5H87l-.9-.8V40.9Zm20.2,0v2.8l-.8.8h-2.8v1.8h2.8l.8.7v2.9h1.7V47l.8-.7H110V44.5h-2.8l-.8-.8V40.9Zm20.2,0v2.8l-.8.8h-2.8v1.8h2.8l.8.7v2.9h1.7V47l.8-.7h2.8V44.5h-2.8l-.8-.8V40.9Zm20.2,0v2.8l-.8.8h-2.8v1.8h2.8l.8.7v2.9h1.7V47l.8-.7h2.8V44.5h-2.8l-.8-.8V40.9Zm20.2,0v2.8l-.8.8h-2.8v1.8h2.8l.8.7v2.9h1.8V47l.7-.7h2.8V44.5h-2.8l-.7-.8V40.9Zm20.2,0v2.8l-.8.8H182v1.8h2.7l.8.7v2.9h1.8V47l.8-.7h2.7V44.5h-2.7l-.8-.8V40.9Zm20.2,0v2.8l-.8.8h-2.7v1.8h2.7l.8.7v2.9h1.8V47l.8-.7H211V44.5h-2.7l-.8-.8V40.9Zm20.2,0v2.8l-.8.8h-2.7v1.8h2.7l.8.7v2.9h1.8V47l.8-.7h2.8V44.5h-2.8l-.8-.8V40.9Zm20.2,0v2.8l-.7.8h-2.8v1.8h2.8l.7.7v2.9h1.8V47l.8-.7h2.8V44.5h-2.8l-.8-.8V40.9Zm20.3,0v2.8l-.8.8h-2.8v1.8h2.8l.8.7v2.9h1.7V47l.8-.7h2.8V44.5h-2.8l-.8-.8V40.9Zm20.2,0v2.8l-.8.8H283v1.8h2.8l.8.7v2.9h1.7V47l.8-.7h2.8V44.5h-2.8l-.8-.8V40.9ZM3.8,40.8v2.9l-1,1H0V46H2.8l1,1v2.9H5.1V47l1-1H8.9V44.7H6.1l-1-1V40.8ZM24.1,20.5v2.8L23,24.4H20.2v1.1H23l1.1,1.1v2.9h1.1V26.6l1.1-1.1h2.8V24.4H26.3l-1.1-1.1V20.5Zm40.4,0v2.8l-1,1H60.7v1.3h2.8l1,1v2.9h1.3V26.6l1-1h2.8V24.3H66.8l-1-1V20.5Zm20.1,0v2.8l-.9.9H80.9v1.5h2.8l.9.9v2.9h1.5V26.6l.9-.9h2.8V24.2H87l-.9-.9V20.5Zm20.2,0v2.8l-.9.9h-2.8v1.5h2.8l.9.9v2.9h1.5V26.6l.9-.9H110V24.2h-2.8l-.9-.9V20.5Zm20.2,0v2.8l-.9.8h-2.7v1.7h2.7l.9.8v2.9h1.6V26.6l.8-.8h2.8V24.1h-2.8l-.8-.8V20.5Zm20.1,0v2.8l-.8.8h-2.7v1.8h2.7l.8.7v2.9h1.8V26.6l.8-.7h2.7V24.1h-2.7l-.8-.8V20.5Zm20.2,0v2.8l-.8.8h-2.7v1.8h2.7l.8.7v2.9h1.8V26.6l.8-.7h2.8V24.1h-2.8l-.8-.8V20.5Zm20.2,0v2.8l-.7.8H182v1.8h2.8l.7.7v2.9h1.8V26.6l.8-.7h2.8V24.1h-2.8l-.8-.8V20.5Zm20.3,0v2.8l-.8.8h-2.8v1.8H205l.8.7v2.9h1.7V26.6l.8-.7h2.8V24.1h-2.8l-.8-.8V20.5Zm20.2,0v2.8l-.8.8h-2.8v1.8h2.8l.8.7v2.9h1.7V26.6l.8-.7h2.8V24.1h-2.8l-.8-.8V20.5Zm20.2,0v2.8l-.8.8h-2.8v1.8h2.8l.8.7v2.9h1.7V26.6l.8-.7h2.8V24.1h-2.8l-.8-.8V20.5Zm20.2,0v2.8l-.8.8h-2.7v1.8h2.7l.8.7v2.9h1.8V26.6l.8-.7h2.7V24.1H269l-.8-.8V20.5Zm20.2,0v2.8l-.8.8h-2.7v1.8h2.7l.8.7v2.9h1.8V26.6l.8-.7h2.7V24.1h-2.7l-.8-.8V20.5ZM44.3,20.4v2.9l-1.1,1H40.5v1.3h2.7l1.1,1v2.9h1.2V26.6l1.1-1h2.8V24.3H46.6l-1.1-1V20.4Zm-40.4,0v2.9L2.8,24.4H0v1.1H2.8l1.1,1.1v2.9h1V26.6l1.2-1.1H8.9V24.4H6.1L4.9,23.3V20.4ZM24.2.1V2.9L23,4.1H20.2V5H23l1.2,1.2V9.1h.9V6.2L26.3,5h2.8V4.1H26.3L25.1,2.9V.1ZM64.6.1V2.9L63.5,4H60.7V5.1h2.8l1.1,1.1V9.1h1.1V6.2l1.1-1.1h2.8V4H66.8L65.7,2.9V.1Zm40.3,0V2.9l-1,1h-2.7V5.2h2.7l1,1V9.1h1.4V6.2l1-1H110V3.9h-2.7l-1-1V.1Zm20.2,0V2.9l-1,.9h-2.7V5.3h2.7l1,.9V9.1h1.4V6.2l1-.9h2.8V3.8h-2.8l-1-.9V.1Zm20.1,0V2.9l-.8.9h-2.8V5.3h2.8l.8.9V9.1h1.6V6.2l.9-.9h2.8V3.8h-2.8l-.9-.9V.1Zm20.2,0V2.9l-.8.8h-2.8V5.4h2.8l.8.8V9.1h1.7V6.2l.8-.8h2.8V3.7h-2.8l-.8-.8V.1Zm20.2,0V2.9l-.8.8H182V5.5h2.8l.8.7V9.1h1.7V6.2l.8-.7h2.8V3.7h-2.8l-.8-.8V.1Zm20.2,0V2.9l-.8.8h-2.8V5.5H205l.8.7V9.1h1.8V6.2l.7-.7h2.8V3.7h-2.8l-.7-.8V.1ZM226,.1V2.9l-.8.8h-2.7V5.5h2.7l.8.7V9.1h1.8V6.2l.8-.7h2.7V3.7h-2.7l-.8-.8V.1Zm20.2,0V2.9l-.8.8h-2.7V5.5h2.7l.8.7V9.1H248V6.2l.8-.7h2.7V3.7h-2.7l-.8-.8V.1Zm20.2,0V2.9l-.8.8h-2.7V5.5h2.7l.8.7V9.1h1.8V6.2l.8-.7h2.8V3.7H269l-.8-.8V.1Zm20.2,0V2.9l-.7.8h-2.8V5.5h2.8l.7.7V9.1h1.8V6.2l.8-.7H292V3.7h-2.8l-.8-.8V.1ZM84.8,0V2.9l-1.1,1H80.9V5.2h2.8l1.1,1V9.1H86V6.2l1-1h2.8V3.9H87l-1-1V0ZM44.4,0V2.9L43.2,4H40.5V5.1h2.8l1.1,1.1V9.1h1V6.2l1.2-1.1h2.8V4H46.6L45.4,2.9V0ZM4.1,0V2.9L2.8,4.2H0v.7H2.8L4.1,6.2V9.1h.7V6.2L6.1,4.9H8.9V4.2H6.1L4.8,2.9V0Z" fill="currentColor"></path>
                </svg>
            </div>

            <div class="z-10">
                <div x-data="teamCards()">

                    <div class="flex justify-start py-10 lg:justify-end space-x-10">
                        <div class="flex flex-row max-w-full -mt-20 space-x-5 lg:flex-col lg:space-x-0 lg:space-y-10">
                            <div class="flex-none relative w-[340px] h-[420px]">
                                <div x-ref="card_1_current" class="absolute inset-0 z-20" @click="markCardFlipped(1)">
                                    <?php
                                    $architect = $architects[0];
                                    include base_path("resources/views/components/architect-card.cmp.php");
                                    ?>
                                </div>
                            </div>

                            <div class="hidden md:block">
                                <div class="flex-none relative w-[340px] h-[420px]">
                                    <div x-ref="card_2_current" class="absolute inset-0 z-20" @click="markCardFlipped(2)">
                                        <?php
                                        $architect = $architects[1];
                                        include base_path("resources/views/components/architect-card.cmp.php");
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-col hidden -mb-20 xl:flex space-y-10">
                            <div class="flex-none relative w-[340px] h-[420px]">
                                <div x-ref="card_3_current" class="absolute inset-0 z-20" @click="markCardFlipped(3)">
                                    <?php
                                    $architect = $architects[2];
                                    include base_path("resources/views/components/architect-card.cmp.php");
                                    ?>
                                </div>
                            </div>
                            <div class="flex-none relative w-[340px] h-[420px]">
                                <div x-ref="card_4_current" class="absolute inset-0 z-20" @click="markCardFlipped(4)">
                                    <?php
                                    $architect = $architects[3];
                                    include base_path("resources/views/components/architect-card.cmp.php");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    let cardLoops = [{
                            position: 1,
                            duration: 15000,
                            delay: 7500,
                            interval: null,
                            flipped: false,
                        },
                        {
                            position: 2,
                            duration: 15000,
                            delay: 0,
                            interval: null,
                            flipped: false,
                        },
                        {
                            position: 3,
                            duration: 15000,
                            delay: 0,
                            interval: null,
                            flipped: false,
                        },
                        {
                            position: 4,
                            duration: 15000,
                            delay: 7500,
                            interval: null,
                            flipped: false,
                        },
                    ];

                    document.addEventListener('alpine:init', () => {
                        Alpine.data('teamCards', () => ({
                            init() {
                                const totalCards = 21;
                                const groupSize = 4;
                                let randomCards = this.getLoopArray(totalCards, groupSize);

                                cardLoops.forEach(loop => {
                                    this.swapCard(randomCards.shift(), loop.position);

                                    if (loop.delay) {
                                        setTimeout(() => {
                                            this.swapCard(randomCards.shift(), loop.position);
                                            this.startLoop(loop, randomCards);
                                        }, loop.delay);
                                    } else {
                                        this.startLoop(loop, randomCards);
                                    }
                                })
                            },
                            startLoop(loop, randomCards) {
                                loop.interval = setInterval(() => {
                                    if (!randomCards.length) {
                                        clearInterval(loop.interval);
                                    } else if (!loop.flipped) {
                                        this.swapCard(randomCards.shift(), loop.position);
                                    }
                                }, loop.duration);
                            },
                            swapCard(index, position) {
                                let newCard = this.$refs['card_original_' + index].cloneNode(true);
                                newCard.removeAttribute('x-ref');

                                let currentCard = this.$refs['card_' + position + '_current'].firstElementChild;

                                if (currentCard) {
                                    currentCard.classList.remove('team-card-animate-in');
                                    currentCard.classList.add('team-card-animate-out');
                                    this.$refs['card_' + position + '_previous'].replaceChildren(currentCard);
                                }

                                this.$refs['card_' + position + '_current'].replaceChildren(newCard);
                            },
                            getLoopArray(itemCount, iterations) {
                                return this.removeAdjacentDuplicates(
                                    [...Array(iterations)].map(iteration => {
                                        return this.shuffle(this.getArrayOfIndices(itemCount));
                                    }).flat(), 4);
                            },
                            getArrayOfIndices(length) {
                                return [...Array(length).keys()];
                            },
                            chunkArray(arr, size) {
                                return arr.reduce((result, item, index) => {
                                    const chunkIndex = Math.floor(index / size);

                                    if (!result[chunkIndex]) {
                                        result[chunkIndex] = [];
                                    }

                                    result[chunkIndex].push(item);
                                    return result;
                                }, []);
                            },
                            shuffle(arr) {
                                return arr.map(value => ({
                                        value,
                                        sort: Math.random()
                                    }))
                                    .sort((a, b) => a.sort - b.sort)
                                    .map(({
                                        value
                                    }) => value);
                            },
                            removeAdjacentDuplicates(arr, chunkSize = 1) {
                                let chunks = this.chunkArray(arr, chunkSize);

                                return chunks.map((chunk, index) => {
                                    return chunk.filter(item => {
                                        return typeof(chunks[index - 1]) != 'undefined' ?
                                            !chunks[index - 1].includes(item) :
                                            true &&
                                            typeof(chunks[index - 2]) != 'undefined' ?
                                            !chunks[index - 2].includes(item) :
                                            true;
                                    });
                                }).flat();
                            },
                            markCardFlipped(position) {
                                let card = cardLoops.find(loop => loop.position == position);

                                if (card) {
                                    card.flipped = !card.flipped;
                                }
                            },
                        }));
                    });
                </script>

            </div>
        </div>
    </div>
</div> -->

<section class="relative isolate overflow-hidden bg-white px-6 py-24 sm:py-32 lg:px-8">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.indigo.100),white)] opacity-20"></div>
    <div class="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-white shadow-xl shadow-indigo-600/10 ring-1 ring-indigo-50 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center"></div>
    <div class="mx-auto max-w-2xl lg:max-w-4xl">
        <img class="mx-auto h-12" src="https://tailwindui.com/img/logos/workcation-logo-indigo-600.svg" alt="">
        <figure class="mt-10">
            <blockquote class="text-center text-xl font-semibold leading-8 text-gray-900 sm:text-2xl sm:leading-9">
                <p>“Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo expedita voluptas culpa sapiente alias molestiae. Numquam corrupti in laborum sed rerum et corporis.”</p>
            </blockquote>
            <figcaption class="mt-10">
                <img class="mx-auto h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                <div class="mt-4 flex items-center justify-center space-x-3 text-base">
                    <div class="font-semibold text-gray-900">Judith Black</div>
                    <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true" class="fill-gray-900">
                        <circle cx="1" cy="1" r="1" />
                    </svg>
                    <div class="text-gray-600">CEO of Workcation</div>
                </div>
            </figcaption>
        </figure>
    </div>
</section>

@resource('layouts/footer')
