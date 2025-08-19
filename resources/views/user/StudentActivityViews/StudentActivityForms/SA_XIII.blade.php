<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   <form action="{{ isset($record) ? route('SAXIII_update', ['type' => $type,'id' => $record->S_NO]) : route('SAXIII_Store') }}"
    method="POST" class="space-y-4 w-full max-w-md"enctype="multipart/form-data"> 
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif
     
    <h2 class="font-semibold text-1xl pt-1">
     {{ isset($record) ? 'Update Data' : 'Add Data' }}
    </h2>

              <label class="block" for="semester">
                      <span class="text-sm text-gray-600">Semester</span>
                      
                      <input  type="text" id="semester" name="semester" required value="{{ $record['Semester'] ?? old('Semester') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
              </label>

              <label class="block" for="from_date">
                    <span class="text-sm text-gray-600">Date(from)</span>
                    
                    <input  type="date" id="from_date" name="from_date" required  value="{{ $record['From_Date']?? old('From_Date') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block" for="to_date">
                    <span class="text-sm text-gray-600">Date(to)</span>
                    
                    <input  type="date" id="to_date" name="to_date" required  value="{{ $record['To_Date']?? old('To_Date') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
            
            <label class="block" for="factory_visited">
                    <span class="text-sm text-gray-600">Factory Visited</span>
                    
                    <input  type="text" id="factory_visited" name="factory_visited" required value="{{ $record['Factory_Visited'] ?? old('Factory_Visited') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block" for="name_student_staff">
                    <span class="text-sm text-gray-600">Name of the staff/Students</span>
                    
                    <input  type="text" id="name_student_staff" name="name_student_staff" required  value="{{ $record['Name_of_the_staff/Students'] ?? old('Name_of_the_staff/Students') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

             <label class="block" for="department">
                    <span class="text-sm text-gray-600">Department</span>
                    
                    <input  type="text" id="department" name="department" required  value="{{ $record['Department'] ?? old('Department') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

           

            <label class="block" for="assessment_details">
                    <span class="text-sm text-gray-600">Assessment Details</span>
                    
                    <input  type="text" id="assessment_details"   
                    name="assessment_details" required  value="{{ $record['Assessment_Details'] ?? old('Assessment_Details') }}" 
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