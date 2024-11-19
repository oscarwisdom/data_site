<nav>
    <a href="{{ url('/') }}" class="a"><img src={{ asset('images/logo.png.png') }} class="logo"></a>
    <ul class="ul">
        <li class="li"><a href="#" class="a">Features</a></li>
        <li class="li"><a href="#" class="a">How it works</a></li>
        <li class="li"><a href="#" class="a">Privacy</a></li>
    </ul>
    <div class="nav-system">
        @if (Auth::check())
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href={{ url('home') }}>Dashboard</a>

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
        <div class="reg">
            <i class="fa-solid fa-arrow-down-short-wide"></i>
            Register
        </div>
        <div class="reg-btn">
            <a href={{ url('/login') }} class="login-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i>Log in</a>
            <a href={{ url('/register') }} class="btn">Register</a>
        </div>
        @endif

    </div>
    <i class="fa fa-bars" aria-hidden="true"></i>
</nav>


















        {{-- <script>
            const burger = document.querySelector('.fa-bars');
            const nav = document.querySelector('.navbar-nav');

            burger.addEventListener('click', () => {
                nav.classList.toggle('show');
            });
        </script> --}}
