<section id="menu">
    <div class="logo">
        <img src="img/game-pad.jpg" alt="">
        <h2>Admin</h2>
    </div>
    <nav class="items">
        <li><a href="{{ url('admin/index') }}"><img src="icons/chart.svg" alt="" class="icons">Dashboard</a></li>
        <li><a href="{{ url('admin/users') }}"><img src="icons/table.svg" alt="" class="icons">Users</a></li>
        <li><a href="#"><img src="icons/form.svg" alt="" class="icons">Forms</a></li>
        <li><a href="#"><img src="icons/credit-card.svg" alt="" class="icons">Cards</a></li>
        <li><a href="#"><img src="icons/settings.svg" alt="" class="icons">Settings</a></li>
        <li onclick="return confirm('Are you sure to logout?')">
            <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <img src="icons/logout.svg" alt="" class="icons">Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
        </li>
    </nav>
</section>