<!-- Sidebar -->
<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('drive') }}" class="nav-link {{ request()->is('drive*') || request()->is('account*') || request()->is('logs*')? 'active' : '' }}">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>Drive</p>
                </a>
            </li>

            @if(auth()->user()->role == "Administrator") 
            <li class="nav-item">
                <a href="{{ route('ulist') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
            @endif

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gear"></i>
                    <p>Settings</p>
                </a>
            </li>
        </ul>
    </nav>
</div>