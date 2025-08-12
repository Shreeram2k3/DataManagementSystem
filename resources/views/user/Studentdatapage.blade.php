@extends('layouts.navbar')

@section('content')
@php
   $title = '';
    
    if($type=='SA_I')
           $title='S.A.I. Department Association Activities-CEO/ Leader of the Week / Conference  / Symposium  / Workshop / Seminar/GL';
    elseif($type=='SA_II')
           $title='S. A. II. Details of Students who Participated /Presented (National Level Event)'; 
    elseif($type=='SA_III')
           $title='S. A. III. Conference  / Symposium  / Workshop / Seminar Attended by Students';
    elseif($type=='SA_IV')
           $title='S. A. IV.  Students Projects  Submitted / Sanctioned';
@endphp
<!------------------------------------------- Flash Messages----------------------------------------------------->

            <div x-data="{ show: true, seconds: 5 }" 
            x-init="let timer = setInterval(() => {
                if (seconds > 0) seconds--;
                else show = false;
            }, 1000)" 
            x-show="show"
            class="flex justify-center mt-10">

            @if (session('success'))
            <div class="flex items-center space-x-4 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded shadow-lg">
                <!-- Success Message -->
                <div class="text-base font-medium">
                    {{ session('success') }}
                </div>

                <!-- Timer Circle -->
                <div class="w-8 h-8 rounded-full bg-red-300 text-white flex items-center justify-center text-sm font-light animate-pulse shadow-md">
                    <span x-text="seconds"></span>s
                </div>
            </div>
            @endif
            @if(session('delete'))
                <div class="flex items-center space-x-4 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded shadow-lg">
                <!-- deleted Message -->
                <div class="text-base font-medium">
                    {{ session('delete') }}
                </div>
                </div>
            @endif


        </div>
<!------------------------------------------- Flash Messages ends here ----------------------------------------------------->




              
     <div class="bg-white shadow p-6 rounded-xl mt-10 ml-12 mr-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-10 mt-5">
            Manage, {{$title}} <span class="inline-block"></span>
        </h1>
            <hr>
            
           <section class="flex flex-col lg:flex-row min-h-screen">
              <!-- Lottie Animation -->
                    <div class="w-full lg:w-1/2 flex items-center justify-center p-4 ">
                        <div id="lottie-animation" class="w-full max-w-[500px] h-[400px] sm:h-[500px] lg:h-[600px]"></div>
                    </div>

             <!-- Lottie Script -->
                    <script src="https://unpkg.com/lottie-web@5.10.2/build/player/lottie.min.js"></script>
                     <script>
                             lottie.loadAnimation({
                             container: document.getElementById('lottie-animation'),
                             path: '{{ asset("Technology.json") }}',
                             renderer: 'svg',
                             loop: true,
                             autoplay: true,
                });
                </script>
                    @switch($type)
                        @case('SA_I')
                            @include('StudentActivityViews.SA_I')
                            @break
                            
                            @case('SA_II')
                            @include('StudentActivityViews.SA_II')
                            @break
                            
                            @case('SA_III')
                            @include('StudentActivityViews.SA_III')
                            @break

                            @case('SA_IV')
                            @include('StudentActivityViews.SA_IV')
                            @break
                            {{-- Add cases for all 15 --}}
                            
                            @default
                            <p class="text-red-500">Form not found.</p>
                            @endswitch
                         </section> 

                   <br><hr>
<!------------------------------------------------ Display the data in a table format -------------------------------------------------------------------------------------------------------->   
                        <div class="  mt-10">
                            <div class="bg-white shadow-md overflow-x-auto  rounded-lg overflow-hidden ">
                                <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
                                    <thead class="bg-gray-100 text-gray-900 uppercase">
                                        <tr>
                                        @if($type=='SA_I')
                                            <th class="px-4 py-3 border">S.No</th>
                                            <th class="px-4 py-3 border">Name of Programme</th>
                                            <th class="px-4 py-3 border">Topic</th>
                                            <th class="px-4 py-3 border">Date</th>
                                            <th class="px-4 py-3 border">Speaker Details</th>
                                            <th class="px-4 py-3 border">Outcome</th>
                                            <th class="px-4 py-3 border">Students Participated</th>
                                            <th class="px-4 py-3 border">Document Link</th>
                                            
                                        @elseif ($type=='SA_II')
                                            <th class="px-4 py-3 border">S.No</th>
                                            <th class="px-4 py-3 border">Name of Students</th>
                                            <th class="px-4 py-3 border">Roll No</th>
                                            <th class="px-4 py-3 border">Class</th>
                                            <th class="px-4 py-3 border">Title of Event/Presentation</th>
                                            <th class="px-4 py-3 border">Venue</th>
                                            <th class="px-4 py-3 border">Prize/Place</th>
                                            <th class="px-4 py-3 border">Date</th>
                                            <th class="px-4 py-3 border">Document Link</th>
                                        @elseif ($type=='SA_III')
                                              <th class="px-4 py-3 border">S.No</th>
                                              <th class="px-4 py-3 border">Date</th>
                                              <th class="px-4 py-3 border">Name of Program</th>
                                              <th class="px-4 py-3 border">Speaker Details / Converner Details</th>
                                              <th class="px-4 py-3 border">Coordinator</th>
                                              <th class="px-4 py-3 border">Duration</th>
                                              <th class="px-4 py-3 border">Dept</th>
                                              <th class="px-4 py-3 border">Outcome</th>
                                              <th class="px-4 py-3 border">Campus Document ID</th>
                                     @elseif ($type=='SA_IV')
                                            <th class="px-4 py-3 border">S.No</th>
                                            <th class="px-4 py-3 border">Name of Students</th>
                                            <th class="px-4 py-3 border">Roll No</th>
                                            <th class="px-4 py-3 border">Name Of Guide</th>
                                            <th class="px-4 py-3 border">Title of Project</th>
                                            <th class="px-4 py-3 border">Submitted/Sanctioned</th>
                                            <th class="px-4 py-3 border">Sponsoring Agency Date of Submission/Sanctioned'</th>
                                            <th class="px-4 py-3 border">Amount Sanctioned in (RS)</th>
                                            <th class="px-4 py-3 border">Department</th>
                                            <th class="px-4 py-3 border">Document Link</th>
                                        @endif

                                            <th class="px-4 py-3 border">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <!-- Check if the data for the selected type is available -->
                                    @if($data[$type]->count() === 0 || empty($data[$type]))
                                    <td  class="text-gray-500 text-center px-4 py-2 border" colspan="8">
                                        <strong class="text-red-500">No Data Available</strong><br>
                                
                                    </td>
                                    @else
                                                @foreach ($data[$type] as $item)
                                            <tbody class="bg-white">
                                                <tr class="border-t hover:bg-gray-50">
                                            @if($type=='SA_I')
                                                <td class="px-4 py-2 border">{{ $item->S_NO }}</td>
                                                <td class="px-4 py-2 border">{{ $item->name_of_programme }}</td>
                                                <td class="px-4 py-2 border">{{ $item->topic }}</td>
                                                <td class="px-4 py-2 border">{{ $item->date }}</td>
                                                <td class="px-4 py-2 border">{{ $item->speaker_details }}</td>
                                                <td class="px-4 py-2 border">{{ $item->outcome }}</td>
                                                <td class="px-4 py-2 border">{{ $item->students_participated }}</td>
                                                <td class="px-4 py-2 border"><a href="{{ $item->document_link }}">{{ $item->document_link }}</a></td>
                                            @elseif ($type=='SA_II')
                                                <td class="px-4 py-2 border">{{ $item->S_NO }}</td>
                                                <td class="px-4 py-2 border">{{ $item['Name_of_student(s)'] }}</td>
                                                <td class="px-4 py-2 border">{{ $item->Roll_No}}</td>
                                                <td class="px-4 py-2 border">{{ $item->class}}</td>
                                                <td class="px-4 py-2 border">{{ $item['Title_of_Event/Presentation']}}</td>
                                                <td class="px-4 py-2 border">{{ $item->Venue }}</td>
                                                <td class="px-4 py-2 border">{{ $item['Prize/place'] }}</td>
                                                <td class="px-4 py-2 border">{{ $item->Date }}</td>
                                                <td class="px-4 py-2 border"><a href="{{ $item->Document_Link }}">{{ $item->Document_Link }}</a></td>
                                            @elseif ($type=='SA_III')
                                                <td class="px-4 py-2 border">{{ $item->S_NO }}</td>
                                                <td class="px-4 py-2 border">{{ $item->Date }}</td>
                                                <td class="px-4 py-2 border">{{ $item->Name_of_programme }}</td>
                                                <td class="px-4 py-2 border">{{ $item['Speaker_details/Convener&details'] }}</td>
                                                <td class="px-4 py-2 border">{{ $item->Coordinator}}</td>
                                                <td class="px-4 py-2 border">{{ $item->Duration}}</td>
                                                <td class="px-4 py-2 border">{{ $item->Dept}}</td>
                                                <td class="px-4 py-2 border">{{ $item->Outcome}}</td>
                                                <td class="px-4 py-2 border">{{ $item->CAMPUS_Document_ID}}</td>
                                            @elseif ($type=='SA_IV')
                                               <td class="px-4 py-2 border">{{ $item->S_NO}}</td>
                                               <td class="px-4 py-2 border">{{ $item['Name_of_student(s)']}}</td>
                                               <td class="px-4 py-2 border">{{ $item->Roll_No}}</td>
                                               <td class="px-4 py-2 border">{{ $item->Name_of_the_Guide}}</td>
                                               <td class="px-4 py-2 border">{{ $item->Title_of_Project}}</td>
                                               <td class="px-4 py-2 border">{{ $item['Submitted/Sanctioned']}}</td>
                                               <td class="px-4 py-2 border">{{ $item['Sponsoring_Agency_Date_of_Submission/Sanctioned']}}</td>
                                               <td class="px-4 py-2 border">{{ $item['Amount_Sanctioned_in_(Rs)']}}</td>
                                               <td class="px-4 py-2 border">{{ $item->Dept}}</td>
                                              <td class="px-4 py-2 border"><a href="{{ $item->Document_link }}">{{ $item->Document_link }}</a></td>
                                            @endif

                                                <td class="py-3 px-4 border text-center">
                                            <div class="flex justify-center rounded-lg overflow-hidden">
                                                <!-- Edit Icon -->
                                                <a href="{{ route('student_activity_edit', ['type' => $type, 'id' => $item->S_NO]) }}" 
                                                  class="p-2 bg-stone-700 text-white hover:bg-stone-900 transition">
                                                       <i class="fa-solid fa-pen"></i>
                                                        </a>

                                            
                                                    
                                                <!-- Delete Icon -->
                                                
                                                    <form action="{{ route('student_activity_delete', ['type' => $type, 'id' => $item->S_NO]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 bg-red-500 text-white hover:bg-red-600 transition rounded-r-lg">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                              

                                            </div>
                                        </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                                @endif
                                

               
                   
</div>

@endsection


 
                     

     
