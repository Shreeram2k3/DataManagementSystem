@extends('layouts.adminnav')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-indigo-100 px-6 py-10 mb-6">

    <!-- Welcome Section -->
    <div class="text-center mb-10 animate-fadeIn">
        <h1 class="text-4xl font-semibold text-gray-800 mb-2">
            Welcome back, <span class="text-indigo-600">{{ Auth::user()->name }}</span> 👋
        </h1>
        <p class="text-gray-500 text-lg">You are logged in as <strong>{{ Auth::user()->role }}</strong></p>
    </div>

    <!-- Dashboard Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="backdrop-blur-lg bg-white/70 rounded-2xl shadow-lg p-6 hover:shadow-2xl transition">
            <h2 class="text-gray-700 text-sm uppercase font-medium mb-2">Total Users</h2>
            <p class="text-3xl font-bold text-indigo-600">{{$totalusers}}</p>
        </div>

        <!-- <div class="backdrop-blur-lg bg-white/70 rounded-2xl shadow-lg p-6 hover:shadow-2xl transition">
            <h2 class="text-gray-700 text-sm uppercase font-medium mb-2">Active Projects</h2>
            <p class="text-3xl font-bold text-indigo-600">56</p>
        </div>

        <div class="backdrop-blur-lg bg-white/70 rounded-2xl shadow-lg p-6 hover:shadow-2xl transition">
            <h2 class="text-gray-700 text-sm uppercase font-medium mb-2">Pending Tasks</h2>
            <p class="text-3xl font-bold text-indigo-600">23</p>
        </div> -->
    </div>

    
</div>
<!-- Fade-in Animation -->
<style>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
  animation: fadeIn 0.8s ease-out;
}
</style>
@endsection
