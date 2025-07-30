@extends('layouts.navbar')

@section('content')
    <div class="bg-white shadow p-6 rounded-xl mt-10 ml-10 mr-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-10 mt-5">
            Welcome back, {{ strtoupper(Auth::user()->name) }}! <span class="inline-block">👋</span>
        </h1>

        <hr>
        

        <!-- Activities div -->
        <div class="p-6 mt-10 mx-auto max-w-7xl">
                <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">

                    <!-- Student activities -->
                    <a href="{{route('studentactivity') }}" class="group">
                    <div class="rounded-2xl shadow-lg border border-gray-200 bg-white/80 backdrop-blur-md overflow-hidden transition-transform transform hover:-translate-y-2 hover:shadow-2xl">
                        <!-- Header Section -->
                        <div class="h-32 bg-white flex items-center justify-center border-b">
                        <div class="w-16 h-16 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-2xl font-bold">
                            S
                        </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                        <h3 class="text-gray-900 text-lg font-semibold mb-2 group-hover:text-blue-600 transition duration-300">
                            Student Activities
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed"> co-curricular and extra-curricular activities of students.</p>
                        </div>
                    </div>
                    </a>
                    <!-- student activities end here -->

                    <!-- Faculty activities -->
                    <a href="{{route('facultyactivity') }}" class="group">
                    <div class="rounded-2xl shadow-lg border border-gray-200 bg-white/80 backdrop-blur-md overflow-hidden transition-transform transform hover:-translate-y-2 hover:shadow-2xl">
                        <!-- Header Section -->
                        <div class="h-32 bg-white flex items-center justify-center border-b">
                        <div class="w-16 h-16 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-2xl font-bold">
                            F
                        </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                        <h3 class="text-gray-900 text-lg font-semibold mb-2 group-hover:text-green-600 transition duration-300">
                            Faculty Activities
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">workshops, research, and seminars by faculty members.</p>
                        </div>
                    </div>
                    </a>
                    <!-- faculty activities end here -->

                    <!-- Department activities -->
                    <a href="{{route('departmentactivity')}}" class="group">
                    <div class="rounded-2xl shadow-lg border border-gray-200 bg-white/80 backdrop-blur-md overflow-hidden transition-transform transform hover:-translate-y-2 hover:shadow-2xl">
                        <!-- Header Section -->
                        <div class="h-32 bg-white flex items-center justify-center border-b">
                        <div class="w-16 h-16 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-2xl font-bold">
                            D
                        </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                        <h3 class="text-gray-900 text-lg font-semibold mb-2 group-hover:text-purple-600 transition duration-300">
                            Department Activities
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed"> Activities organized at the department level throughout the year.</p>
                        </div>
                    </div>
                    </a>
                    <!-- department activities end here -->

                </div>
        </div>


    </div>

@endsection
