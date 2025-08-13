<main class="w-full lg:w-1/2 bg-white px-6 py-8 sm:px-10 lg:px-20 flex items-center justify-center">
   <form action="{{ isset($record) ? route('SAVII_update', ['type' => $type,'id' => $record->S_NO]) : route('SAVII_Store') }}"
    method="POST" class="space-y-4 w-full max-w-md"enctype="multipart/form-data"> 
    @csrf
    @if(isset($record))
        @method('PUT')
    @endif
     
    <h2 class="font-semibold text-1xl pt-1">
     {{ isset($record) ? 'Update Data' : 'Add Data' }}
    </h2>
              <!-- Month -->
            <label class="block">
              <span class="text-sm text-gray-600">Month</span>

              <select
                name="month"
                id="month"
                class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2 bg-transparent"
                required
              >
                <option value="" disabled {{ empty($record->Month ?? old('Month')) ? 'selected' : '' }}>
                  Select Month
                </option>

                <option value="01" {{ ($record->Month ?? old('Month')) == '01' ? 'selected' : '' }}>January</option>
                <option value="02" {{ ($record->Month ?? old('Month')) == '02' ? 'selected' : '' }}>February</option>
                <option value="03" {{ ($record->Month ?? old('Month')) == '03' ? 'selected' : '' }}>March</option>
                <option value="04" {{ ($record->Month ?? old('Month')) == '04' ? 'selected' : '' }}>April</option>
                <option value="05" {{ ($record->Month ?? old('Month')) == '05' ? 'selected' : '' }}>May</option>
                <option value="06" {{ ($record->Month ?? old('Month')) == '06' ? 'selected' : '' }}>June</option>
                <option value="07" {{ ($record->Month ?? old('Month')) == '07' ? 'selected' : '' }}>July</option>
                <option value="08" {{ ($record->Month ?? old('Month')) == '08' ? 'selected' : '' }}>August</option>
                <option value="09" {{ ($record->Month ?? old('Month')) == '09' ? 'selected' : '' }}>September</option>
                <option value="10" {{ ($record->Month ?? old('Month')) == '10' ? 'selected' : '' }}>October</option>
                <option value="11" {{ ($record->Month ?? old('Month')) == '11' ? 'selected' : '' }}>November</option>
                <option value="12" {{ ($record->Month ?? old('Month')) == '12' ? 'selected' : '' }}>December</option>
              </select>
            </label>

            <!-- 'Name_of_Student(s) -->
            <label class="block">
                    <span class="text-sm text-gray-600">Name of Students</span>
                    <textarea name="name_of_students" id="name_of_students" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2" required 
                    >{{ $record['Name_of_student(s)'] ?? old('Name_of_student(s)') }}</textarea>
            </label>


            <!-- Roll No -->
            <label class="block">
                    <span class="text-sm text-gray-600">Roll No</span>
                    <textarea name="roll_no" id="roll_no" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2"
                     required>{{ $record->Roll_No ?? old('Roll_No') }}</textarea>
            </label>  
                    
            <!-- Staff(if_guided) -->
            <label class="block">
                    <span class="text-sm text-gray-600">Staff(if_guided)</span>
                    
                    <input  type="text" id="date" name="staff_ifguided" required  value="{{ $record['Staff(if_guided)']?? old('Staff(if_guided)') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
            
            <!-- Title of the Paper -->
            <label class="block">
                    <span class="text-sm text-gray-600">Title of the Paper</span>

                    <input  type="text" id="title_of_the_paper" name="title_of_the_paper" required  value="{{ $record->Title_of_the_Paper ?? old('Title_of_the_Paper') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>
     
    
            <!-- Name_of_the_Journal -->
            <label class="block">
                    <span class="text-sm text-gray-600">Name of the Journal</span>
                    
                    <input  type="text" id="name_of_the_journal" name="name_of_the_journal" required value="{{ $record->Name_of_the_Journal ?? old('Name_of_the_Journal') }}" class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <!-- volumne_no -->
            <label class="block">
                    <span class="text-sm text-gray-600">Volume No</span>
                    
                    <input  type="text" id="volumne_no" name="volumne_no" required  value="{{ $record['Volume_No'] ?? old('Volume_No') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <!-- Page_Nos -->
            <label class="block">
                    <span class="text-sm text-gray-600">Page No's</span>
                    
                    <input  type="number" id="page_no" name="page_no" required  value="{{ $record['Page_Nos'] ?? old('Page_Nos') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <!-- Conference_Details -->
            <label class="block">
                    <span class="text-sm text-gray-600">Conference Details</span>
                    
                    <input  type="text" id="conference_details" name="conference_details" required  value="{{ $record['Conference_Details'] ?? old('Conference_Details') }}" 
                    class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2">
            </label>

            <!-- National/International -->
            <label class="block">
							<span class="text-sm text-gray-600">National / International</span>

							<select
								name="national_international"
								id="national_international"
								class="w-full border-b border-pink-400 focus:outline-none focus:border-pink-600 py-2 bg-transparent"
								required
							>
								<option value="" disabled {{ empty($record['National/International'] ?? old('national_international')) ? 'selected' : '' }}>
									Select Level
								</option>

								<option value="National" {{ ($record['National/International'] ?? old('national_international')) == 'National' ? 'selected' : '' }}>
									National
								</option>
								<option value="International" {{ ($record['National/International'] ?? old('national_international')) == 'International' ? 'selected' : '' }}>
									International
								</option>
							</select>
						</label>

						<!-- Department -->
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
