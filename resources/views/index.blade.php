@extends('layouts.app')


@section('content')
<div class="hero">
        
    <div class="content">
        <h1 class="arc">Buy<br>Data</h1>
        <p class="arc">Dataplugone is a new social media platform that make it easy to buy data at affordable price
        in any part of the World. Now let's explore all it's amazing features.</p>
        @if (Auth::check())
        <a href={{ url('home') }} class="btn arc">Dashboard</a>
        @else
        <a href={{ url('register') }} class="btn arc">Join now</a>
        @endif
    </div>
    <img src={{ asset('images/data.png.jpg') }} class="features-img arc">

</div>
@endsection