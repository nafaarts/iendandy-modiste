<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('sm-logo.png') }}" alt="Iendandy Modiste" height="35">
        </div>
        <div class="sidebar-brand-text mx-3 text-gold">Admin</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item @if (request()->routeIs('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-poll"></i>
            <span>Penjualan</span></a>
    </li>

    <li class="nav-item @if (request()->routeIs('katalog*')) active @endif">
        <a class="nav-link" href="{{ route('katalog.index') }}">
            <i class="fas fa-fw fa-tshirt"></i>
            <span>Katalog</span></a>
    </li>

    <li class="nav-item @if (request()->routeIs('users*')) active @endif">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengguna</span></a>
    </li>

    <li class="nav-item @if (request()->routeIs('admin*')) active @endif">
        <a class="nav-link" href="{{ route('admin') }}">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Admin</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Keluar</span></a>
    </li>

    <div class="text-center d-none d-md-inline pt-4">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
