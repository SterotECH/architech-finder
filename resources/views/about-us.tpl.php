@resource('layouts/master')
@component("resources/views/components/header.cmp.php");

<main class="container mx-auto py-8 px-6">
  <section class="text-center">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to Architect Booking</h1>
    <p class="text-lg text-gray-600 mb-8">
      At Architect Booking, we're passionate about connecting project owners with the
      perfect architects for their dream projects. Our platform simplifies the process of
      finding and collaborating with top architects, making your architectural
      journey enjoyable and stress-free.
    </p>
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-2xl font-bold text-purple-800 mb-4">Our Mission</h2>
      <p class="text-gray-700">Our mission is to revolutionize the way people discover
        and collaborate with architects. We believe that every project is unique and
        deserves the expertise of a skilled architect. We strive to make the process of
        finding and working with architects seamless and rewarding for both clients and architects.
      </p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 mt-8">
      <h2 class="text-2xl font-bold text-purple-800 mb-4">Meet Our Team</h2>
      <p>
        Our mission is to revolutionize the way people discover and collaborate with architects.
        We believe that every project is unique and deserves the expertise of a skilled architect.
        We strive to make the process of finding and working with architects seamless and
        rewarding for both clients and architects.
      </p>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md p-4">
          <h3 class="text-xl font-bold text-gray-800 mb-2">John Doe</h3>
          <p class="text-gray-600">CEO</p>
        </div>
        <!-- Repeat for other team members -->
      </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6 mt-8 text-left">
            <h2 class="text-2xl font-bold text-purple-800 mb-4">Why Choose Us?</h2>
            <dl class="grid grid-cols-1 md:grid-cols-1 gap-x-4 gap-y-2">
                <div class="flex items-start">
                    <dt class="font-bold mr-2">Expertise:</dt>
                    <dd>We work with a network of experienced architects with diverse backgrounds and specialties.</dd>
                </div>
                <div class="flex items-start">
                    <dt class="font-bold mr-2">Efficiency:</dt>
                    <dd>Our platform streamlines the process of finding, communicating, and collaborating with architects, saving you time and effort.</dd>
                </div>
                <div class="flex items-start">
                    <dt class="font-bold mr-2">Innovation:</dt>
                    <dd>We constantly innovate to provide you with the latest tools and features to enhance your architectural experience.</dd>
                </div>
                <div class="flex items-start">
                    <dt class="font-bold mr-2">Customer Satisfaction:</dt>
                    <dd>Your satisfaction is our top priority. We go above and beyond to ensure that your experience with us is exceptional.</dd>
                </div>
            </dl>
        </div>
  </section>
</main>
@resource('layouts/footer')
