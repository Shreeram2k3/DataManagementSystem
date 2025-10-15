@extends('layouts.adminnav')

@section('content')


<!------------------------------------------- Flash Messages----------------------------------------------------->

            <div x-data="{ show: true, seconds: 3 }" 
            x-init="let timer = setInterval(() => {
                if (seconds > 0) seconds--;
                else show = false;
            }, 1000)" 
            x-show="show"
            class="flex justify-center mt-10">

            @if (session('success'))
            <div class="flex items-center space-x-4 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded shadow-lg">
                <!-- Success Message -->
                <div class="text-base font-medium">
                    {{ session('success') }}
                </div>

                <!-- Timer Circle -->
                <div class="w-8 h-8 rounded-full bg-red-300 text-white flex items-center justify-center text-sm font-light animate-pulse shadow-md">
                    <span x-text="seconds"></span>s
                </div>
            </div>
            @endif
            @if(session('failed'))
                <div class="flex items-center space-x-4 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded shadow-lg">
                <!-- deleted Message -->
                <div class="text-base font-medium">
                    {{ session('failed') }}

                </div>
                </div>
            @endif
             @if(session('delete'))
                <div class="flex items-center space-x-4 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded shadow-lg">
                <!-- deleted Message -->
                <div class="text-base font-medium">
                    {{ session('delete') }}

                </div>
                </div>
                @endif


        </div>
<!------------------------------------------- Flash Messages ends here ----------------------------------------------------->










            <div class="mt-10" 
     x-data="{ showForm: {{ $errors->any() ? 'true' : (isset($record) ? 'true' : 'false') }}, showEditForm: false, editData: {} }">

                <!-- Create addUsers Card -->
                <section class="relative mt-10 w-full  p-10 ">
                    
                <div @click="showForm = !showForm" 
                    class="fixed mt-10 top-[calc(4rem+1rem)] right-8 bg-gradient-to-br from-gray-700 via-gray-800 to-gray-900 text-white rounded-full w-16 h-16 flex items-center justify-center text-3xl shadow-2xl cursor-pointer transition-all duration-300 hover:scale-105 hover:shadow-lg transform ease-in-out" 
                    :class="{'rotate-45': showForm}" 
                    title="Add User">
                    <span>+</span>
                </div>
            </section>




     

                    <!-- Floating Create Form Modal -->
                    <div x-show="showForm" x-transition class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                            <h2 class="text-xl font-semibold mb-4">{{ isset($record) ? 'Update User' : 'Add User' }}</h2>
                            
                            <form method="POST" 
                                action="{{ isset($record) ? route('update_user', $record->id) : route('addUser') }}" 
                                enctype="multipart/form-data">

                                @csrf
                                @if(isset($record))
                                    @method('PUT')
                                @endif

                                <!-- Name -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" name="name" 
                                        value="{{ $record->name ?? '' }}" 
                                        class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-blue-300" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" 
                                        value="{{ $record->email ?? '' }}" 
                                        class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-blue-300" required>
                                    @error('email')
                                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Role -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Role</label>
                                    <select name="role" class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-blue-300" required>
                                        <option value="user"  {{ (isset($record) && $record->role == 'user') ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ (isset($record) && $record->role == 'admin') ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>

                                <!---Department-->
                        @if(Auth::user()->role === 'super_admin')
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">DEPT</label>
                                    <input type="text" name="department" 
                                        value="{{ $record->department ?? '' }}" 
                                        class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-blue-300" required>
                              </div>
                              
                        @else
                          <input type="hidden" name="department" value="{{Auth::user()->department}}">
                        @endif

                             



                                <!-- Password -->
                                <div class="mb-8">
                                    <label class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" name="pass" class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-blue-300">
                                    @if(isset($record))
                                        <p class="text-xs text-red-600 mt-1">Leave blank to keep current password.</p>
                                    @endif
                                </div>

                                <!-- Buttons -->
                                <div class="flex justify-between">
                                    <button type="button" @click="
                                                    @if(isset($record))
                                                        window.location.href='{{route('admin.manageUsers')}}'
                                                    @else
                                                        showForm = false
                                                    @endif
    "class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                                        {{ isset($record) ? 'Update' : 'Save' }}
                                    </button>
                                </div>
                            </form>

        </div>
    </div>


<!-- ---------------------------------------------------User table -------------------------------------------------------------------------------------- -->
 
  
<div class="bg-white p-6 shadow-xl rounded-2xl w-full border border-gray-100">
    
    <!-- Search Filter -->
    <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <h2 class="text-xl font-semibold text-gray-800">User Management</h2>
        <form method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto">
            <input type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Search users..."
                class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg text-sm 
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm">
            <button type="submit" 
                    class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg 
                        hover:bg-indigo-700 shadow transition">
                Search
            </button>
        </form>
    </div>


    <div class="bg-white shadow-md rounded-lg overflow-hidden w-full">
        <!-- Added responsive wrapper -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
                <thead class="bg-gray-100 text-gray-900 uppercase">
                    <tr>
                        <th class="px-4 py-3 border">S.No</th>
                        <th class="px-4 py-3 border">Name</th>
                        <th class="px-4 py-3 border">Email</th>
                        <th class="px-4 py-3 border">Role</th>
                        <th class="px-4 py-3 border">Department</th>
                        <th class="px-4 py-3 border">Action</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @forelse ($users as $item)
                        
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $loop->iteration}}</td>
                            <td class="px-4 py-2 border">{{ $item->name}}</td>
                            <td class="px-4 py-2 border">{{ $item->email}}</td>
                            <td class="px-4 py-2 border">{{ $item->role}}</td>
                            <td class="px-4 py-2 border">{{ $item->department}}</td>
                            <td class="px-4 py-2 border text-center">
                                <div class="flex justify-center rounded-lg overflow-hidden">
                                    <!-- Edit Button -->
                                    <a href="{{ route('edit_user', [ 'id' => $item->id]) }}"
                                        class="inline-flex items-center justify-center w-10 h-10 bg-stone-700 text-white hover:bg-stone-900 transition rounded-l-lg">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('user_delete', [ 'id' => $item->id] )}}" 
                                        method="POST" 
                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-10 h-10 bg-red-500 text-white hover:bg-red-600 transition rounded-r-lg">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-red-500 py-4">No Data Available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination and Page Size Selector BELOW Table -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mt-4 space-y-3 md:space-y-0">
        <!-- Page Size Selector -->
        <form method="GET" class="flex items-center space-x-2">
            <label for="per_page" class="text-sm text-gray-700">Show</label>
            <select name="per_page" id="per_page" onchange="this.form.submit()" class="border-gray-300 rounded-md text-sm">
                <option value="10" {{ $perPage ==10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
            </select>
            <span class="text-sm text-gray-700">entries</span>
        </form>

        <!-- Pagination Links -->
        <div class="flex flex-wrap space-x-2">
            @if($users->previousPageUrl())
                <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Previous</a>
            @endif
            <span class="px-3 py-1 text-gray-700">Page {{ $users->currentPage() }} of {{ $users->lastPage() }}</span>
            @if($users->nextPageUrl())
                <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Next</a>
            @endif
        </div>
    </div>
</div>
          

                                

@endsection