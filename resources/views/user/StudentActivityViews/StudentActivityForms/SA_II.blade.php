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
                    <textarea name="Name_of_student(s)" id="name_of_student(s)" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                    >{{ $record['Name_of_student(s)'] ?? old('Name_of_student(s)') }}</textarea>
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Roll No</span>
                    <textarea id="roll_no" name="Roll_No" required maxlength="50" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                    >{{ $record->Roll_No ?? old('Roll_No') }}</textarea>
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Class</span>
                    <input  type="text" id="class" name="class" required maxlength="50" value="{{ $record->class ?? old('class') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Title of Event</span>
                    <input type="text" id="title_of_event" name="Title_of_Event/Presentation" required maxlength="255" 
                        value="{{ $record['Title_of_Event/Presentation'] ?? old('Title_of_Event/Presentation') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                    >
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Venue</span>
                    <input type="text" id="venue" name="Venue" required maxlength="255" value="{{ $record->Venue ?? old('Venue') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                    >
                </label>

                <label class="block">
                    <span class="text-sm text-gray-600">Prize/Place</span>
                    <input type="text" id="Prize/place" name="Prize/place" required maxlength="255" value="{{ $record['Prize/place'] ?? old('Prize/place') }}" 
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
                    
                    @if(isset($record) && $record->document)
                        <p class="text-sm text-blue-600 mt-1">
                            Current File: 
                            <a href="{{ asset('SA_Document/SA_II/' . $record->Document) }}" target="_blank" class="underline text-blue-500">
                                View / Download
                            </a>
                        </p>
                    @endif

                    <input 
                        type="file" 
                        name="document"
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2 mt-1"
                    >
                </label>


                <button 
                    type="submit" 
                    class="block mx-auto bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200"
                >
                    {{ isset($record) ? 'Update' : 'Submit' }}
                </button>
    </form>
</main>
