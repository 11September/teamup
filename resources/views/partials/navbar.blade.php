<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="{{ url('admin') }}">СадОк Медікавер</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link" href="{{ url('admin') }}" role="button">
                @if(Auth::user()->name)
                    <p id="nav-user-name" class="no-marg orange-text">{{ Auth::user()->name }}</p>
                @endif
            </a>
        </li>

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link" href="{{ url('admin/conversations') }}" role="button">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger" id="counter_unread">{{ $counter }}</span>
            </a>
        </li>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                @if(Auth::user()->type == "admin")
                    <a class="dropdown-item" href="{{ action('AdminController@adminEdit', Auth::user()->id) }}">
                        Редагувати профіль</a>
                    <div class="dropdown-divider"></div>
                @endif

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Вийти
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
