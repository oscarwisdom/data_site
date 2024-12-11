@extends('layouts.user')

@section('content')   
<div class="main">
  <div class="topbar">
    <div class="toggle">
        <i class="fa fa-navicon"></i>
    </div>
    {{-- div class="search">
        <label class="label">
            <input type="text" placeholder="search here" id="search">
            <i class="fa fa-search"></i>
        </label>
    </> --}}
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
          <i class="fas fa-exchange" aria-hidden="true"></i>
          <p> Transactions</p>
      </div>
      <div>
        <table>
          <thead>
            <th>Request ID</th>
            <th>User ID</th>
            <th>Product Name</th>
            <th>Phone</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Status</th>
            <th>Created At</th>
          </thead>

          <tbody>
            @foreach ($transactions as $transaction)
              <tr>
                <td>{{ $transaction->request_id }}</td>
                <td>{{ $transaction->user_id }}</td>
                <td>{{ $transaction->product_name }}</td>
                <td>{{ $transaction->phone }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->type }}</td>
                <td>{{ $transaction->status == 1 ? "Deliverd" : "Not Delivered" }} </td>
                <td>{{ $transaction->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection