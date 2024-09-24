<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
         <a href="dashboard-ecommerce.html">
            <img src="{{ asset('spp.png')}}" alt="Logo" style="width: auto; height: 40px; margin-right: 5px; text-align:left; margin-top:-5px; border-radius:13px;">
            <span class="ml-1">Stock App</span>
        </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"><img src="{{ asset('spp.png')}}" alt="Logo" style="width: auto; height: 40px; margin-right: 5px; text-align:left; margin-top:-5px; border-radius:13px; margin-left:-10px;"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}"><a class="nav-link" href=""><i class="fas fa-home"></i> <span>Dashboard</span></a></li>

            <li class="dropdown {{ Request::is('master*') ? 'active' : ''}}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-warehouse"></i><span>Master Data</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('dashboard/summary') ? 'active' : ''}}"><a class="nav-link" href="{{ route('dashboard.summary')}}"><i class="{{ Request::is('dashboard/summary') ? 'far fa-dot-circle' : 'far fa-circle'}}" style="margin-left: -45px;"></i><span style="margin-left: -3px;">Warehouse</span></a></li>
                <li class="{{ Request::is('master-data/vendor*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('master.vendor')}}"><i class="{{ Request::is('master-data/vendor*') ? 'far fa-dot-circle' : 'far fa-circle'}}" style="margin-left: -45px;"></i><span style="margin-left: -3px;">Vendor</span></a></li>
                <li class="{{ Request::is('dashboard/history') ? 'active' : ''}}"><a class="nav-link" href="{{ route('dashboard.history')}}"><i class="{{ Request::is('dashboard/summary') ? 'far fa-dot-circle' : 'far fa-circle'}}" style="margin-left: -45px;"></i><span style="margin-left: -3px;">Project</span></a></li>
                <li class="{{ Request::is('dashboard/history') ? 'active' : ''}}"><a class="nav-link" href="{{ route('managing.product') }}"><i class="{{ Request::is('dashboard/summary') ? 'far fa-dot-circle' : 'far fa-circle'}}" style="margin-left: -45px;"></i><span style="margin-left: -3px;">Item</span></a></li>
            </ul>
            </li>

            <li class="dropdown {{ Request::is('transaction*') ? 'active' : ''}}">
            <a href="#" class="nav-link has-dropdown"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ui-checks" viewBox="0 0 16 16"><path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/></svg></i><span>Controls</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('transaction/stock-in') ? 'active' : ''}}"><a class="nav-link" href="{{ route('transaction.stockin') }}">Stock In <i class="fas fa-download"></i></a></li>
                <li class="{{ Request::is('transaction/stock-out*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('transaction.stockout') }}">Stock Out <i class="fas fa-upload"></i></a></li>
                <li class="{{ Request::is('transaction/stock-manager') ? 'active' : ''}}"><a class="nav-link" href="{{ route('transaction.stockmanager') }}">Stock Manager<i class="fas fa-layer-group"></i></a></li>

            </ul>
            </li>

            <li class="menu-header">Managing</li>
            <li class="dropdown {{ Request::is('managing*') ? 'active' : ''}}">
            <a href="#" class="nav-link has-dropdown"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16"><path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5z"/><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/></svg></i><span>Data & Account</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('managing/product') ? 'active' : ''}}"><a class="nav-link" href="{{ route('managing.product') }}">Products</a></li>
                <li class="{{ Request::is('managing/supplier*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('managing.supplier') }}">Suppliers</a></li>
                <li class="{{ Request::is('managing/user') ? 'active' : ''}}"><a class="nav-link" href="{{ route('managing.user') }}">Users Account</a></li>
                <li class="{{ Request::is('managing/employee') ? 'active' : ''}}"><a class="nav-link" href="{{ route('managing.employee') }}">Employees</a></li>
                <li class="{{ Request::is('managing/department') || Request::is('managing/division') ? 'active' : '' }}"><a class="nav-link" href="{{ route('managing.department') }}">Department & Division</a></li>
            </ul>
            </li>
           
        </ul>
    </aside>
</div>