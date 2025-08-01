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
@endphp
     <div class="bg-white shadow p-6 rounded-xl mt-10 ml-12 mr-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-10 mt-5">
            Manage, {{$title}} <span class="inline-block"></span>
        </h1>

        <hr>

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

                {{-- Add cases for all 15 --}}
                
                @default
                    <p class="text-red-500">Form not found.</p>
            @endswitch
    </div>


@endsection