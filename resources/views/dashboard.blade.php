@extends('layouts.navbar')

@section('content')
    <div class="bg-white shadow p-6 rounded-xl mt-10 ml-10 mr-10">
        <h1 class="text-3xl font-bold text-gray-900">
            Welcome back, {{ strtoupper(Auth::user()->name) }}! <span class="inline-block">👋</span>
        </h1>
    </div>
@endsection
