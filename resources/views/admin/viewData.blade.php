@extends('layouts.adminnav')
<head>
    <title>
       view {{$type}} Datas
    </title>
    <link rel="shortcut icon" href="colorlogo.png" type="image.jpg">
</head>
@section('content')

@php
   $title = '';

  
    $showActions = false; 


    
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
    elseif($type=='SA_XI')
            $title='S.A.XI. Placement Activities';
    elseif($type=='SA_XII')
            $title='S. A. XII Student Activities Others';
    elseif($type=='SA_XIII')
            $title='S. A. XIII Industry Visit by students';
    elseif($type=='SA_XIV')
            $title='S.B.I. Students Alumni Meet. / News ';
    elseif($type=='SA_XV')
            $title='S. B.II. Parents Teachers Meeting';
    
    elseif ($type == 'FA_I')
        $title = 'F. A. I (a). Publication of Papers in the Journals';
    elseif($type=='FA_II')
        $title='F. A. I (b) Book / Chapter contribution in Publications';
    elseif($type=='FA_III')
        $title='F. A. I (c) Patents Generated / Filed:';
    elseif($type=='FA_IV')
        $title='F.A.II  Seminar / Symposium/ Conferences / Training Programmes (Less than one week) (Paper Presented / Participated)';
    elseif($type=='FA_V')
        $title='F. A. III. International /  National / Conferences / Seminar - Organized';
    elseif($type=='FA_VI')
        $title='F. A. IV. Summer School / Winter School / FDP or SDP (at least one week) attended by Staff Members';
    elseif($type=='FA_VII')
        $title='F. A. V.  Event / Winter / Summer School Proposals Submitted / Sanctioned';
    elseif($type=='FA_VIII')
        $title='F. A. VI. AICTE / ISTE Sponsored  / Faculty Development Programmes - Events Organized ';
    elseif($type=='FA_IX')
        $title='F.A.VII. Details of Industrial Training Undergone by the Faculty Members';
    elseif($type=='FA_X')
        $title='F.A.VIII. Special Lectures Delivered By Faculty Members';
    elseif($type=='FA_XI')
        $title='F. A. IX.  Non-Teaching Staff Training Programmes';
    elseif($type=='FA_XII')
        $title='F.A.X. Faculty Members Deputed for Higher Studies Undergoing / Completed:  (Specify only for the period under Report)';
    elseif($type=='FA_XIII')
        $title='F.A.XI. Faculty Members Guiding Ph D Scholars ';
    elseif($type=='FA_XIV')
        $title='F.A.XII.  Projects Proposals Submitted / Sanctioned';
    elseif($type=='FA_XV')
        $title='F.A.XIII Details of Consultancy Services of the Department:';
    elseif($type=='FA_XVI')
        $title='F.A.XIV Details of MoUs signed';
    elseif($type=='FA_XVII')
        $title='F.A.XV Industry visits by Faculty Member';
    elseif($type=='FA_XVIII')
        $title='F.A.XVI Faculty Members Received Award / Applied for Any Awards';
    elseif($type=='FA_XIX')
        $title='F. A. XVII Supervisor Recognition';
    elseif($type=='FA_XX')
        $title='F.A.XVIII – IRP Visit ';
    elseif($type=='FA_XXI')
        $title='F. A. XIX. Faculty Recruited. Relieved					';
    elseif($type=='FA_XXII')
        $title='F.A.XX Staff Activities - Others - AUR / Valuvation / I.E / E.E
';



elseif($type=='DA_I')
           $title='D. A. I. Details of New Equipment Purchased in the Department';
    elseif($type=='DA_II')
           $title='D. A. II. Equipment Failure/ Service Status in the Department '; 
    elseif($type=='DA_III')
           $title='D. A. III.  Departmental Library:';
    elseif($type=='DA_IV')
           $title='D. A. IV. VIPs  Visit / Inspection to the Department / Audit';
    elseif($type=='DA_V')
            $title='D. A. V. Newsletters Released (All)';
    elseif($type=='DA_VI')
            $title='D. A. VI. Activities for Competitive Examination / Higher Education / EDC';
    elseif($type=='DA_VII')
            $title='D. A. VII. Awards/ Prizes won by Students';
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
            @if(session('failed'))
                <div class="flex items-center space-x-4 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded shadow-lg">
                <!-- deleted Message -->
                <div class="text-base font-medium">
                    {{ session('failed') }}
                </div>
                </div>
            @endif


        </div>
<!------------------------------------------- Flash Messages ends here ----------------------------------------------------->

<div class="bg-white shadow p-6 rounded-xl mt-10 ml-12 mr-12 mb-16">
        <h1 class="text-3xl font-bold text-gray-900 mb-10 mt-5">
             {{$title}} <span class="inline-block"></span>
        </h1>
            <hr>

            <!------------------------------------------------ Display the data in a table format -------------------------------------------------------------------------------------------------------->   
                       <h1 class="font-semibold text-2xl  mt-10 ml-2" >View Data</h1>
                        <div class="  mt-8">
                            <div class="bg-white shadow-md overflow-x-auto  rounded-lg overflow-hidden ">
                                <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
                                      @switch($type)
                                        @case('SA_I')
                                            @include('user.StudentActivityViews.StudentActivityTables.SA_ITable',['showActions' => $showActions])
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

                                        @case('FA_I')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_ITable') 
                                            @break
                                        @case('FA_II')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_IITable') 
                                            @break
                                        @case('FA_III')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_IIITable') 
                                            @break
                                        @case('FA_IV')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_IVTable') 
                                            @break
                                        @case('FA_V')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_VTable') 
                                            @break
                                        @case('FA_VI')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_VITable') 
                                            @break
                                        @case('FA_VII')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_VIITable') 
                                            @break
                                        @case('FA_VIII')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_VIIITable') 
                                            @break
                                        @case('FA_IX')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_IXTable') 
                                            @break
                                        @case('FA_X')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XTable') 
                                            @break
                                        @case('FA_XI')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XITable') 
                                            @break
                                        @case('FA_XII')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XIITable') 
                                            @break
                                        @case('FA_XIII')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XIIITable') 
                                            @break
                                        @case('FA_XIV')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XIVTable') 
                                            @break
                                        @case('FA_XV')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XVTable') 
                                            @break
                                        @case('FA_XVI')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XVITable') 
                                            @break
                                        @case('FA_XVII')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XVIITable') 
                                            @break
                                        @case('FA_XVIII')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XVIIITable') 
                                            @break
                                        @case('FA_XIX')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XIXTable') 
                                            @break
                                        @case('FA_XX')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XXTable') 
                                            @break
                                        @case('FA_XXI')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XXITable') 
                                            @break
                                        @case('FA_XXII')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_XXIITable') 
                                            @break

                                         @case('DA_I')
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_ITable')
                                            @break

                                        @case('DA_II')
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_IITable')
                                            @break

                                        @case('DA_III')
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_IIITable')
                                            @break

                                        @case('DA_IV')
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_IVTable')
                                            @break

                                        @case('DA_V')
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_VTable')
                                            @break

                                        @case('DA_VI')
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_VITable')
                                            @break

                                        @case('DA_VII')
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_VIITable')
                                            @break
                                        
                                        @case('DA_VIII')
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_VIIITable')
                                            @break

                                        @case('DA_IX')
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_IXTable')
                                            @break

                                        @case('DA_X')
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_XTable')
                                            @break

                                        @case("DA_XI")
                                            @include('user.DepartmentActivityViews.DepartmentActivityTables.DA_XITable')
                                            @break

                                        

                                      @default
                                            <p class="text-red-500">table not found.</p>
                                      @endswitch
                                    
                                </table>
                            </div>
                        </div>
                         

</div>



@endsection