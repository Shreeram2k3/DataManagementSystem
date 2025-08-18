@extends('layouts.navbar')

@section('content')

<div class="bg-white shadow p-6 rounded-xl mt-10 ml-10 mr-10">
    <h1 class="text-3xl font-bold text-gray-900 mb-10 mt-5">
       Manage Students Activities!
    </h1>

    <hr class="mb-10">
   <div class="overflow-x-auto rounded-lg shadow-md">
      <table class="min-w-full bg-white border border-gray-300 text-sm sm:text-base">
        <thead class="bg-gray-200 text-gray-700 uppercase text-center sticky top-0">
          <tr>
            <th class="py-3 px-4 border">Sno</th>
            <th class="py-3 px-4 border">Student Activities</th>
            <th class="py-3 px-4 border">Action</th>
            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="py-3 px-4 border">1</td>
            <td class="py-3 px-4 border">S.A.I. Department Association Activities-CEO/ Leader of the Week / Conference  / Symposium  / Workshop / Seminar/GL  </td>
              <td class="py-3 px-4 border text-center">
                <a href="{{route('SA.view',['type'=>'SA_I'])}}"
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
            <td class="py-3 px-4 border">S. A. II. Details of Students who Participated /Presented (National Level Event)</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{route('SA.view',['type'=>'SA_II'])}}"
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
            <td class="py-3 px-4 border">S. A. III. Conference  / Symposium  / Workshop / Seminar Attended by Students</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{route('SA.view',['type'=>'SA_III'])}}"
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
            <td class="py-3 px-4 border">S. A. IV.  Students Projects  Submitted / Sanctioned </td>
              <td class="py-3 px-4 border text-center">
                <a href="{{route('SA.view',['type'=>'SA_IV'])}}"
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
            <td class="py-3 px-4 border">S. A. V. Open House Exhibition Models Displayed by Students </td>
              <td class="py-3 px-4 border text-center">
                <a href="{{route('SA.view',['type'=>'SA_V'])}}"
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
            <td class="py-3 px-4 border">S. A. VI. Details of Students Who Participated  /  Won Sports / Games / NCC / NSS  / NPTEL</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{route('SA.view',['type'=>'SA_VI'])}}"
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
            <td class="py-3 px-4 border">S. A. VII. Publication of Papers in the Journal  / Conference Proceedings by Students </td>
              <td class="py-3 px-4 border text-center">
                <a href="{{route('SA.view',['type'=>'SA_VII'])}}"
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
            <td class="py-3 px-4 border">S.A.VIII. Placed Students Details  </td>
              <td class="py-3 px-4 border text-center">
                <a href="{{route('SA.view',['type'=>'SA_VIII'])}}"
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
            <td class="py-3 px-4 border">S.A.IX. Value Added Courses  / One Credit Courses Conducted </td>
              <td class="py-3 px-4 border text-center">
                <a href="#"
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
            <td class="py-3 px-4 border">S.A.X Internship / In-plant Training / Industrial Training </td>
              <td class="py-3 px-4 border text-center">
                <a href="#"
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
            <td class="py-3 px-4 border">S.A.XI. Placement Activities </td>
              <td class="py-3 px-4 border text-center">
                <a href="#"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">12</td>
            <td class="py-3 px-4 border">S. A. XII Student Activities Others</td>
              <td class="py-3 px-4 border text-center">
                <a href="#"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">13</td>
            <td class="py-3 px-4 border">S. A. XIII Industry Visit by students </td>
              <td class="py-3 px-4 border text-center">
                <a href="#"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">14</td>
            <td class="py-3 px-4 border">S.B.I. Students Alumni Meet. / News  </td>
              <td class="py-3 px-4 border text-center">
                <a href="#"
                    class="inline-flex items-center gap-2 px-4 py-1 text-sm font-medium text-white bg-gradient-to-r from-cyan-600 to-cyan-700 hover:from-cyan-700 hover:to-cyan-800 rounded-md shadow transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                      Manage
                </a>
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">15</td>
            <td class="py-3 px-4 border">S. B.II. Parents Teachers Meeting</td>
              <td class="py-3 px-4 border text-center">
                <a href="#"
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