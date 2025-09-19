<!-- Form Section -->
<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form id="facultyForm" method="POST" 
        action="{{ isset($record) ? route('FAVIII_update', ['type' => $type, 'id' => $record->S_NO]) : route('FAVIII_Store') }}" 
        class="space-y-4 w-full max-w-md" enctype="multipart/form-data">

        @csrf
        @if(isset($record))
            @method('PUT')
        @endif

        <h2 class="font-semibold text-2xl pt-1 ">
            {{ isset($record) ? 'Update Data' : 'Add Data' }}
        </h2>
         
        <label class="block">
            <span class="text-sm text-gray-600">Name of winter/SummerSchool/FDPTitle of the programme</span>
            <input type="text" name="name_of_the_programme" required
                value="{{ $record['Name_of_winter/SummerSchool/FDPTitle_of_the_programme'] ?? old('Name_of_winter/SummerSchool/FDPTitle_of_the_programme') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Name of the Coordinator('s')</span>
            <input type="text" name="name_of_the_coordinators" required
                value="{{ $record['Name_of_the_coordinator(s)'] ?? old('Name_of_the_coordinator(s)') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Total_No_of_Participants(TN)</span>
            <input type="text" name="total_no_of_participants_tn" required
                value="{{ $record['Total_No_of_Participants(TN)'] ?? old('Total_No_of_Participants(TN)') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Total_No_of_Participants(Others)</span>
            <input type="text" name="total_no_of_participants_others" required
                value="{{ $record['Total_No_of_Participants(Others)'] ?? old('Total_No_of_Participants(Others)') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Total_No_of_Participants(BIT)</span>
            <input type="text" name="total_no_of_participants_bit" required
                value="{{ $record['Total_No_of_Participants(BIT)'] ?? old('Total_No_of_Participants(BIT)') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">From date</span>
            <input type="date" name="from_date" required
                value="{{ $record->From_date ?? old('From_date') }}"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
        </label>


        <label class="block">
        <span class="text-sm text-gray-600">To date</span>
        <input type="date" name="to_date" required
        value="{{ $record->To_date ?? old('To_date') }}"
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


