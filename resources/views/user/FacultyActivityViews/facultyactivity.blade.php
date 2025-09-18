@extends('layouts.navbar')

@section('content')
<div class="bg-white shadow p-6 rounded-xl mt-10 ml-10 mr-10">
    <h1 class="text-3xl font-bold text-gray-900 mb-10 mt-5">
       Manage Faculty Activities!
    </h1>

    <hr class="mb-10">
   <div class="overflow-x-auto rounded-lg shadow-md">
      <table class="min-w-full bg-white border border-gray-300 text-sm sm:text-base">
        <thead class="bg-gray-200 text-gray-700 uppercase text-center sticky top-0">
          <tr>
            <th class="py-3 px-4 border">Sno</th>
            <th class="py-3 px-4 border">Faculty Activities</th>
            <th class="py-3 px-4 border">Action</th>
             
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="py-3 px-4 border">1</td>
            <td class="py-3 px-4 border">F. A. I (a). Publication of Papers in the Journals</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{route('FA.view', ['type' => 'FA_I']) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          


        </tbody>
      </table>
    </div>
</div>
@endsection