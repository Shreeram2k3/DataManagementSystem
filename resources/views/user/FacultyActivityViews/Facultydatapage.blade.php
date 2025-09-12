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
