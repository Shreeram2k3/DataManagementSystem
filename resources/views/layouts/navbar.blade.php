<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DMS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="shortcut icon" href="colorlogo.png" type="image.jpg">
</head>
<body class="bg-gray-50">

  <div x-data="{ open: false, profileOpen: false, dropdownOpen: false, mobileProfileOpen: false }">
    <nav class="bg-white shadow px-6 py-6 fixed top-0 w-full z-50">
      <div class="flex justify-between items-center">
        <!-- Left: Logo + Desktop Nav Links -->
        <div class="flex items-center space-x-4">
          <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-gray-800 whitespace-nowrap mr-5">DATA MANAGEMENT SYSTEM</a>
          <div class="hidden md:flex space-x-6 text-sm font-medium">

                <a href="{{ route('dashboard') }}" class=" {{ Request::is('dashboard') ? 'text-blue-700' : 'text-gray-700 hover:text-blue-600' }}">
                  Dashboard
                </a>

             @if(auth()->check() && auth()->user()->role === 'admin')

                <a href="{{ route('admin.dashboard') }}" class=" {{ Request::is('admin/dashboard') ? 'text-blue-700' :      'text-gray-700 hover:text-blue-600' }}">
                Admin Dashboard
                </a>
             @endif
          </div>
        </div>

        <!--  Profile + Hamburger -->
        <div class="flex items-center space-x-4">
          <!-- Profile (Desktop dropdown) -->
          <div class="relative hidden mr-10 md:block">
            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-1 focus:outline-none">
              <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center  text-sm font-semibold text-gray-700">
                {{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : '?' }}
              </div>
              <i class="fas fa-chevron-down text-xs text-gray-500"></i>
            </button>

            <!-- Dropdown -->
            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition x-cloak class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  Logout
                </button>
              </form>
            </div>
          </div>

          <!-- Hamburger (mobile nav toggle) -->
          <button class="md:hidden text-gray-600 hover:text-blue-600 focus:outline-none" @click="open = !open" aria-label="Toggle Menu">
            <i class="fas fa-bars text-lg"></i>
          </button>
        </div>
      </div>
    </nav>

    <!-- Mobile Nav Sidebar -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex md:hidden">
      <div 
        class="fixed inset-0 bg-black bg-opacity-50 transition-opacity duration-500 ease-in-out"
        @click="open = false"
        x-transition:enter="transition-opacity duration-500 ease-in-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-500 ease-in-out"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
      ></div>

      <div
        class="relative w-64 h-full bg-white shadow-2xl transform flex flex-col justify-between"
        x-transition:enter="transition duration-700 ease-in-out transform"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition duration-700 ease-in-out transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
      >
        <div>
          <button class="absolute top-4 right-4 text-gray-400 hover:text-red-500" @click="open = false">
            <i class="fas fa-times text-xl"></i>
          </button>

          <div class="mt-16 px-6 space-y-4">
            <h2 class="text-lg font-bold text-gray-800">Navigation</h2>


           <a href="{{ route('dashboard') }}"
   class="flex items-center gap-2 px-4 py-2 rounded-md font-medium transition duration-300
          {{ Route::currentRouteName() === 'dashboard' ? 'text-blue-700 bg-blue-100 hover:bg-blue-200' : 'text-gray-700 hover:bg-gray-100' }}">
  <i class="fas fa-home"></i> Dashboard
</a>

@if(auth()->check() && auth()->user()->role === 'admin')
  <a href="{{ route('admin.dashboard') }}"
     class="flex items-center gap-2 px-4 py-2 rounded-md font-medium transition duration-300
            {{ Route::currentRouteName() === 'admin.dashboard' ? 'text-blue-700 bg-blue-100 hover:bg-blue-200' : 'text-gray-700 hover:bg-gray-100' }}">
    <i class="fas fa-user-shield"></i> Admin Dashboard
  </a>
@endif


          </div>
        </div>

        <!-- Mobile Profile Dropdown -->
        <div class="relative p-6 border-t border-gray-200">
          <button @click="mobileProfileOpen = !mobileProfileOpen" class="w-full flex items-center space-x-1 focus:outline-none">
            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-sm font-semibold text-gray-700">
              {{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : '?' }}
            </div>
            
            <span class="font-light text-gray-500" >
              {{ (Auth::user()->name) }}
            </span>

            <i class="fas fa-chevron-up text-xs text-gray-500" :class="{ 'rotate-180': mobileProfileOpen }"></i>
          </button>
          <div x-show="mobileProfileOpen" @click.away="mobileProfileOpen = false" x-transition x-cloak class="absolute bottom-16 left-6 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Logout
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <main class="pt-24">
      @yield('content')
    </main>
  </div>

</body>
</html>
