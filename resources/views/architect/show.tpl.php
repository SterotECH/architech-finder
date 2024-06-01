@resource('dashboard/master')
<div class="w-full lg:ps-64">
  <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
    <div class="container mx-auto p-6">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-4">Architect: {{ $architect->user->first_name }} {{ $architect->user->last_name }}</h1>
        <div class="mb-4">
          <span class="text-gray-700 font-bold">Email: </span>
          <span class="text-gray-900">{{ $architect->user->email }}</span>
        </div>
        <div class="mb-4">
          <span class="text-gray-700 font-bold">Phone Number: </span>
          <span class="text-gray-900">{{ $architect->user->phone_number }}</span>
        </div>
        <div class="mb-4">
          <span class="text-gray-700 font-bold">Gender: </span>
          <span class="text-gray-900">{{ $architect->user->gender }}</span>
        </div>
        <div class="mb-4">
          <span class="text-gray-700 font-bold">Location: </span>
          <span class="text-gray-900">{{ $architect->user->location }}</span>
        </div>
        <div class="mb-4">
          <span class="text-gray-700 font-bold">Experience: </span>
          <p class="text-gray-900">{{ $architect->experience }}</p>
        </div>
        <div class="mb-4">
          <span class="text-gray-700 font-bold">Biography: </span>
          <p class="text-gray-900">{{ $architect->biography }}</p>
        </div>
        <div class="mb-4">
          <span class="text-gray-700 font-bold">Qualifications: </span>
          <p class="text-gray-900">{{ $architect->qualifications }}</p>
        </div>
        <div class="mb-4">
          <span class="text-gray-700 font-bold">Portfolio Link: </span>
          <a href="{{ $architect->portfolio_link }}" class="text-blue-500">{{ $architect->portfolio_link }}</a>
        </div>
        <a href="/architects/{{ $architect->id }}/edit" class="btn btn-primary">Edit Architect</a>
      </div>
    </div>
  </div>
</div>
