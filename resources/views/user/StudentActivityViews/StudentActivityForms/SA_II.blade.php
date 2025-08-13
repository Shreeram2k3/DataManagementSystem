<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   
    <form action="{{ isset($record) ? route('SAII_update', $record->S_NO) : route('SAII_Store') }}"
    method="POST" class="space-y-4 w-full max-w-md"enctype="multipart/form-data"> 
                @csrf
                @if(isset($record))
                    @method('PUT')
                @endif

                <h2 class="font-semibold text-1xl pt-1">
                    {{ isset($record) ? 'Update Data' : 'Add Data' }}
                </h2>

                <label class="block">
                    <span class="text-sm text-gray-600">Name of Students</span>
                    <textarea name="Name_of_student(s)" id="name_of_student(s)" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2" required
                    >{{ $record['Name_of_student(s)'] ?? old('Name_of_student(s)') }}</textarea>
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Roll No</span>
                    <textarea id="roll_no" name="Roll_No" required  
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                    >{{ $record->Roll_No ?? old('Roll_No') }}</textarea>
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Class</span>
                    <input  type="text" id="class" name="class" required  value="{{ $record->class ?? old('class') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Title of Event</span>
                    <input type="text" id="title_of_event" name="Title_of_Event/Presentation" required 
                        value="{{ $record['Title_of_Event/Presentation'] ?? old('Title_of_Event/Presentation') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                    >
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Venue</span>
                    <input type="text" id="venue" name="Venue" required  value="{{ $record->Venue ?? old('Venue') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                    >
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Prize/Place</span>
                    <input type="text" id="Prize/place" name="Prize/place" required  value="{{ $record['Prize/place'] ?? old('Prize/place') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                    >
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Date</span>
                    <input type="date" id="date" name="Date" required value="{{ $record->Date ?? old('Date') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                    >
                </label>

               <label class="block">
                    <span class="text-sm text-gray-600">Document Link</span>
                    <input type="url" id="document_link" name="Document_Link" value="{{ $record->Document_Link ?? old('Document_Link') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
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
