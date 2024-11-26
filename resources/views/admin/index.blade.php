@extends('layouts.master')

@section('content')
    
    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <div>
                    <img src="icons/bars.svg" id="menu-btn" alt="" class="icons">
                </div>
                <div class="search">
                    <img src="icons/search.svg" alt="" class="icons">
                    <input type="text" placeholder="Search">
                </div>
            </div>
            <div class="profile">
                <img src="icons/bell.svg" alt="" class="icons">
                <img src="img/person-1.jpg" alt="" class="profile-pic">
            </div>
        </div>

        <h3 class="i-name">Dashboard</h3>

        <div class="values">
            <div class="val-box" onclick="window.location.href='users'" style="cursor: pointer;">
                <img src="icons/users.svg" alt="" class="icons">
                <div>
                    <h3>{{ count($users) }}</h3>
                    <span>Total Users</span>
                </div>
            </div>
            <div class="val-box">
                <img src="icons/cart.svg" alt="" class="icons">
                <div>
                    <h3>234,567</h3>
                    <span>Total Orders</span>
                </div>
            </div>
            <div class="val-box">
                <img src="icons/products.svg" alt="" class="icons">
                <div>
                    <h3>89,3267</h3>
                    <span>Product Sale</span>
                </div>
            </div>
            <div class="val-box">
                <img src="icons/dollar-sign.svg" alt="" class="icons">
                <div>
                    <h3>$3,326</h3>
                    <span>This Month</span>
                </div>
            </div>
        </div>

        
    </section>

@endsection
 
