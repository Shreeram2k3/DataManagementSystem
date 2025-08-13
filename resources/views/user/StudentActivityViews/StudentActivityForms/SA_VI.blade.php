<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   <form action="{{ isset($record) ? route('SAVI_update', ['type' => $type,'id' => $record->S_NO]) : route('SAVI_Store') }}"
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
                    <textarea name="name_of_student" id="name_of_student" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2" required 
                    >{{ $record['Name_of_student(s)'] ?? old('Name_of_student(s)') }}</textarea>
            </label>

            <label class="block">
                    <span class="text-sm text-gray-600">Roll No :</span>
                    <textarea name="roll_no" id="roll_no" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                     required>{{ $record->Roll_No ?? old('Roll_No') }}</textarea>
            </label>  
                    
            <label class="block">
                    <span class="text-sm text-gray-600">Date</span>
                    
                    <input  type="date" id="date" name="date" required  value="{{ $record['Date']?? old('Date') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
            
            <label class="block">
                    <span class="text-sm text-gray-600">Event</span>

                    <input  type="text" id="event" name="event" required  value="{{ $record->Event ?? old('Event') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
     
    
            <label class="block">
                    <span class="text-sm text-gray-600">Place</span>
                    
                    <input  type="text" id="place" name="place" required value="{{ $record->Place ?? old('Place') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block">
                    <span class="text-sm text-gray-600">Participation/Prize</span>
                    
                    <input  type="text" id="participation_prize" name="participation_prize" required  value="{{ $record['Participation/Prize'] ?? old('Participation/Prize') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block">
                    <span class="text-sm text-gray-600">Remark</span>
                    
                    <input  type="text" id="remark" name="remark" required  value="{{ $record['Remark'] ?? old('Remark') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>




            <label class="block">
                    <span class="text-sm text-gray-600">Document Link</span>
                    
                    <input type="url" id="document_link" name="document_link" value="{{ $record->Document_Link ?? old('Document_Link') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <label class="block">
                <span class="text-sm text-gray-600">Document</span>
                

                <input 
                    type="file" 
                    name="document"
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2 mt-1"
                >
            </label>

            <button 
                type="submit" 
                class="block mx-auto bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200">
                {{ isset($record) ? 'Update' : 'Submit' }}
            </button>
</form>
