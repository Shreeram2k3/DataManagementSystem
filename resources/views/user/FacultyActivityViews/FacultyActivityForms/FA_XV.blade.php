<!-- Form Section -->
<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form id="facultyForm" method="POST" 
        action="{{ isset($record) ? route('FAXV_update', ['type' => $type, 'id' => $record->S_NO]) : route('FAXV_Store') }}" 
        class="space-y-4 w-full max-w-md" enctype="multipart/form-data">

        @csrf
        @if(isset($record))
            @method('PUT')
        @endif

        <h2 class="font-semibold text-2xl pt-1 ">
            {{ isset($record) ? 'Update Data' : 'Add Data' }}
        </h2>
         
        <label class="block">
            <span class="text-sm text-gray-600">period (from)</span>
            <input type="text" name="period_(from)" required
                value="{{ $record['period_(from)'] ?? old('period_(from)') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Period_(To)</span>
            <input type="text" name="period_(to)" required
                value="{{ $record->['Period_(To)'] ?? old('Period_(To)') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Name of the Company</span>
            <input type="text" name="name_of_the_company" required
                value="{{ $record->Name_of_the_Company ?? old('Name_of_the_Company') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Work Description</span>
            <input type="text" name="work_description" required
                value="{{ $record->Work_Description ?? old('Work_Description') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Faculty/Faculty Team</span>
            <input type="text" name="faculty_faculty_team" required
                value="{{ $record ['Faculty/Faculty_Team'] ?? old('Faculty/Faculty_Team') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Amount Generated(in_Rs)</span>
            <input type="text" name="Amount" required
                value="{{ $record['Amount_Generated(in_Rs)'] ?? old('Amount_Generated(in_Rs)') }}"
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


