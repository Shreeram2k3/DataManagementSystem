@extends('layouts.adminnav')

@section('content')
 <div x-data="{ show: true, seconds: 3 }" 
            x-init="let timer = setInterval(() => {
                if (seconds > 0) seconds--;
                else show = false;
            }, 1000)" 
            x-show="show"
            class="flex justify-center mt-10">

            @if (session('error'))
            <div class="flex items-center space-x-4 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded shadow-lg">
                <!-- Success Message -->
                <div class="text-base font-medium">
                    {{ session('error') }}
                </div>

                <!-- Timer Circle -->
                <div class="w-8 h-8 rounded-full bg-red-300 text-white flex items-center justify-center text-sm font-light animate-pulse shadow-md">
                    <span x-text="seconds"></span>s
                </div>
            </div>
            @endif
    </div>
 <div class="">
  <!-- Activity Buttons -->
  <div class="flex flex-col sm:flex-row gap-6 justify-between items-stretch">

    <!-- Student Activity -->
    <button id="student-activity-btn" class=" flex-1 group relative rounded-2xl p-5 overflow-hidden bg-gradient-to-r from-indigo-500 via-blue-500 to-sky-500 text-white shadow-md transition transform hover:-translate-y-1 hover:shadow-xl">
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
<form action="{{ route('export.excel') }}" method="GET">
  <div class="flex justify-end mt-3 mr-10">
  <button class="px-6 py-2.5 rounded-xl
                 bg-gradient-to-r from-green-500 to-emerald-600
                 text-white font-semibold shadow-md
                 ">
    Export Excel
  </button>
</div>

 </div>



   <div id="student-activity-table" class="hidden mt-8 overflow-x-auto rounded-lg shadow-md border border-gray-200">
  
      <table class="min-w-full bg-white border border-gray-300 text-sm sm:text-base ">
        <thead class="bg-gray-200 text-gray-700 uppercase text-center sticky top-0">
          <tr>
            <th class="py-3 px-4 border">Sno</th>
            <th class="py-3 px-4 border">Student Activities</th>
            <th class="py-3 px-4 border">Action</th>
          </tr>
        </thead>
        <tbody>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">1</td>
            <td class="py-3 px-4 border">S.A.I. Department Association Activities - CEO/ Leader of the Week / Conference / Symposium / Workshop / Seminar / GL</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="tables[]" value="student_Activity_1" x-model="checked" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">2</td>
            <td class="py-3 px-4 border">S.A.II. Details of Students who Participated / Presented (National Level Event)</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="tables[]" value="student_Activity_2" x-model="checked" class="w-5 h-5 rounded-lg">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">3</td>
            <td class="py-3 px-4 border">S.A.III. Conference / Symposium / Workshop / Seminar Attended by Students</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_3" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">4</td>
            <td class="py-3 px-4 border">S.A.IV. Details of Students Attending Online Course (NPTEL / MOOC / SWAYAM / Spoken Tutorial / Coursera / Udemy / etc.)</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_4" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">5</td>
            <td class="py-3 px-4 border">S.A.V. Student Industrial Visit / Internship / Inplant Training</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_5" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">6</td>
            <td class="py-3 px-4 border">S.A.VI. Paper Presentation by Students (Conference / Symposium / Seminar)</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_6" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">7</td>
            <td class="py-3 px-4 border">S.A.VII. Details of Students who Participated / Presented (International Level Event)</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_7" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">8</td>
            <td class="py-3 px-4 border">S.A.VIII. Details of Students Winning Prizes in Events / Competitions</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_8" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">9</td>
            <td class="py-3 px-4 border">S.A.IX. Students Attending Value Added Courses / Certificate Courses</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_9" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">10</td>
            <td class="py-3 px-4 border">S.A.X. Details of Students Receiving Scholarships / Awards</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_10" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">11</td>
            <td class="py-3 px-4 border">S.A.XI. Student Startup / Entrepreneurship / Innovation Activities</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_11" class="w-5 h-5 rounded-lg">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">12</td>
            <td class="py-3 px-4 border">S.A.XII. Student Placement Details (On-Campus / Off-Campus)</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_12" class="w-5 h-5 rounded-lg">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">13</td>
            <td class="py-3 px-4 border">S.A.XIII. Students Going for Higher Studies (GATE / GRE / TOEFL / IELTS / CAT / MAT)</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_13" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">14</td>
            <td class="py-3 px-4 border">S.A.XIV. Students Participating in Sports / NSS / NCC / YRC / RRC</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_14" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

          <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
            <td class="py-3 px-4 border">15</td>
            <td class="py-3 px-4 border">S.A.XV. Any Other Student Activities</td>
            <td class="py-3 px-4 border text-center">
              <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" x-model="checked" value="student_Activity_15" class="w-5 h-5 rounded-lg ">
              </label>
            </td>
          </tr>

        </tbody>
      </table>
  </div>

    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('student-activity-btn');
        const table = document.getElementById('student-activity-table');

        btn.addEventListener('click', function() {
            // Toggle visibility
            table.classList.toggle('hidden');

            // Optional: Scroll to the table
            if (!table.classList.contains('hidden')) {
                table.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>

@endsection
