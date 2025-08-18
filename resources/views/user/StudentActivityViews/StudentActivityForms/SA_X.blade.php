<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   <form action="{{ isset($record) ? route('SAX_update', ['type' => $type,'id' => $record->S_NO]) : route('SAX_Store') }}"
    method="POST" class="space-y-4 w-full max-w-md"enctype="multipart/form-data"> 
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif
     
    <h2 class="font-semibold text-1xl pt-1">
     {{ isset($record) ? 'Update Data' : 'Add Data' }}
    </h2>
     
            <label for="semester" class="block">
                    <span class="text-sm text-gray-600">Semester</span>
                    <textarea name="semester" id="semester" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2" required 
                    >{{ $record['Semester'] ?? old('Semester') }}</textarea>
            </label>

            <label class="block" for="name_of_the_student">
                    <span class="text-sm text-gray-600">Name of the Student</span>
                    <textarea name="name_of_the_student" id="name_of_the_student" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2" required 
                    >{{ $record['Name_of_the_student'] ?? old('Name_of_the_student') }}</textarea>
            </label>

            <label class="block" for="roll_no">
                    <span class="text-sm text-gray-600">Roll No</span>
                    <textarea name="roll_no" id="roll_no" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                     required>{{ $record->Roll_No ?? old('Roll_No') }}</textarea>
            </label>  
                    
            <label class="block" for="from_date">
                    <span class="text-sm text-gray-600">Date(from)</span>
                    
                    <input  type="date" id="from_date" name="from_date" required  value="{{ $record['From_Date']?? old('From_Date') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
            

            <label class="block" for="to_date">
                    <span class="text-sm text-gray-600">Date(to)</span>

                    <input  type="date" id="to_date" name="to_date" required  value="{{ $record->To_Date ?? old('To_Date') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
     
    
            <label class="block" for="industry_details">
                    <span class="text-sm text-gray-600">Industry Details</span>
                    
                    <input  type="text" id="industry_details" name="industry_details" required value="{{ $record['Industry_Details'] ?? old('Industry_Details') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block" for="stipend">
                    <span class="text-sm text-gray-600">Stipend(Rs/Month)</span>
                    
                    <input  type="text" id="stipend" name="stipend" required  value="{{ $record['Stipend(Rs/Month)'] ?? old('Stipend(Rs/Month)') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

           

            <label class="block" for="nature_of_training">
                    <span class="text-sm text-gray-600">Nature of Training</span>
                    
                    <input  type="text" id="nature_of_training" name="nature_of_training" required  value="{{ $record['Nature_of_Training'] ?? old('Nature_of_Training') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block" for="duration">
                    <span class="text-sm text-gray-600">Duration</span>
                    
                    <input  type="text" id="duration" name="duration" required  value="{{ $record['Duration'] ?? old('Duration') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block" for="assessment">
                    <span class="text-sm text-gray-600">Assessment</span>
                    
                    <input  type="text" id="assessment" name="assessment" required  value="{{ $record['Assessment'] ?? old('Assessment') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>





            <label class="block" for="document_link">
                    <span class="text-sm text-gray-600">Document Link</span>
                    
                    <input type="url" id="document_link" name="document_link" value="{{ $record->Document_Link ?? old('Document_Link') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block" for="document">
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
                class="block mx-auto bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200">
                {{ isset($record) ? 'Update' : 'Submit' }}
            </button>
</form>
</main>