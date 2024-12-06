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
<div class="services">
    <h1 class="our-services">Our Services</h1>
    <div class="services-box">
        <div class="service-box1">
            <h2 class="services-head-text">{{ __('Fund your Account, make Transfers, Pay Bills') }}</h2>

<<<<<<< HEAD
            <p class="services-text">
                {{ __('
                Live life on your own terms! Add money to your
                DataPlug Wallet and transfer to other bank accounts for
                free Enjoy bonuses on airtime & data top Ups and fast bill payments at the
                extra charge') }}
            </p>
        </div>
        <img
            src="
                {{
                    asset('images/stock-vector-e-store-and-e-commerce-website-for-shopping-online-flat-line-vector-illustration-of-cute-woman-1855045951.jpg') }}" alt="" class="service-box2">
    </div>
</div>
=======
@include('includes.service')
@include('includes.testimony')
@include('includes.contact')
@include('includes.footer')
>>>>>>> 756f0c59c3a75071823f38720999f59abf877f4c
@endsection
