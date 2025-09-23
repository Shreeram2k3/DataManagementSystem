<!-- Form Section -->
<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form id="facultyForm" method="POST" 
        action="{{ isset($record) ? route('FAIII_update', ['type' => $type, 'id' => $record->S_NO]) : route('FAIII_Store') }}" 
        class="space-y-4 w-full max-w-md" enctype="multipart/form-data">

        @csrf
        @if(isset($record))
            @method('PUT')
        @endif

        <h2 class="font-semibold text-2xl pt-1 ">
            {{ isset($record) ? 'Update Data' : 'Add Data' }}
        </h2>
         
        <label class="block">
            <span class="text-sm text-gray-600">Faculty Member</span>
            <input type="text" name="faculty_member" required
                value="{{ $record->Faculty_Member ?? old('Faculty_member') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Title of the Invention</span>
            <input type="text" name="title_of_the_invention" required
                value="{{ $record->Title_of_the_Invention ?? old('Title_of_the_Invention') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Sponsoring Agency</span>
            <input type="text" name="sponsoring_agency" required
                value="{{ $record->Sponsoring_Agency ?? old('Sponsoring_Agency') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Registration Details</span>
            <input type="text" name="registration_details" required
                value="{{ $record->Registration_Details ?? old('Registration_Details') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block mb-2">
            <span class="text-sm text-gray-600">National / International</span>
        </label>
        <label class="inline-flex items-center">
            <input type="radio" name="national_international" value="National" required
                {{ (($record['National/International'] ?? old('National/International')) === 'National') ? 'checked' : '' }}
                class="form-radio text-pink-600 focus:ring-pink-500">
            <span class="ml-2 text-gray-700 text-sm">National</span>
        </label>

        <label class="inline-flex items-center">
            <input type="radio" name="national_international" value="International"
                {{ (($record['National/International'] ?? old('National/International')) === 'International') ? 'checked' : '' }}
                class="form-radio text-pink-600 focus:ring-pink-500">
            <span class="ml-2 text-gray-700 text-sm">International</span>
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Date</span>
            <input type="date" name="date" required
                value="{{ $record['Date'] ?? old('Date') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Dept</span>
            <input type="text" name="dept" required
                value="{{ $record->Dept ?? old('Dept') }}"
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


