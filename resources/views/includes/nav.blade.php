<nav>
    <a href={{ url('/') }}><img src={{ asset('images/logo.png.png') }} class="logo"></a>
    <ul>
        <li><a href="#">Features</a></li>
        <li><a href="#">How it works</a></li>
        <li><a href="#">Privacy</a></li>
    </ul>
    <div>
        @if (Auth::check())
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->role == 0)
                    <a class="dropdown-item" href={{ url('home') }}>Dashboard</a>
                    @elseif (Auth::user()->role == 1)
                    <a class="dropdown-item" href={{ url('admin/index') }}>Dashboard</a>
                    @endif

                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>
        </ul>
        @else 
            <a href={{ url('/login') }} class="login-btn">Log in</a>
            <a href={{ url('/register') }} class="btn">Register</a>
        @endif
        
    </div>
        </nav>