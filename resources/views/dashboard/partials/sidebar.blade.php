<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{Session::get('roleCheck') == 2 ? 'Seller Dashboard' : 'Admin' }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>
            <li class={{ (Route::currentRouteName() == 'admin.dashboard') ? 'active' : ''}}><a class="nav-link" href="/seller"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

            <li class="menu-header">Menu</li>
            <li class= "@stack('active.user-management')">
                <a class="nav-link" href="{{ route('user-management.index') }}">
                    <i class="fab fa-servicestack"></i>
                    <span>User Management</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown @stack('active.orders')" data-toggle="dropdown">
                    <i class="fab fa-stripe-s"></i>
                    <span>My Transaction</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">History</a></li>
                    <li><a class="nav-link" href="">Order</a></li>
                </ul>
            </li>
        </ul>

		<ul class="sidebar-menu {{Session::get('roleCheck') == 1 ? '' : 'd-none'}}">

            <li class="menu-header">Dashboard</li>
            <li class={{ (Route::currentRouteName() == 'admin.dashboard') ? 'active' : ''}}><a class="nav-link" href="/seller"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

			<li class="@stack('active.payments')">
				<a class="nav-link" href="">
					<i class="fab fa-stripe-s"></i>
					<span>Payment</span>
				</a>
			</li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
