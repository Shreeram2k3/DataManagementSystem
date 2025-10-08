@extends('layouts.adminnav')

@section('content')
<div x-data="{ show: false }">
    <!-- Flash message timer -->
    <div x-data="{ show: true, seconds: 3 }" 
         x-init="let timer = setInterval(() => { if (seconds > 0) seconds--; else show = false; }, 1000)" 
         x-show="show"
         class="flex justify-center mt-10">
        @if (session('error'))
        <div class="flex items-center space-x-4 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded shadow-lg">
            <div class="text-base font-medium">{{ session('error') }}</div>
            <div class="w-8 h-8 rounded-full bg-red-300 text-white flex items-center justify-center text-sm font-light animate-pulse shadow-md">
                <span x-text="seconds"></span>s
            </div>
        </div>
        @endif
    </div>

    <!-- Activity Buttons -->
    <div class="flex flex-col sm:flex-row gap-6 justify-between items-stretch">
        <!-- Student Activity -->
        <button id="student-activity-btn" class="flex-1 group relative rounded-2xl p-5 overflow-hidden bg-gradient-to-r from-indigo-500 via-blue-500 to-sky-500 text-white shadow-md transition transform hover:-translate-y-1 hover:shadow-xl">
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
        <button id="faculty-activity-btn" class="flex-1 group relative rounded-2xl p-5 overflow-hidden bg-gradient-to-r from-emerald-500 via-green-400 to-lime-400 text-white shadow-md transition transform hover:-translate-y-1 hover:shadow-xl">
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
        <button id="department-activity-btn" class="flex-1 group relative rounded-2xl p-5 overflow-hidden bg-gradient-to-r from-purple-600 via-pink-500 to-rose-500 text-white shadow-md transition transform hover:-translate-y-1 hover:shadow-xl">
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

    <!-- Export Form -->
    <form action="{{ route('export.excel') }}" method="GET" id="form">
        <div class="flex justify-end mt-3 mr-10">
            <!-- Export Excel button triggers AlpineJS date picker -->
            <button type="button" @click="show = !show"
                    class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold shadow-md">
                Export Excel
            </button>
        </div>

        <!-- Date Range Picker (AlpineJS) -->
        <div x-show="show" x-transition class="flex gap-4 justify-end mt-4 mr-10 items-center">
            <div>
                <label class="text-sm font-medium text-gray-700">From:</label>
                <input type="date" name="from_date" class="border rounded px-2 py-1">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">To:</label>
                <input type="date" name="to_date" class="border rounded px-2 py-1">
            </div>
            <div>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                    Download
                </button>
            </div>
        </div>

        <!-- Student Activity List -->
        <div id="student-activity-table" class="hidden mt-8 overflow-x-auto rounded-lg shadow-md border border-gray-200 mb-12">
            <table class="min-w-full bg-white border border-gray-300 text-sm sm:text-base">
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
                                <input type="checkbox" name="tables[]" value="student_Activity_1" x-model="checked" class="w-5 h-5 rounded-lg">
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
                                <input type="checkbox" name="tables[]" value="student_Activity_3" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">4</td>
                        <td class="py-3 px-4 border">S.A.IV. Details of Students Attending Online Course (NPTEL / MOOC / SWAYAM / Spoken Tutorial / Coursera / Udemy / etc.)</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_4" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">5</td>
                        <td class="py-3 px-4 border">S.A.V. Student Industrial Visit / Internship / Inplant Training</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_5" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">6</td>
                        <td class="py-3 px-4 border">S.A.VI. Paper Presentation by Students (Conference / Symposium / Seminar)</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_6" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">7</td>
                        <td class="py-3 px-4 border">S.A.VII. Details of Students who Participated / Presented (International Level Event)</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_7" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">8</td>
                        <td class="py-3 px-4 border">S.A.VIII. Details of Students Winning Prizes in Events / Competitions</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_8" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">9</td>
                        <td class="py-3 px-4 border">S.A.IX. Students Attending Value Added Courses / Certificate Courses</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_9" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">10</td>
                        <td class="py-3 px-4 border">S.A.X. Details of Students Receiving Scholarships / Awards</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_10" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">11</td>
                        <td class="py-3 px-4 border">S.A.XI. Student Startup / Entrepreneurship / Innovation Activities</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_11" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">12</td>
                        <td class="py-3 px-4 border">S.A.XII. Student Placement Details (On-Campus / Off-Campus)</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_12" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">13</td>
                        <td class="py-3 px-4 border">S.A.XIII. Students Going for Higher Studies (GATE / GRE / TOEFL / IELTS / CAT / MAT)</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_13" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">14</td>
                        <td class="py-3 px-4 border">S.A.XIV. Students Participating in Sports / NSS / NCC / YRC / RRC</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_14" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">15</td>
                        <td class="py-3 px-4 border">S.A.XV. Any Other Student Activities</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="student_Activity_15" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- Faculty Activity List  -->
        <div id="faculty-activity-table" class="hidden mt-8 overflow-x-auto rounded-lg shadow-md border border-gray-200 mb-12">
            <table class="min-w-full bg-white border border-gray-300 text-sm sm:text-base">
                <thead class="bg-gray-200 text-gray-700 uppercase text-center sticky top-0">
                    <tr>
                        <th class="py-3 px-4 border">Sno</th>
                        <th class="py-3 px-4 border">Faculty Activities</th>
                        <th class="py-3 px-4 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                   <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">1</td>
                        <td class="py-3 px-4 border">F. A. I (a). Publication of Papers in the Journals</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_1" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">2</td>
                        <td class="py-3 px-4 border">F. A. I (b) Book / Chapter contribution in Publications</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_2" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">3</td>
                        <td class="py-3 px-4 border">F. A. I (c) Patents Generated / Filed</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_3" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">4</td>
                        <td class="py-3 px-4 border">F.A.II  Seminar / Symposium/ Conferences / Training Programmes (Less than one week) (Paper Presented / Participated) </td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_4" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">5</td>
                        <td class="py-3 px-4 border">F. A. III. International /  National / Conferences / Seminar – Organized</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_5" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">6</td>
                        <td class="py-3 px-4 border">F. A. IV. Summer School / Winter School / FDP or SDP (at least one week) attended by Staff Members</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_6" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">7</td>
                        <td class="py-3 px-4 border">F. A. V.  Event / Winter / Summer School Proposals Submitted / Sanctioned</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_7" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">8</td>
                        <td class="py-3 px-4 border">F. A. VI. AICTE / ISTE Sponsored  / Faculty Development Programmes - Events Organized</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_8" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">9</td>
                        <td class="py-3 px-4 border">F.A.VII. Details of Industrial Training Undergone by the Faculty Members</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_9" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">10</td>
                        <td class="py-3 px-4 border">F.A.VIII. Special Lectures Delivered By Faculty Members</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_10" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">11</td>
                        <td class="py-3 px-4 border">F. A. IX.  Non-Teaching Staff Training Programmes</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_11" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">12</td>
                        <td class="py-3 px-4 border">F.A.X. Faculty Members Deputed for Higher Studies Undergoing / Completed:  (Specify only for the period under Report)</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_12" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">13</td>
                        <td class="py-3 px-4 border">F.A.XI. Faculty Members Guiding Ph D Scholars </td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_13" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">14</td>
                        <td class="py-3 px-4 border">F.A.XII.  Projects Proposals Submitted / Sanctioned</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_14" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">15</td>
                        <td class="py-3 px-4 border">F.A.XIII Details of Consultancy Services of the Department</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_15" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">16</td>
                        <td class="py-3 px-4 border">F.A.XIV Details of MoUs signed</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_16" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">17</td>
                        <td class="py-3 px-4 border">F.A.XV Industry visits by Faculty Member</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_17" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">18</td>
                        <td class="py-3 px-4 border">F.A.XVI Faculty Members Received Award / Applied for Any Awards</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_18" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">19</td>
                        <td class="py-3 px-4 border">F. A. XVII Supervisor Recognition</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_19" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">20</td>
                        <td class="py-3 px-4 border">F.A.XVIII – IRP Visit </td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_20" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">21</td>
                        <td class="py-3 px-4 border">F. A. XIX. Faculty Recruited. Relieved </td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_21" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">22</td>
                        <td class="py-3 px-4 border">F.A.XX STAFF ACTIVITIES - OTHERS </td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_22" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- Department Activity List  -->
         <div id="dept-activity-table" class="hidden mt-8 overflow-x-auto rounded-lg shadow-md border border-gray-200 mb-12">
            <table class="min-w-full bg-white border border-gray-300 text-sm sm:text-base">
                <thead class="bg-gray-200 text-gray-700 uppercase text-center sticky top-0">
                    <tr>
                        <th class="py-3 px-4 border">Sno</th>
                        <th class="py-3 px-4 border">Department Activities</th>
                        <th class="py-3 px-4 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                   <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">1</td>
                        <td class="py-3 px-4 border">D. A. I. Details of New Equipment Purchased in the Department</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="department_Activity_1" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">2</td>
                        <td class="py-3 px-4 border">D. A. II. Equipment Failure/ Service Status in the Department</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="department_Activity_2" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">3</td>
                        <td class="py-3 px-4 border">D. A. III.  Departmental Library</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="department_Activity_3" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">4</td>
                        <td class="py-3 px-4 border">D. A. IV. VIPs  Visit / Inspection to the Department / Audit </td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="department_Activity_4" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">5</td>
                        <td class="py-3 px-4 border">D. A. V. Newsletters Released (All)</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="department_Activity_5" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">6</td>
                        <td class="py-3 px-4 border">D. A. VI. Activities for Competitive Examination / Higher Education / EDC</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="department_Activity_6" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">7</td>
                        <td class="py-3 px-4 border">D. A. VII. Awards/ Prizes won by Students</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_7" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">8</td>
                        <td class="py-3 px-4 border">D. A. VIII. Board of Studies Meeting / PAC / DAAC / GCM / AGM</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="department_Activity_8" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">9</td>
                        <td class="py-3 px-4 border">D. A. IX. Department Activities Others</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="department_Activity_9" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">10</td>
                        <td class="py-3 px-4 border">D. A. X. Department Time Table / subject allocation / faculty work load</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_10" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    <tr x-data="{ checked: false }" :class="checked ? 'bg-green-100' : ''">
                        <td class="py-3 px-4 border">11</td>
                        <td class="py-3 px-4 border">D. A. XI. Result Analysis / Sample QP / Answer Sheet / Answer key / Remedial Class</td>
                        <td class="py-3 px-4 border text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="tables[]" value="faculty_Activity_11" x-model="checked" class="w-5 h-5 rounded-lg">
                            </label>
                        </td>
                    </tr>

                    
                </tbody>
            </table>
        </div>



    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

          // scripts to load Student Activity list 
            const studentBtn = document.getElementById('student-activity-btn');
            const studentTable = document.getElementById('student-activity-table');

            studentBtn.addEventListener('click', function() {
                studentTable.classList.toggle('hidden');
                if (!studentTable.classList.contains('hidden')) {
                    studentTable.scrollIntoView({ behavior: 'smooth' });
                }
            });

            // scripts to load Faculty Activity List 
            const facultyBtn = document.getElementById('faculty-activity-btn');
            const facultyTable = document.getElementById('faculty-activity-table');

            facultyBtn.addEventListener('click', function() {
                facultyTable.classList.toggle('hidden');
                if (!facultyTable.classList.contains('hidden')) {
                    facultyTable.scrollIntoView({ behavior: 'smooth' });
                }
            });

            // scripts to load Department Activity List 
            const deptBtn = document.getElementById('department-activity-btn');
            const deptTable = document.getElementById('dept-activity-table');

            deptBtn.addEventListener('click', function() {
                deptTable.classList.toggle('hidden');
                if (!deptTable.classList.contains('hidden')) {
                    deptTable.scrollIntoView({ behavior: 'smooth' });
                }
            });
            
        });

            document.querySelector("#form").addEventListener("submit", function() {
            setTimeout(() => location.reload(), 1000);
        });
    </script>
</div>
@endsection
