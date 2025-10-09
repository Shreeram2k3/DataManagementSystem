<!-- Form Section -->
<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form id="facultyForm" method="POST" 
        action="{{ isset($record) ? route('FAXIII_update', ['type' => $type, 'id' => $record->S_NO]) : route('FAXIII_Store') }}" 
        class="space-y-4 w-full max-w-md" enctype="multipart/form-data">

        @csrf
        @if(isset($record))
            @method('PUT')
        @endif

        <h2 class="font-semibold text-2xl pt-1 ">
            {{ isset($record) ? 'Update Data' : 'Add Data' }}
        </h2>
         
        <label class="block">
            <span class="text-sm text-gray-600">Name of the Faculty Member</span>
            <input type="text" name="name_of_the_faculty_member" required
                value="{{ $record->Name_of_the_Faculty_Member ?? old('Name_of_the_Faculty_Member') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Part time/Full Time</span>
            <input type="text" name="part_time_full_time" required
                value="{{ $record['Part_time/Full_Time'] ?? old('Part_time/Full_Time') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block mb-2">
            <span class="text-sm text-gray-600">Internal/External</span>
        </label>
        <label class="inline-flex items-center">
            <input type="radio" name="internal_external" value="Internal"
                {{ (($record['Internal/External'] ?? old('Internal/External')) === 'Internal') ? 'checked' : '' }}
                class="form-radio text-pink-600 focus:ring-pink-500">
            <span class="ml-2 text-gray-700 text-sm">Internal</span>
        </label>

        <label class="inline-flex items-center">
            <input type="radio" name="internal_external" value="External"
                {{ (($record['Internal/External'] ?? old('Internal/External')) === 'External') ? 'checked' : '' }}
                class="form-radio text-pink-600 focus:ring-pink-500">
            <span class="ml-2 text-gray-700 text-sm">External</span>
        </label>

                <label class="block">
            <span class="text-sm text-gray-600">Name of the Scholar</span>
            <input type="text" name="name_of_the_scholar" required
                value="{{ $record->Name_of_the_Scholar ?? old('Name_of_the_Scholar') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Address of external</span>
            <input type="text" name="address_of_external" required
                value="{{ $record->Address_of_external ?? old('Address_of_external') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Date of Registration</span>
            <input type="date" name="date_of_registration" required
                value="{{ $record->Date_of_Registration ?? old('Date_of_Registration') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Research Area</span>
            <input type="text" name="research_area" required
                value="{{ $record->Research_Area ?? old('Research_Area') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Status</span>
            <input type="text" name="status" required
                value="{{ $record->Status ?? old('Status') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Document Link (Optional)</span>
            <input type="url" name="document_link"
                value="{{ $record->Document_Link ?? old('Document_Link') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Document (PDF only)</span>
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


