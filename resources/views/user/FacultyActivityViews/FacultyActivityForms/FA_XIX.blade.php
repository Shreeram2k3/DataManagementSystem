<!-- Form Section -->
<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form id="facultyForm" method="POST" 
        action="{{ isset($record) ? route('FAXIX_update', ['type' => $type, 'id' => $record->S_NO]) : route('FAXIX_Store') }}" 
        class="space-y-4 w-full max-w-md" enctype="multipart/form-data">

        @csrf
        @if(isset($record))
            @method('PUT')
        @endif

        <h2 class="font-semibold text-2xl pt-1 ">
            {{ isset($record) ? 'Update Data' : 'Add Data' }}
        </h2>
         
        <label class="block">
            <span class="text-sm text-gray-600">Name of the Staff</span>
            <input type="text" name="name_of_the_staff" required
                value="{{ $record->Name_of_the_Staff ?? old('Name_of_the_Staff') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Faculty</span>
            <input type="text" name="faculty" required
                value="{{ $record->Faculty ?? old('Faculty') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">University</span>
            <input type="text" name="university" required
                value="{{ $record->University ?? old('University') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Date of Recognition</span>
            <input type="date" name="date_of_recognition" required
                value="{{ $record->Date_of_Recognition ?? old('Date_of_Recognition') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Reference No</span>
            <input type="text" name="reference_no" required
                value="{{ $record->Reference_No ?? old('Reference_No') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>
        
        <label class="block">
            <span class="text-sm text-gray-600">Document Link (Optional)</span>
            <input type="url" name="document_link"
                value="{{ $record->Document_Link ?? old('Document_Link') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Document</span>
            @if(isset($record) && $record->Document)
                <p class="text-sm text-gray-500">
                    Current file:
                    <a href="{{ asset('storage/' . $record->Document) }}" class="text-blue-500 underline" target="blank">
                        {{ basename($record->Document) }}
                    </a>
                </p>
            @endif
            <input type="file" name="document"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                {{ isset($record) ? '' : 'required' }}>
        </label>

        <div class="flex justify-center">
            <button type="submit" id="submitBtn"
                class="bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200">
                {{ isset($record) ? 'Update' : 'Submit' }}
            </button>
        </div>
    </form>
</main>


