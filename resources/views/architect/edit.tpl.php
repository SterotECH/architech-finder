@resource('dashboard/master')

<div class="container mx-auto p-6">
  <div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Architect</h1>
    <form action="/architects/{{ $architect->id }}" method="POST">
      <?= csrf_field() ?>
      <?= method_field('PUT') ?>
      <div class="mb-4">
        <label for="experience" class="block text-gray-700 font-bold mb-2">Experience:</label>
        <textarea name="experience" id="experience" class="textarea textarea-bordered w-full" required>{{ $architect->experience }}</textarea>
      </div>
      <div class="mb-4">
        <label for="biography" class="block text-gray-700 font-bold mb-2">Biography:</label>
        <textarea name="biography" id="biography" class="textarea textarea-bordered w-full" required>{{ $architect->biography }}</textarea>
      </div>
      <div class="mb-4">
        <label for="qualifications" class="block text-gray-700 font-bold mb-2">Qualifications:</label>
        <textarea name="qualifications" id="qualifications" class="textarea textarea-bordered w-full" required>{{ $architect->qualifications }}</textarea>
      </div>
      <div class="mb-4">
        <label for="portfolio_link" class="block text-gray-700 font-bold mb-2">Portfolio Link:</label>
        <input type="text" name="portfolio_link" id="portfolio_link" class="input input-bordered w-full" value="{{ $architect->portfolio_link }}" required>
      </div>
      <button type="submit" class="btn btn-primary">Update Architect</button>
    </form>
  </div>
</div>
