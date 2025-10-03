@extends('layouts.navbar')

@section('content')
<div class="bg-white shadow p-6 rounded-xl mt-10 ml-10 mr-10 mb-16">
    <h1 class="text-3xl font-bold text-gray-900 mb-10 mt-5">
       Manage Department Activities!
    </h1>

    <hr class="mb-10">
   <div class="overflow-x-auto rounded-lg shadow-md mb-10">
      <table class="min-w-full bg-white border border-gray-300 text-sm sm:text-base">
        <thead class="bg-gray-200 text-gray-700 uppercase text-center sticky top-0">
          <tr>
            <th class="py-3 px-4 border">Sno</th>
            <th class="py-3 px-4 border">Department Activities</th>
            <th class="py-3 px-4 border">Action</th>
             
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="py-3 px-4 border">1</td>
            <td class="py-3 px-4 border">D. A. I. Details of New Equipment Purchased in the Department</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_I']) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">2</td>
            <td class="py-3 px-4 border">D. A. II. Equipment Failure/ Service Status in the Department</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_II']) }} " target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">3</td>
            <td class="py-3 px-4 border">D. A. III.  Departmental Library</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_III']) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">4</td>
            <td class="py-3 px-4 border">D. A. IV. VIPs  Visit / Inspection to the Department / Audit </td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_IV']) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">5</td>
            <td class="py-3 px-4 border">D. A. V. Newsletters Released (All) </td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_V']) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">6</td>
            <td class="py-3 px-4 border">D. A. VI. Activities for Competitive Examination / Higher Education / EDC</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_VI']) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">7</td>
            <td class="py-3 px-4 border">D. A. VII. Awards/ Prizes won by Students </td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_VII']) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">8</td>
            <td class="py-3 px-4 border">D. A. VIII. Board of Studies Meeting / PAC / DAAC / GCM / AGM</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_VIII']) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">9</td>
            <td class="py-3 px-4 border">D. A. IX. Department Activities Others </td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_IX']) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">10</td>
            <td class="py-3 px-4 border">D. A. X. Department Time Table / subject allocation / faculty work load</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_X']) }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">11</td>
            <td class="py-3 px-4 border">D. A. XI. Result Analysis / Sample QP / Answer Sheet / Answer key / Remedial Class</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{ route('DA.view', ['type' => 'DA_XI']) }}" target="_blank" rel="noopener noreferrer"
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