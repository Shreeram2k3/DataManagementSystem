<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   <form action="{{ isset($record) ? route('SAVIII_update', ['type' => $type,'id' => $record->S_NO]) : route('SAVIII_Store') }}"
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
                    <textarea name="name_of_students" id="name_of_students" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2" required 
                    >{{ $record['Name_of_Student(s)'] ?? old('Name_of_Student(s)') }}</textarea>
            </label>

            <label class="block">
                    <span class="text-sm text-gray-600">Roll No :</span>
                    <textarea name="roll_no" id="roll_no" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                     required>{{ $record->Roll_No ?? old('Roll_No') }}</textarea>
            </label>  
                    
            <label class="block">
                    <span class="text-sm text-gray-600">Name of the Organization</span>
                    
                    <input  type="text" id="name_of_the_organization" name="name_of_the_organization" required  value="{{ $record['Name_of_the_Organization']?? old('Name_of_the_Organization') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
            
            <label class="block">
                    <span class="text-sm text-gray-600">Location</span>

                    <input  type="text" id="location" name="location" required  value="{{ $record->Location ?? old('Location') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
     
    
           

            <label class="block">
                    <span class="text-sm text-gray-600">Salary(Rs/Annum)</span>
                    
                    <input  type="text" id="salary" name="salary" required  value="{{ $record['Salary(Rs/Annum)'] ?? old('Salary(Rs/Annum)') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block">
                    <span class="text-sm text-gray-600">Date of Interview</span>
                    
                    <input  type="date" id="date_of_interview" name="date_of_interview" required  value="{{ $record['Date_of_Interview'] ?? old('Date_of_Interview') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block">
                    <span class="text-sm text-gray-600">Remarks</span>
                    
                    <input  type="text" id="remarks" name="remarks" required  value="{{ $record['Remarks'] ?? old('Remarks') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>





            <label class="block">
                    <span class="text-sm text-gray-600">Document Link</span>
                    
                    <input type="url" id="document_link" name="document_link" value="{{ $record->Document_Link ?? old('Document_Link') }}" 
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
                class="block mx-auto bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200">
                {{ isset($record) ? 'Update' : 'Submit' }}
            </button>
</form>
