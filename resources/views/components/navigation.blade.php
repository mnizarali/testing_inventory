<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar"
>
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars mt-3"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/dist/img/avatar/staff.jpg') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block mt-3" title="">
                    Hi, {{ ucfirst(Auth::user()->username) }}
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title"></div>
                <a href="" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>

                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item has-icon text-danger" style="border: none; background: none; padding: 10px 15px; text-align: left; width: 100%; display: flex; align-items: center;">
                        <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i> Logout
                    </button>
                </form>

            </div>
        </li>
    </ul>
</nav>
