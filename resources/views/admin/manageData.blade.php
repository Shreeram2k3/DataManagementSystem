@extends('layouts.adminnav')

@section('content')

  <!-- <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-gray-100 p-6"> -->

    <!-- Activity Buttons -->
    <div class="flex flex-col sm:flex-row gap-6 justify-between items-stretch">

      <!-- Student Activity -->
      <button class="flex-1 group relative rounded-2xl p-5 overflow-hidden bg-gradient-to-r from-indigo-500 via-blue-500 to-sky-500 text-white shadow-md transition transform hover:-translate-y-1 hover:shadow-xl">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-300/30 to-sky-200/30 opacity-0 group-hover:opacity-100 transition"></div>
        <div class="relative flex items-center gap-4">
          <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/>
            </svg>
          </div>
          <div class="text-left">
            <div class="text-lg font-semibold tracking-wide">Student Activity</div>
          </div>
        </div>
      </button>

      <!-- Faculty Activity -->
      <button class="flex-1 group relative rounded-2xl p-5 overflow-hidden bg-gradient-to-r from-emerald-500 via-green-400 to-lime-400 text-white shadow-md transition transform hover:-translate-y-1 hover:shadow-xl">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-300/30 to-lime-200/30 opacity-0 group-hover:opacity-100 transition"></div>
        <div class="relative flex items-center gap-4">
          <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
            </svg>
          </div>
          <div class="text-left">
            <div class="text-lg font-semibold tracking-wide">Faculty Activity</div>
          </div>
        </div>
      </button>

      <!-- Department Activity -->
      <button class="flex-1 group relative rounded-2xl p-5 overflow-hidden bg-gradient-to-r from-purple-600 via-pink-500 to-rose-500 text-white shadow-md transition transform hover:-translate-y-1 hover:shadow-xl">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-300/30 to-rose-200/30 opacity-0 group-hover:opacity-100 transition"></div>
        <div class="relative flex items-center gap-4">
          <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h18M3 12h18M3 17h18"/>
            </svg>
          </div>
          <div class="text-left">
            <div class="text-lg font-semibold tracking-wide">Department Activity</div>
          </div>
        </div>
      </button>
    </div>

    
    <!-- <div class="mt-8 bg-gray-50 p-6 rounded-xl border border-gray-200"> -->


    

   
   <div class=" mt-8 overflow-x-auto rounded-lg shadow-md border border-gray-200">
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
                <input type="checkbox" >
              </td>
          </tr>

          <tr>
            <td class="py-3 px-4 border">2</td>
            <td class="py-3 px-4 border">S. A. II. Details of Students who Participated /Presented (National Level Event)</td>
              <td class="py-3 px-4 border text-center">
                <a href="{{route('SA.view',['type'=>'SA_II'])}}" target="_blank" rel="noopener noreferrer"
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
                    target="_blank" rel="noopener noreferrer"
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
                    target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_V'])}}" target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_VI'])}}"  target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_VII'])}}" target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_VIII'])}}"  target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_IX'])}}" target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_X'])}}" target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_XI'])}}" target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_XII'])}}" target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_XIII'])}}"  target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_XIV'])}}" target="_blank" rel="noopener noreferrer"
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
                <a href="{{route('SA.view',['type'=>'SA_XV'])}}"  target="_blank" rel="noopener noreferrer"
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
