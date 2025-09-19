<!DOCTYPE html>
<html lang="en" x-data="{ open: false, darkMode: false }" :class="{ 'dark': darkMode }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DMS Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="shortcut icon" href="colorlogo.png" type="image.png">
  <script>
    tailwind.config = {
      darkMode: 'class',
    }
  </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 flex flex-col min-h-screen font-sans">

  <!-- Navbar -->
  <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg shadow-lg p-4 w-full fixed top-0 z-50 flex justify-between items-center px-6 border-b border-gray-200 dark:border-gray-700">
    <a href="/dashboard" class="flex items-center space-x-2 text-gray-800 font-bold dark:text-gray-100 tracking-tight">
      <img src="{{ asset('colorlogo.png') }}" alt="Logo" class="h-9 w-9 rounded-lg shadow-md">
      <span class="text-lg">DMS AdminPanel</span>
    </a>

    <!-- Right side -->
    <div class="flex items-center space-x-4">
      <!-- Dark mode toggle -->
      <button @click="darkMode = !darkMode"
              class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 hover:scale-105 transition">
        <i :class="darkMode ? 'fas fa-sun text-yellow-400' : 'fas fa-moon text-gray-600 dark:text-gray-300'" class="text-lg"></i>
      </button>

      <!-- Profile -->
      <div x-data="{ open: false }" class="relative hidden md:flex items-center space-x-4">
        <div @click="open = !open" class="flex items-center space-x-3 cursor-pointer group mr-5">
          <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-bold bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg">
            {{ strtoupper(substr(optional(auth()->user())->name ?? 'U', 0, 1)) }}
          </div>
          <span class="text-gray-700 dark:text-gray-200 font-semibold group-hover:text-indigo-600 transition">{{ optional(auth()->user())->name ?? 'User' }}</span>
          <i class="fas fa-chevron-down text-gray-500 dark:text-gray-300 text-sm transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
        </div>

        <!-- Dropdown -->
        <div x-show="open" @click.away="open = false" x-transition
             class="absolute right-0 top-full mt-3 w-64 rounded-2xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-2xl overflow-hidden">
          <a href="{{ route('profile.edit') }}" class="flex items-center px-5 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <i class="fas fa-user text-indigo-500 mr-3"></i> Profile
          </a>

          <div class="border-t border-gray-100 dark:border-gray-700"></div>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center w-full text-left px-5 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
              <i class="fas fa-sign-out-alt text-red-500 mr-3"></i> Logout
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Mobile Toggle -->
    <button @click="open = !open" class="text-gray-600 dark:text-gray-300 md:hidden focus:outline-none">
      <i class="fas fa-bars text-2xl"></i>
    </button>
  </nav>

  <div class="layout pt-20 flex flex-1">
    <!-- Sidebar -->
    <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
           class="bg-white dark:bg-gray-800 fixed inset-y-0 left-0 transform transition-transform duration-300 md:translate-x-0 md:fixed md:w-72 md:h-screen z-40 py-8 px-5 shadow-xl border-r border-gray-100 dark:border-gray-700 flex flex-col justify-between">
      <ul class="space-y-3 font-medium">
        <li>
          <a  class="flex items-center px-5 py-3 rounded-xl transition-all duration-300 {{ Request::is('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg scale-105' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200' }}">
            <i class="fas fa-home mr-4"></i> Home
          </a>
        </li>

        <li>
          <a href="/dashboard" class="flex items-center px-5 py-3 rounded-xl transition-all duration-300 {{ Request::is('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg scale-105' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200' }}">
            <i class="fas fa-home mr-4"></i> Home
          </a>
        </li>

        <li>
          <a href="{{route('admin.manageUsers')}}" class="flex items-center px-5 py-3 rounded-xl transition-all duration-300 {{ Request::is('admin/manageUsers') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg scale-105' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200' }}">
            <i class="fas fa-user-alt mr-4"></i> Manage Users
          </a>
        </li>
        <li>
          <a href="{{route('admin.manageData')}}" class="flex items-center px-5 py-3 rounded-xl transition-all duration-300 {{ Request::is('admin/manageData') ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg scale-105' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200' }}">
            <i class="fa-solid fa-database mr-4"></i> Manage Data
          </a>
        </li>
      </ul>

      <!-- Mobile bottom links -->
      <div class="md:hidden mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
        
        <a href="{{ route('profile.edit') }}" class="flex items-center px-5 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition mt-2">
          <i class="fas fa-user text-indigo-500 mr-3"></i> Profile
        </a>
        <form action="{{ route('logout') }}" method="POST" class="mt-2">
          @csrf
          <button type="submit" class="flex items-center w-full text-left px-5 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
            <i class="fas fa-sign-out-alt text-red-500 mr-3"></i> Logout
          </button>
        </form>
      </div>
    </aside>

    <!-- Main content area -->
    <main class="flex-1 ml-0 md:ml-72 p-8 bg-gray-50 dark:bg-gray-900 rounded-tl-3xl shadow-inner">
      <!-- Page content goes here -->
      <div class="h-full w-full flex">
        <!-- Select a section from the sidebar to get started. -->
         @yield('content')
      </div>
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-4 text-sm text-gray-600 dark:text-gray-400 flex justify-between items-center px-6">
    <div class="flex items-center space-x-2">
      
      <span></span>
    </div>
    <div>
      By <a href="#" class="text-indigo-600 text-xs font-extralight hover:underline">Shreeram G & Sathish KU</a>
    </div>
  </footer>

</body>
</html>