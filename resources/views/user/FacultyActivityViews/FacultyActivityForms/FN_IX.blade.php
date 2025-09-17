<!-- Form Section -->
<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form id="facultyForm" method="POST" 
        action="{{ isset($record) ? route('FAIX_update', ['type' => $type, 'id' => $record->S_NO]) : route('FAIX_Store') }}" 
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
            <span class="text-sm text-gray-600">ID</span>
            <input type="text" name="id" required
                value="{{ $record->ID ?? old('ID') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Name of Programme</span>
            <input type="text" name="name_of_programme" required
                value="{{ $record->Name_of_Programme ?? old('Name_of_Programme') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Name of the Journal Volume</span>
            <input type="text" name="name_of_the_journal_volume" required
                value="{{ $record->NamIndustry_Detailse_of_the_Journal_Volume ?? old('Name_of_the_Journal_Volume') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Page Nos Impact Factor Value</span>
            <input type="text" name="page_nos_impact_factor_value" required
                value="{{ $record->Page_Nos_Impact_Factor_value ?? old('Page_Nos_Impact_Factor_value') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block mb-2">
            <span class="text-sm text-gray-600">National / International</span>
        </label>
        <label class="inline-flex items-center">
            <input type="radio" name="national_international" value="National"
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
            <span class="text-sm text-gray-600">Scopus Sci Others</span>
            <input type="text" name="scopus_sci_others" required
                value="{{ $record['Scopus/SCI/others'] ?? old('Scopus/SCI/others') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Department</span>
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


