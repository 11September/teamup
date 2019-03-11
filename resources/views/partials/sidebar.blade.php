<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{ asset('images/icon/logo.png') }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ request()->is('admin') ? 'active' : '' }}"><a href="{{ url('admin') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                    <li class="{{ request()->is('admin/users*') ? 'active' : '' }}"><a href="{{ url('admin/users') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
                    <li class="{{ request()->is('admin/teams*') ? 'active' : '' }}"><a href="index.html"><i class="fas fa-users-cog"></i> <span>Teams</span></a></li>
                    <li class="{{ request()->is('admin/activities*') ? 'active' : '' }}"><a href="index.html"><i class="fas fa-stopwatch"></i> <span>Activities</span></a></li>
                    <li class="{{ request()->is('admin/measures*') ? 'active' : '' }}"><a href="index.html"><i class="fas fa-weight-hanging"></i> <span>Measures</span></a></li>
                    <li class="{{ request()->is('admin/reports*') ? 'active' : '' }}"><a href="index.html"><i class="far fa-file-alt"></i> <span>Reports</span></a></li>
                    <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}"><a href="{{ url('admin/settings') }}"><i class="fas fa-cogs"></i> <span>Settings</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
