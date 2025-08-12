<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   <form action="{{ isset($record) ? route('SAIII_update', ['type' => $type,'id' => $record->S_NO]) : route('SAIII_Store') }}"
    method="POST" class="space-y-4 w-full max-w-md"enctype="multipart/form-data"> 
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif
     
    <h2 class="font-semibold text-1xl pt-1">
     {{ isset($record) ? 'Update Data' : 'Add Data' }}
    </h2>
     
            <label class="block">
                            <span class="text-sm text-gray-600">Date</span>
                            <input  type="date" id="Date" name="Date" required maxlength="50" value="{{ $record->Date ?? old('Date') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
            <label class="block">
                            <span class="text-sm text-gray-600">Name Of Programme</span>
                            <input  type="text" id="Name_of_programme" name="Name_of_programme" required maxlength="50" value="{{ $record->Name_of_programme ?? old('Name_of_programme') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                        </label>
     
    
     <label class="block">
                    <span class="text-sm text-gray-600">Speaker Details / Convener & Details:</span>
                    <input  type="text" id="Speaker_details" name="Speaker_details" required maxlength="50" value="{{ $record['Speaker_details/Convener&details'] ?? old('Speaker_details/Convener&details') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
    </label>
    
     <label class="block">
                    <span class="text-sm text-gray-600">Coordinator :</span>
                    <input  type="text" id="Coordinator" name="Coordinator" required maxlength="50" value="{{ $record->Coordinator ?? old('Coordinator') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>

     <label class="block">
                    <span class="text-sm text-gray-600">Duration :</span>
                    <input  type="text" id="Duration" name="Duration" required maxlength="50" value="{{ $record->Duration ?? old('Duration') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>

     <label class="block">
                    <span class="text-sm text-gray-600">Department :</span>
                    <input  type="text" id="Dept" name="Dept" required maxlength="50" value="{{ $record->Dept ?? old('Dept') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>

     <label class="block">
                    <span class="text-sm text-gray-600">Outcome :</span>
                    <input  type="text" id="Outcome" name="Outcome" required maxlength="50" value="{{ $record->Outcome ?? old('Outcome') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>

       <label class="block">
                    <span class="text-sm text-gray-600">CAMPUS_Document_ID :</span>
                    <input  type="text" id="CAMPUS_Document_ID" name="CAMPUS_Document_ID" required maxlength="50" value="{{ $record->CAMPUS_Document_ID ?? old('CAMPUS_Document_ID') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>


                <button 
                    type="submit" 
                    class="block mx-auto bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200">
                    {{ isset($record) ? 'Update' : 'Submit' }}
                </button>
</form>
</body>
</html>