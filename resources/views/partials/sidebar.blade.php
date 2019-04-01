<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ url('/admin') }}"><img src="{{ asset('images/icon/logo.png') }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ request()->is('admin') ? 'active' : '' }}">
                        <a href="{{ url('admin') }}"><i class="sidebar-menu-icon fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @if(Auth::user()->type == "admin")
                        <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                            <a href="{{ url('admin/users') }}"><i class="sidebar-menu-icon fa fa-users"></i>
                                <span>Users</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('admin/measures*') ? 'active' : '' }}">
                            <a href="{{ url('admin/measures') }}"><i class="sidebar-menu-icon fas fa-weight-hanging"></i>
                                <span>Measures</span>
                            </a>
                        </li>



                        <li class="{{ request()->is('admin/feedbacks*') ? 'active' : '' }}">
                            <a href="{{ url('admin/feedbacks') }}"><i class="sidebar-menu-icon fas fa-comments"></i>
                                <span>Feedbacks</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                            <a href="{{ url('admin/settings') }}"><i class="sidebar-menu-icon fas fa-cogs"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                    @endif


                    <li class="{{ request()->is('admin/teams*') ? 'active' : '' }}">
                        <a href="#"><i class="sidebar-menu-icon fas fa-users-cog"></i>
                            <span>Teams</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('admin/reports*') ? 'active' : '' }}">
                        <a href="#"><i class="sidebar-menu-icon far fa-file-alt"></i>
                            <span>Reports</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('admin/activities*') ? 'active' : '' }}">
                        <a href="{{ url('admin/activities') }}"><i class="sidebar-menu-icon fas fa-stopwatch"></i>
                            <span>Exercises</span>
                        </a>
                    </li>

                    @if(Auth::user()->type == "coach")
                        <li class="{{ request()->is('admin/notes*') ? 'active' : '' }}">
                            <a href="{{ url('admin/notes') }}"><i class="sidebar-menu-icon far fa-sticky-note"></i>
                                <span>Notes</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
