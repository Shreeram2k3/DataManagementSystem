@extends('layouts.navbar')
<head>
    <title>
        {{$type}}
    </title>
    <link rel="shortcut icon" href="colorlogo.png" type="image.jpg">
</head>
@section('content')
@php
   $title = '';
    
    if($type=='DA_I')
           $title='F. A. I (a). Publication of Papers in the Journals';
    elseif($type=='DA_II')
           $title='F. A. I (b) Book / Chapter contribution in Publications'; 
    elseif($type=='DA_III')
           $title='F. A. I (c) Patents Generated / Filed';
    elseif($type=='DA_IV')
           $title='D. A. IV. VIPs  Visit / Inspection to the Department / Audit';
    elseif($type=='DA_V')
            $title='D. A. V. Newsletters Released (All)';
    elseif($type=='DA_VI')
            $title='D. A. VI. Activities for Competitive Examination / Higher Education / EDC';
    elseif($type=='DA_VII')
            $title=D. A. VII. Awards/ Prizes won by Students';
    elseif($type=='DA_VIII')
            $title='D. A. IX. Department Activities Others';
    elseif($type=='DA_IX')
            $title='D. A. VIII. Board of Studies Meeting / PAC / DAAC / GCM / AGM ';
    elseif($type=='DA_X')
            $title='D. A. X. Department Time Table / subject allocation / faculty work load';
    elseif($type=='DA_XI')
            $title='D. A. XI. Result Analysis / Sample QP / Answer Sheet / Answer key / Remedial Class';

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
                             path: '{{ asset("Company Statistic Graph.json") }}',
                             renderer: 'svg',
                             loop: true,
                             autoplay: true,
                });
                </script>
                    @switch($type)
                        @case('DA_I')
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_I')
                            @break
                            
                            @case('DA_II')
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_II')
                            @break
                            
                            @case('DA_III')
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_III')
                            @break

                            @case('DA_IV')
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_IV')
                            @break

                            @case('DA_V')
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_V')
                            @break

                            @case('DA_VI')
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_VI')
                            @break 

                            @case('DA_VII')
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_VII')
                            @break
                            
                            @case('DA_VIII')
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_VIII')
                            @break

                            @case('DA_IX')
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_IX')
                            @break

                            @case('DA_X')
                            @include('user.DepartmentActivityViews.DepartmentActivityFormss.DA_X')
                            @break

                            @case("DA_XI")
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_XI')
                            @break

                            @case("DA_XII")
                            @include('user.DepartmentActivityViews.DepartmentActivityForms.DA_XII')
                            @break

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

                                        @case("SA_XI")
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_XITable')
                                            @break

                                        @case("SA_XII")
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_XIITable')
                                            @break
                                        
                                        @case("SA_XIII")
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_XIIITable')
                                            @break

                                         @case("SA_XIV")
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_XIVTable')
                                            @break

                                        @case("SA_XV")
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_XVTable')
                                            @break
                                        

                                      @default
                                            <p class="text-red-500">table not found.</p>
                                      @endswitch
                                    
                                </table>
                            </div>
                        </div>
                                
                                

               
                   
</div>

@endsection


 
                     

     
