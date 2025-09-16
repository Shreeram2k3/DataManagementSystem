@extends('layouts.navbar')
<head>
    <title>{{ $type }}</title>
    <link rel="shortcut icon" href="colorlogo.png" >
</head>
@section('content')
@php
    $title = '';

    if ($type == 'FA_I')
        $title = 'F. A. I (a). Publication of Papers in the Journals';
    elseif($type=='FA_II')
        $title='F. A. I (b) Book / Chapter contribution in Publications';
    elseif($type=='FA_III')
        $title='F. A. I (c) Patents Generated / Filed:';
    elseif($type=='FA_IV')
        $title='F.A.II  Seminar / Symposium/ Conferences / Training Programmes (Less than one week) (Paper Presented / Participated)';
    elseif($type=='FA_V')
        $title='F. A. III. International /  National / Conferences / Seminar – Organized';
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

    
@endphp

<!-- Flash Messages -->
<div x-data="{ show: true, seconds: 3 }"
     x-init="let timer = setInterval(() => {
        if (seconds > 0) seconds--;
        else show = false;
     }, 1000)"
     x-show="show"
     class="flex justify-center mt-10">

    @if (session('success'))
        <div class="flex items-center space-x-4 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded shadow-lg">
            <div class="text-base font-medium">
                {{ session('success') }}
            </div>
            <div class="w-8 h-8 rounded-full bg-red-300 text-white flex items-center justify-center text-sm font-light animate-pulse shadow-md">
                <span x-text="seconds"></span>s
            </div>
        </div>
    @endif

    @if (session('delete'))
        <div class="flex items-center space-x-4 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded shadow-lg">
            <div class="text-base font-medium">
                {{ session('delete') }}
            </div>
        </div>
    @endif
</div>

<!-- Main Content -->
<div class="bg-white shadow p-6 rounded-xl mt-10 ml-12 mr-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-10 mt-5">
        Manage, {{ $title }}
    </h1>
    <hr>

    <section class="flex flex-col lg:flex-row min-h-screen">
        <div class="w-full lg:w-1/2 flex items-center justify-center p-4 bg-white">
            <div id="lottie-animation" class="w-full h-full sm:h-[500px] lg:h-[600px]"></div>
        </div>
        
        <script src="https://unpkg.com/lottie-web@5.10.2/build/player/lottie.min.js"></script>
        <script>
            const anim = lottie.loadAnimation({
                container: document.getElementById('lottie-animation'),
                path: '{{ asset("Office Work.json") }}',
                renderer: 'svg',
                loop: true,
                autoplay: false
            });
            
            anim.addEventListener('data_ready', () => {
                const fps = anim.frameRate;
                const startFrame = Math.floor(2 * fps);
                const endFrame = anim.totalFrames;
                anim.playSegments([startFrame, endFrame], true);
            });
            </script>

            @switch($type)
                 @case('FA_I')
                      @include('user.FacultyActivityViews.FacultyActivityForms.FA_I')
                      @break

                      @endswitch
             </section>

             <br><hr>

<!-- --------------------------------------------------------------------------------------------------------------------------- -->
        <h1 class="font-semibold text-2xl  mt-10 ml-2" >View Data</h1>
                        <div class="  mt-8">
                            <div class="bg-white shadow-md overflow-x-auto  rounded-lg overflow-hidden ">
                                <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
                                    @switch($type)
                                        @case('FA_I')
                                            @include('user.FacultyActivityViews.FacultyActivityTables.FA_ITable') 
                                            @break
                                    
                                    @endswitch

                                </table>
                        </div>
                  </div>
</div>

                               

@endsection
