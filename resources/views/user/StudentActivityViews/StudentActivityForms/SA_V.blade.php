<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
    <form 
        action="{{ isset($record) ? route('SAV_update', ['type' => $type, 'id' => $record['S_NO']]) : route('SAV_Store') }}"
        method="POST" 
        class="space-y-4 w-full max-w-md"
        enctype="multipart/form-data"
    >
        @csrf
        @if(isset($record))
            @method('PUT')
        @endif
        
        <h2 class="font-semibold text-1xl pt-1">
            {{ isset($record) ? 'Update Data' : 'Add Data' }}
        </h2>
        
        <label class="block">
            <span class="text-sm text-gray-600">Name of Students</span>
            <textarea 
                name="name_of_student" 
                id="name_of_student" 
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2" 
                required>{{ $record['Name_of_Student(s)'] ?? old('Name_of_Student(s)') }}</textarea>
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Roll No :</span>
            <textarea 
                name="roll_no" 
                id="roll_no" 
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2" 
                required
            >{{ $record['Roll_No'] ?? old('Roll_No') }}</textarea>
        </label>
        
        <label class="block">
            <span class="text-sm text-gray-600">Title_of_the_Model/Product_Developed</span>
            <input  
                type="text" 
                id="title_of_the_model" 
                name="title_of_the_model" 
                required  
                value="{{ $record['Title_of_the_Model/Product_Developed'] ?? old('title_of_the_model') }}" 
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
            >
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Organizer_Details(Venue)</span>
            <input  
                type="text" 
                id="organizer_details" 
                name="organizer_details" 
                required 
                value="{{ $record['Organizer_Details(Venue)'] ?? old('organizer_details') }}" 
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
            >
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Date</span>
            <input  
                type="date" 
                id="date" 
                name="date" 
                required  
                value="{{ $record['Date'] ?? old('date') }}" 
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
            >
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Status(Further_enchancement/Final_stage)</span>
            <input  
                type="text" 
                id="status" 
                name="status" 
                required  
                value="{{ $record['Status(Further_enchancement/Final_stage)'] ?? old('status') }}" 
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
            >
        </label>

        <label class="block">
            <span class="text-sm text-gray-600">Document Link</span>
            <input 
                type="url" 
                id="document_link" 
                name="document_link" 
                value="{{ $record['Document_Link'] ?? old('document_link') }}" 
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
            >
        </label>

        
            <label class="block">
                    <span class="text-sm text-gray-600">Document</span>

                    {{-- Show existing document name or link if record exists --}}
                    @if(isset($record) && $record->Document)
                        <p class="text-sm text-gray-500">
                            Current file: 
                            <a href="{{ asset('storage/' . $record->Document) }}" class="text-blue-500 underline"target="blank">
                                {{ basename($record->Document) }}
                            </a>
                        </p>
                    @endif

                    {{-- File upload field --}}
                    <input type="file" name="document"
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                        {{ isset($record) ? '' : 'required' }}>
                </label>

        <button 
            type="submit" 
            class="block mx-auto bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200"
        >
            {{ isset($record) ? 'Update' : 'Submit' }}
        </button>
    </form>
</main>
