<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   <form action="{{ isset($record) ? route('SAXV_update', ['type' => $type,'id' => $record->S_NO]) : route('SAXV_Store') }}"
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

              <label class="block" for="date">
                    <span class="text-sm text-gray-600">Date</span>
                    
                    <input  type="date" id="date" name="date" required  value="{{ $record['Date']?? old('Date') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>


           
            
            <label class="block" for="number_of_parents">
                    <span class="text-sm text-gray-600">Number of Parents</span>
                    
                    <input  type="number" id="number_of_parents" name="number_of_parents" required value="{{ $record['Number_of_Parents'] ?? old('Number_of_Parents') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block" for="remarks">
                    <span class="text-sm text-gray-600">Remarks</span>
                    
                    <input  type="text" id="remarks" name="remarks" required  value="{{ $record['Remarks'] ?? old('Remarks') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

           

            <label class="block" for="dept">
                    <span class="text-sm text-gray-600">Department</span>
                    
                    <input  type="text" id="dept"   
                    name="dept" required  value="{{ $record['Dept'] ?? old('Dept') }}" 
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