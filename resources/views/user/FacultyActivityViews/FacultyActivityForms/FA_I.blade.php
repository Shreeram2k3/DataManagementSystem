<!-- Form Section -->
<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form method="POST" action="{{ isset($record) ? route('FAI_update', ['type' => $type, 'id' => $record->S_NO]) : route('FAI_Store') }}" 
    class="space-y-4 w-full max-w-md" enctype="multipart/form-data">


        @csrf
        @if(isset($record))
            @method('PUT')
        @endif

        <h2 class="font-semibold text-2xl pt-1 ">
            {{ isset($record) ? 'Update Data' : 'Add Data' }}
        </h2>
         
        <label class="block">
            <span class="text-sm text-gray-600">Name of the Faculty</span>
            <input type="text" name="name_of_the_faculty"  required
                value="{{ $record->name_of_the_faculty ?? old('name_of_the_faculty') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">ID</span>
            <input type="text" name="id"  required
                value="{{ $record->id ?? old('id') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>


        <label class="block">
            <span class="text-sm text-gray-600">Tittle of the Papper</span>
            <input type="text" name="title_of_the_paper"  required
                value="{{ $record->title_of_the_paper ?? old('title_of_the_paper') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Name of the Journal Volume</span>
            <input type="text" name="name_of_the_journal_volume"  required
                value="{{ $record->name_of_the_journal_volume ?? old('name_of_the_journal_volume') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Page Nos Impact Factor Value</span>
            <input type="text" name="page_nos_impact_factor_value"  required
                value="{{ $record->page_nos_impact_factor_value ?? old('page_nos_impact_factor_value') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block mb-2">
    <span class="text-sm text-gray-600">National / International</span>
</label>
  <div class="flex gap-6">
    <label class="inline-flex items-center">
        <input type="radio" name="national_international" value="National"
            {{ ($record->national_international ?? old('national_international')) === 'National' ? 'checked' : '' }}
            class="form-radio text-pink-600 focus:ring-pink-500">
        <span class="ml-2 text-gray-700 text-sm">National</span>
    </label>
    <label class="inline-flex items-center">
        <input type="radio" name="national_international" value="International"
            {{ ($record->national_international ?? old('national_international')) === 'International' ? 'checked' : '' }}
            class="form-radio text-pink-600 focus:ring-pink-500">
        <span class="ml-2 text-gray-700 text-sm">International</span>
    </label>
  </div>

        <label class="block">
            <span class="text-sm text-gray-600">Scopus Sci Others</span>
            <input type="text" name="scopus_sci_others"  required
                value="{{ $record->scopus_sci_others ?? old('scopus_sci_others') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Department</span>
            <input type="text" name="dept"  required
                value="{{ $record->dept ?? old('dept') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Document Link</span>
            <input type="url" name="document_link"
                value="{{ $record->document_link ?? old('document_link') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

       


            <label class="block">
                    <span class="text-sm text-gray-600">Document</span>

                    {{-- Show existing document name or link if record exists --}}
                    @if(isset($record) && $record->document)
                        <p class="text-sm text-gray-500">
                            Current file: 
                            <a href="{{ asset('storage/' . $record->document) }}" class="text-blue-500 underline"target="blank">
                                {{ basename($record->Document) }}
                            </a>
                        </p>
                    @endif

                    {{-- File upload field --}}
                    <input type="file" name="document"
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                        {{ isset($record) ? '' : 'required' }}>
                </label>


        <div class="flex justify-center">
            <button type="submit"
                class="bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200">
                {{ isset($record) ? 'Update' : 'Submit' }}
            </button>
        </div>
    </form>
</main>