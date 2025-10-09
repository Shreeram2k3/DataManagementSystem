<!-- Form Section -->
<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form id="facultyForm" method="POST" 
        action="{{ isset($record) ? route('DAIII_update', ['type' => $type, 'id' => $record->S_NO]) : route('DAIII_Store') }}" 
        class="space-y-4 w-full max-w-md" enctype="multipart/form-data">

        @csrf
        @if(isset($record))
            @method('PUT')
        @endif

        <h2 class="font-semibold text-2xl pt-1 ">
            {{ isset($record) ? 'Update Data' : 'Add Data' }}
        </h2>
         
        <label class="block">
            <span class="text-sm text-gray-600">Total Number of Titles</span>
            <input type="text" name="total_number_of_titles" required
                value="{{ $record->Total_Number_of_Titles ?? old('Total_Number_of_Titles') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Total Number of Books</span>
            <input type="number" name="total_number_of_books" required
                value="{{ $record->Total_Number_of_Books ?? old('Total_Number_of_Books') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Total Number of Reference Books</span>
            <input type="number" name="total_number_of_reference_books" required
                value="{{ $record->Total_Number_of_Reference_Books ?? old('Total_Number_of_Reference_Books') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Total Number of Journals Subscribed (National)</span>
            <input type="number" name="total_number_of_journals_subscribed_national" required
                value="{{ $record->Total_Number_of_Journals_Subscribed_National ?? old('Total_Number_of_Journals_Subscribed_National') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Total Number of Journals Subscribed (International)</span>
            <input type="number" name="total_number_of_journals_subscribed_international" required
                value="{{ $record->Total_Number_of_Journals_Subscribed_International ?? old('Total_Number_of_Journals_Subscribed_International') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>


        <label class="block">
            <span class="text-sm text-gray-600">Total Value of Books/Journals Investment (National)</span>
            <input type="number" name="total_value_of_books/journals_investment(National)" required
                value="{{ $record['Total_Value_of_Books/Journals_Investment(National)'] ?? old('Total_Value_of_Books/Journals_Investment(National)') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Total Value of Books/Journals Investment(international)</span>
            <input type="text" name='total_value_of_books/journals_investment(international)' required
                value="{{ $record['Total_Value_of_Books/Journals_Investment(international)'] ?? old('Total_Value_of_Books/Journals_Investment(international)') }}"
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


