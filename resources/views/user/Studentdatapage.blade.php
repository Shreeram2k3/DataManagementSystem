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

                   <br><hr>
<!------------------------------------------------ Display the data in a table format -------------------------------------------------------------------------------------------------------->
            <div class="max-w-4xl mx-auto mt-10">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
                        <thead class="bg-gray-100 text-gray-900 uppercase">
                            <tr>
                                <th class="px-4 py-3 border">S.No</th>
                                <th class="px-4 py-3 border">Name of Programme</th>
                                <th class="px-4 py-3 border">Topic</th>
                                <th class="px-4 py-3 border">Date</th>
                                <th class="px-4 py-3 border">Speaker Details</th>
                                <th class="px-4 py-3 border">Outcome</th>
                                <th class="px-4 py-3 border">Students Participated</th>
                                <th class="px-4 py-3 border">Document Link</th>
                            </tr>
                        </thead>
                       
                        @foreach ($data[$type] as $item)
                     <tbody class="bg-white">
                
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $item->name_of_programme }}</td>
                        <td class="px-4 py-2 border">{{ $item->topic }}</td>
                        <td class="px-4 py-2 border">{{ $item->date }}</td>
                        <td class="px-4 py-2 border">{{ $item->speaker_details }}</td>
                        <td class="px-4 py-2 border">{{ $item->outcome }}</td>
                        <td class="px-4 py-2 border">{{ $item->students_participated }}</td>
                        <td class="px-4 py-2 border"><a href="{{ $item->document_link }}">{{ $item->document_link }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

     

    </div>

@endsection