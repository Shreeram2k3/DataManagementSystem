<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   <form action="{{ isset($record) ? route('SAXIV_update', ['type' => $type,'id' => $record->S_NO]) : route('SAXIV_Store') }}"
    method="POST" class="space-y-4 w-full max-w-md"enctype="multipart/form-data"> 
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif
     
    <h2 class="font-semibold text-1xl pt-1">
     {{ isset($record) ? 'Update Data' : 'Add Data' }}
    </h2>

               <label class="block" for="date">
                    <span class="text-sm text-gray-600">Date</span>
                    
                    <input  type="date" id="date" name="date" required  value="{{ $record['Date']?? old('Date') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>


              <label class="block" for="batch">
                      <span class="text-sm text-gray-600">Batch</span>
                      
                      <input  type="text" id="batch" name="batch" required value="{{ $record['Batch'] ?? old('Batch') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
              </label>


           
            
            <label class="block" for="place">
                    <span class="text-sm text-gray-600">Place</span>
                    
                    <input  type="text" id="place" name="place" required value="{{ $record['Place'] ?? old('Place') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block" for="name_student_staff">
                    <span class="text-sm text-gray-600">Strength</span>
                    
                    <input  type="text" id="strength" name="strength" required  value="{{ $record['Strength'] ?? old('Strength') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

             <label class="block" for="remarks">
                    <span class="text-sm text-gray-600">Remarks/Feedback Received</span>
                    
                    <input  type="text" id="remarks" name="remarks" required  value="{{ $record['Remarks/Feedback_Received'] ?? old('Remarks/Feedback_Received') }}" 
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