<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   <form action="{{ isset($record) ? route('SAIV_update', ['type' => $type,'id' => $record->S_NO]) : route('SAIV_Store') }}"
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
                    <span class="text-sm text-gray-600">Roll No :</span>
                    <textarea name="roll_no" id="roll_no" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                    >{{ $record->Roll_No ?? old('Roll_No') }}</textarea>
            </label>
            
            <label class="block">
                            <span class="text-sm text-gray-600">Name Of Guide</span>
                            <input  type="text" id="name_of_the_guide" name="Name_of_programme" required maxlength="50" value="{{ $record->name_of_the_guide ?? old('name_of_the_guide') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                        </label>
     
    
     <label class="block">
                    <span class="text-sm text-gray-600">Title of Project:</span>
                    <input  type="text" id="title_of_the_project" name="title_of_the_project" required maxlength="50" value="{{ $record->Title_of_Project ?? old(Title_of_Project) }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
    </label>
    
     <label class="block">
                    <span class="text-sm text-gray-600">Submitted/Sanctioned :</span>
                    <input  type="text" id="submitted_or_sanctioned" name="submitted_or_sanctioned" required maxlength="50" value="{{ $record['Submitted/Sanctioned']?? old('Submitted/Sanctioned') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>

     <label class="block">
                    <span class="text-sm text-gray-600">Sponsoring Agency Date of Submission/Sanctioned:</span>
                    <input  type="text" id="Submitted/Sanctioned" name="Submitted/Sanctioned" required maxlength="50" value="{{ $record['Sponsoring_Agency_Date_of_Submission/Sanctioned'] ?? old('Sponsoring_Agency_(Date of Submission/Sanctioned') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>

     <label class="block">
                    <span class="text-sm text-gray-600">Amount Sanctioned in (RS) :</span>
                    <input  type="text" id="amount_sanctioned" name="amount_sanctioned" required maxlength="50" value="{{ $record['Amount_Sanctioned_in_(Rs)'] ?? old('Amount_Sanctioned_in_(Rs)') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>

     <label class="block">
                    <span class="text-sm text-gray-600">Outcome :</span>
                    <input  type="text" id="Outcome" name="Outcome" required maxlength="50" value="{{ $record->Outcome ?? old('Outcome') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
                </label>

       <label class="block">
                    <span class="text-sm text-gray-600">Department :</span>
                    <input  type="text" id="dept" name="dept" required maxlength="50" value="{{ $record->Dept ?? old('Dept') }}" 
                        class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
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
                    class="block mx-auto bg-green-500 text-white rounded-md px-12 py-2 mt-4 hover:bg-green-400 transition-all duration-200">
                    {{ isset($record) ? 'Update' : 'Submit' }}
                </button>
</form>
</body>
</html>