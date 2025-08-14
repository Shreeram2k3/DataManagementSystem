<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   <form action="{{ isset($record) ? route('SAIX_update', ['type' => $type,'id' => $record->S_NO]) : route('SAIX_Store') }}"
    method="POST" class="space-y-4 w-full max-w-md"enctype="multipart/form-data"> 
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif
     
    <h2 class="font-semibold text-1xl pt-1">
     {{ isset($record) ? 'Update Data' : 'Add Data' }}
    </h2>
     
            <label class="block">
                    <span class="text-sm text-gray-600">Semester</span>
                    <textarea name="semester" id="semester" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2" required 
                    >{{ $record['Semester'] ?? old('Semester') }}</textarea>
            </label>

            <label class="block">
                    <span class="text-sm text-gray-600">Name of Course</span>
                    <textarea name="name_of_course" id="name_of_course" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2" required 
                    >{{ $record['Name_of_Course'] ?? old('Name_of_Course') }}</textarea>
            </label>

            <label class="block">
                    <span class="text-sm text-gray-600">Name of Faculty/Resource Person</span>
                    <textarea name="name_of_faculty_resource_person" id="name_of_faculty_resource_person" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                     required>{{ $record->Roll_No ?? old('Roll_No') }}</textarea>
            </label>  
                    
            <label class="block">
                    <span class="text-sm text-gray-600">Name of the Organization</span>
                    
                    <input  type="text" id="name_of_the_organization" name="name_of_the_organization" required  value="{{ $record['Name_of_the_Organization']?? old('Name_of_the_Organization') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
            
            <label class="block">
                    <span class="text-sm text-gray-600">From Date</span>

                    <input  type="date" id="from_date" name="from_date" required  value="{{ $record->From_Date ?? old('From_Date') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block">
                    <span class="text-sm text-gray-600">To Date</span>

                    <input  type="date" id="to_date" name="to_date" required  value="{{ $record->To_Date ?? old('To_Date') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
     
    
            <label class="block">
                    <span class="text-sm text-gray-600">Value Added/One Credit</span>
                    
                    <input  type="text" id="name_of_the_journal" name="name_of_the_journal" required value="{{ $record['Value_Added/One_Credit'] ?? old('Value_Added/One_Credit') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block">
                    <span class="text-sm text-gray-600">Coordinator</span>
                    
                    <input  type="text" id="coordinator" name="coordinator" required  value="{{ $record['Coordinator'] ?? old('Coordinator') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

           

            <label class="block">
                    <span class="text-sm text-gray-600">Department</span>
                    
                    <input  type="text" id="dept" name="dept" required  value="{{ $record['Dept'] ?? old('Dept') }}" 
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
