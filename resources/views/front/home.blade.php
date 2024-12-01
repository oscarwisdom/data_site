@extends('layouts.user')

@section('content')
    <!-- ==========================main================================= -->
<div class="main">
    <div class="topbar">
      <div class="toggle">
          <i class="fa fa-navicon"></i>
      </div>
      {{-- <div class="search">
          <label class="label">
              <input type="text" placeholder="search here" id="search">
              <i class="fa fa-search"></i>
          </label>
      </div> --}}
          <div class="user-img">

                    <div onclick="return confirm('Are you sure to logout?')">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                         <span class="icon">
                                            <i class="fa fa-arrow-right-from-bracket v1"></i>
                                            </span>
                                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>

              {{-- <img src="assset/img/SmartCity_connect_900.jpg" id="photo">
              <input type="file" id="file" accept="image/png, image/jpeg, image/gif" required/>
              <label for="file" id="uploadbtn"><i class="fas fa-camera"></i></label> --}}
          </div>
      </div>
          <div class="container-body">
              <div class="home">
                  <i class="fas fa-home" aria-hidden="true"></i>
                  <p>Home</p>
              </div>
              <div class="user-info">
                  <div class="user-details">
                      <i class="fa fa-user"></i>
                      <p>user details</p>
                      <h1>{{ Auth::user()->name }}</h1>
                      <h5>user id: {{ Auth::user()->user_id }}</h5>
                  </div>
                  <div class="user-details simple">
                      <div class="we-chat">
                          <i class="fa fa-wechat nw" aria-hidden="true"></i>
                      </div>
                      <a href="{{ url('payment') }}" class="bmb">Fund Wallet</a>
                      <div class="mtd">
                        <h2><i class="fas fa-naira-sign"></i> {{ Auth::user()->balance }}</h2>
                      </div>
                  </div>
              </div>
          </div>

  </div>
@endsection
