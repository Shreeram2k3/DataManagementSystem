@extends('layouts.navbar')

@section('content')

<h1 class="font-extralight text-center">Welcome {{Auth::user()->role}} {{Auth::user()->name}}</h1>
@endsection