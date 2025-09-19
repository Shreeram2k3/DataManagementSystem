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


        </div>
<!------------------------------------------- Flash Messages ends here ----------------------------------------------------->










<div class="mt-10" x-data="{ showForm: false, showEditForm: false, editData: {} }">
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
            <h2 class="text-xl font-semibold mb-4">Add User</h2>
            
            <form method="POST" action="{{route('addUser')}}"enctype="multipart/form-data">
                @csrf
                <!-- user_name  -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>

                <!-- user_email  -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input name="email" type="email"  class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-blue-300" required>
                </div>

                   <!-- category  -->
                   <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role" required class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-blue-300">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                    

                <!-- samplepaper  -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="pass" class="mt-1 p-2 w-full border rounded-lg focus:ring focus:ring-blue-300">
                </div>

                <!-- cancel save btns  -->
                <div class="flex justify-between bg-red-">
                    <button type="button" @click="showForm = false" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection