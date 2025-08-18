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
    elseif($type=='SA_V')
            $title='S. A. V. Open House Exhibition Models Displayed by Students';
    elseif($type=='SA_VI')
            $title='S. A. VI. Details of Students Who Participated  /  Won Sports / Games / NCC / NSS  / NPTEL';
    elseif($type=='SA_VII')
            $title='S. A. VII. Publication of Papers in the Journal  / Conference Proceedings by Students';
    elseif($type=='SA_VIII')
            $title='S.A.VIII. Placed Students Details';
    elseif($type=='SA_IX')
            $title='S.A.IX. Value Added Courses  / One Credit Courses Conducted ';
    elseif($type=='SA_X')
            $title='S.A.X Internship / In-plant Training / Industrial Training';

@endphp
<!------------------------------------------- Flash Messages----------------------------------------------------->

            <div x-data="{ show: true, seconds: 3 }" 
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
                        <div id="lottie-animation" class="w-full h-full sm:h-[500px] lg:h-[600px]"></div>
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
                            @include('user.StudentActivityViews.StudentActivityForms.SA_I')
                            @break
                            
                            @case('SA_II')
                            @include('user.StudentActivityViews.StudentActivityForms.SA_II')
                            @break
                            
                            @case('SA_III')
                            @include('user.StudentActivityViews.StudentActivityForms.SA_III')
                            @break

                            @case('SA_IV')
                            @include('user.StudentActivityViews.StudentActivityForms.SA_IV')
                            @break

                            @case('SA_V')
                            @include('user.StudentActivityViews.StudentActivityForms.SA_V')
                            @break

                            @case('SA_VI')
                            @include('user.StudentActivityViews.StudentActivityForms.SA_VI')
                            @break 

                            @case('SA_VII')
                            @include('user.StudentActivityViews.StudentActivityForms.SA_VII')
                            @break
                            
                            @case('SA_VIII')
                            @include('user.StudentActivityViews.StudentActivityForms.SA_VIII')
                            @break

                            @case('SA_IX')
                            @include('user.StudentActivityViews.StudentActivityForms.SA_IX')
                            @break

                            @case('SA_X')
                            @include('user.StudentActivityViews.StudentActivityForms.SA_X')
                            @break
                            {{-- Add cases for all 15 --}}
                            
                            @default
                            <p class="text-red-500">Form not found.</p>
                            @endswitch
                         </section> 

                   <br><hr>
<!------------------------------------------------ Display the data in a table format -------------------------------------------------------------------------------------------------------->   
                       <h1 class="font-semibold text-2xl  mt-10 ml-2" >View Data</h1>
                        <div class="  mt-8">
                            <div class="bg-white shadow-md overflow-x-auto  rounded-lg overflow-hidden ">
                                <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
                                      @switch($type)
                                        @case('SA_I')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_ITable')
                                            @break

                                        @case('SA_II')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_IITable')
                                            @break

                                        @case('SA_III')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_IIITable')
                                            @break

                                        @case('SA_IV')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_IVTable')
                                            @break

                                        @case('SA_V')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_VTable')
                                            @break

                                        @case('SA_VI')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_VITable')
                                            @break

                                        @case('SA_VII')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_VIITable')
                                            @break
                                        
                                        @case('SA_VIII')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_VIIITable')
                                            @break

                                        @case('SA_IX')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_IXTable')
                                            @break

                                        @case('SA_X')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_XTable')
                                            @break
                                        

                                      @default
                                            <p class="text-red-500">table not found.</p>
                                      @endswitch
                                    
                                </table>
                            </div>
                        </div>
                                
                                

               
                   
</div>

@endsection


 
                     

     
