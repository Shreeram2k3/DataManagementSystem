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
                <a href="{{route('facultydatapage')}}" target="blank" rel="noopener noreferrer"
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
            <td class="py-3 px-4 border">F. A. I (b) Book / Chapter contribution in Publications</td>
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
            <td class="py-3 px-4 border">3</td>
            <td class="py-3 px-4 border">F. A. I (c) Patents Generated / Filed</td>
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
            <td class="py-3 px-4 border">4</td>
            <td class="py-3 px-4 border">F.A.II  Seminar / Symposium/ Conferences / Training Programmes (Less than one week) (Paper Presented / Participated) </td>
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
            <td class="py-3 px-4 border">5</td>
            <td class="py-3 px-4 border">F. A. III. International /  National / Conferences / Seminar – Organized </td>
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
            <td class="py-3 px-4 border">6</td>
            <td class="py-3 px-4 border">F. A. IV. Summer School / Winter School / FDP or SDP (at least one week) attended by Staff Members</td>
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
            <td class="py-3 px-4 border">7</td>
            <td class="py-3 px-4 border">F. A. V.  Event / Winter / Summer School Proposals Submitted / Sanctioned</td>
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
            <td class="py-3 px-4 border">8</td>
            <td class="py-3 px-4 border">F. A. VI. AICTE / ISTE Sponsored  / Faculty Development Programmes - Events Organized </td>
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
            <td class="py-3 px-4 border">9</td>
            <td class="py-3 px-4 border">F.A.VII. Details of Industrial Training Undergone by the Faculty Members </td>
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
            <td class="py-3 px-4 border">F.A.VIII. Special Lectures Delivered By Faculty Members</td>
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
            <td class="py-3 px-4 border">F. A. IX.  Non-Teaching Staff Training Programmes</td>
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
            <td class="py-3 px-4 border">F.A.X. Faculty Members Deputed for Higher Studies Undergoing / Completed:  (Specify only for the period under Report)</td>
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
            <td class="py-3 px-4 border">F.A.XI. Faculty Members Guiding Ph D Scholars </td>
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
            <td class="py-3 px-4 border">F.A.XII.  Projects Proposals Submitted / Sanctioned </td>
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
            <td class="py-3 px-4 border">F.A.XIII Details of Consultancy Services of the Department</td>
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
            <td class="py-3 px-4 border">16</td>
            <td class="py-3 px-4 border">F.A.XIV Details of MoUs signed</td>
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
            <td class="py-3 px-4 border">17</td>
            <td class="py-3 px-4 border">F.A.XV Industry visits by Faculty Member</td>
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
            <td class="py-3 px-4 border">18</td>
            <td class="py-3 px-4 border">F.A.XVI Faculty Members Received Award / Applied for Any Awards</td>
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
            <td class="py-3 px-4 border">19</td>
            <td class="py-3 px-4 border">F. A. XVII Supervisor Recognition</td>
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
            <td class="py-3 px-4 border">20</td>
            <td class="py-3 px-4 border">F.A.XVIII – IRP Visit </td>
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
            <td class="py-3 px-4 border">21</td>
            <td class="py-3 px-4 border">F. A. XIX. Faculty Recruited. Relieved</td>
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
            <td class="py-3 px-4 border">22</td>
            <td class="py-3 px-4 border">F.A.XX STAFF ACTIVITIES - OTHERS</td>
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