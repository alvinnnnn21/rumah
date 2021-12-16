<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-text mx-3">DASHBOARD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin') }}">
            <i class="fas fa-user"></i>
            <span>User</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/bukti') }}">
            <i class="fas fa-money-bill"></i>
            <span>Bukti Pembayaran</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/rumah') }}">
            <i class="fas fa-home"></i>
            <span>Rumah</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/kriteria') }}">
            <i class="fas fa-list"></i>
            <span>Kriteria</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <form method="post" action="{{ url("/logout") }}">
            @csrf
        <button href="javascript:void(0)" type="submit" class="btn nav-link">    
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span></button>
        </form>
    </li>
</ul>
<!-- End of Sidebar -->