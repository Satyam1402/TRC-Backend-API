<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="javascript:void(0);" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Users</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/properties') }}" class="nav-link {{ Request::is('properties') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Properties</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('utilities.index') }}" class="nav-link {{ request()->is('utilities*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-toolbox"></i>
                    <p>Utilities</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('providers.index') }}" class="nav-link {{ request()->routeIs('providers.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-network-wired"></i>
                    <p>Providers</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('companies.index') }}" class="nav-link {{ request()->routeIs('company.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-network-wired"></i>
                    <p>Companies</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="javascript:void(0);" class="nav-link">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>Social Media Challenges</p>
                </a>
            </li>
        </ul>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" title="Log out">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Log out</p>
                </a>
            </li>
        </ul>
    </nav>


    <!-- /.sidebar-menu -->
</div>
