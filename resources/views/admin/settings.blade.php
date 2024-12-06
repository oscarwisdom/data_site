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

        <h3 class="i-name">Settings</h3>

        <div class="values">
            <form action="{{ url('admin/settings') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form">
                    <div class="input-container ic1" style="margin-bottom: 50px">
                    <input id="title" name="title" @if ($settings) value="{{ $settings->website_title }}" @endif class="input" type="text" placeholder=" " />
                    <label for="title" >Website Title</label>
                    </div>
                    <div class="input-container ic2" style="margin-bottom: 50px">
                        @if ($settings)
                            <label for="">Current Logo: </label>
                            {{-- <img src="{{ asset('uploads/'.$settings->logo) }}" width="100px" alt=""><br><br> --}}
                        @endif
                        <input id="logo" name="logo" class="input" type="file" placeholder=" " />
                        <label for="logo" >Logo</label>
                    </div><br><br><br><br>
                    <div class="input-container ic2" style="margin-bottom: 50px">
                        @if ($settings)
                            <label for="">Current Favicon: </label>
                            {{-- <img src="{{ asset('uploads/'.$settings->favicon) }}" width="100px" alt=""><br><br> --}}
                        @endif
                        <input id="favicon" name="favicon"  class="input" type="file" placeholder=" " />
                        <label for="favicon" >Favicon</label>
                    </div><br><br><br><br>
                    <div class="input-container ic2" style="margin-bottom: 50px">
                    <input id="keywords" name="keywords" value="{{ $settings->keywords}}" class="input" type="text" placeholder=" " />
                    <label for="keywords" >Keywords</label>
                    </div>
                    <div class="input-container ic2" style="margin-bottom: 30px">
                    <textarea id="description" name="description" class="input" cols="40" rows="15">{{ $settings->description }}</textarea>
                    <label for="description" >Description</>
                    </div>
                    <button type="submit" class="submit">Save</button>
                </div>
            </form>
        </div>

        
    </section>

@endsection
 
