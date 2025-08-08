

  <!-- Form Section -->
  <main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form method="POST" action="{{ route('SAI_Store') }}" class="space-y-4 w-full max-w-md" enctype="multipart/form-data">
      <h2 class="font-semibold text-1xl pt-1">Add Data</h2>
      @csrf

      <label class="block">
        <span class="text-sm text-gray-600">Date</span>
        <input type="date" name="date" required
          class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
      </label>

      <label class="block">
        <span class="text-sm text-gray-600">Name of the Programme</span>
        <input type="text" name="name_of_programme" maxlength="255" required
          class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
      </label>

      <label class="block">
        <span class="text-sm text-gray-600">Name of the Speaker & Details</span>
        <input type="text" name="speaker_details" maxlength="255" required
          class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
      </label>

      <label class="block">
        <span class="text-sm text-gray-600">Topic</span>
        <input type="text" name="topic" maxlength="255" required
          class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
      </label>

      <label class="block">
        <span class="text-sm text-gray-600">Outcome</span>
        <input type="text" name="outcome" maxlength="255" required
          class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
      </label>

      <label class="block">
        <span class="text-sm text-gray-600">Number of Students Participated</span>
        <input type="number" name="students_participated" min="0" required
          class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
      </label>

      <label class="block">
        <span class="text-sm text-gray-600">Document Link</span>
        <input type="url" name="document_link"
          class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
      </label>

      <label class="block">
        <span class="text-sm text-gray-600">Document</span>
        <input type="file" name="document"
          class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
      </label>

      <div class="flex justify-center">
        <button type="submit"
          class="bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200">
          Submit
        </button>
      </div>
    </form>
  </main>
