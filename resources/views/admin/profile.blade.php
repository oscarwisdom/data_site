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

    <h3 class="i-name">Profile</h3>

    <div class="values"> 
        @if (session('message'))
            <script>
                alert('{{ session('message') }}')
            </script>
        @endif
        <form action="{{ url('admin/profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form" style="margin-bottom: 50px">
            <h3 class="i-name">Personal Information</h3>

            <div class="input-container ic1" style="margin-bottom: 50px">
            <input id="name" name="name" value="{{ $user[0]->name }}" class="input" type="text" placeholder=" " />
            <label for="name" >Full Name</label>
            </div>
            <div class="input-container ic2" style="margin-bottom: 50px">
            <input id="email" name="email" value="{{ $user[0]->email }}" class="input" type="text" placeholder=" " />
            <label for="email" >Email</label>
            </div>
            <div class="input-container ic2" style="margin-bottom: 30px">
            <input id="phone" name="phone" value="{{ $user[0]->phone }}" class="input" type="text" placeholder=" " />
            <label for="phone" >Phone</label>
            </div>
            
            <button type="submit" class="submit">Update</button>
        </div>
    </form>

    <form action="{{ url('admin/password') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form">
            <h3 class="i-name">Change Password</h3>
            <div class="input-container ic1" style="margin-bottom: 50px">
            <input id="current_password" name="current_password" class="input" type="text" placeholder=" " />
            <label for="current_password" >Current Password</label>
            </div>
            <div class="input-container ic2" style="margin-bottom: 50px">
            <input id="new_password" name="new_password" value="" class="input" type="text" placeholder=" " />
            <label for="new_password" >New Password</label>
            </div>
            <div class="input-container ic2" style="margin-bottom: 50px">
            <input id="password_confirmation" name="password_confirmation" value="" class="input" type="text" placeholder=" " />
            <label for="password_confirmation" >Password Confirmation</label>
            </div>
            <div class="input-container ic2" style="margin-bottom: 30px">
            
            <button type="submit" class="submit">Update</button>
        </div>
    </form>

    </div>

@endsection