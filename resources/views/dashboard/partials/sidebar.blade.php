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
            <li class={{ (Route::currentRouteName() == 'dashboard.index') ? 'active' : ''}}><a class="nav-link" href="{{route('dashboard.index')}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

            <li class="menu-header">Self Service</li>
            <li class="@stack('active.my-attendance')">
                <a class="nav-link" href="{{ route('attendance.index') }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>My Attendance</span>
                </a>
            </li>
            <li class="@stack('active.leave')">
                <a class="nav-link" href="{{ route('leave.index') }}">
                    <i class="fas fa-plane-departure"></i>
                    <span>Leave</span>
                </a>
            </li>
            {{-- <li class="dropdown @stack('active.self-service')">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class=""></i>
                    <span>Self Service</span></a>
                <ul class="dropdown-menu">
                    <li class=><a class="nav-link" >My Attendance</a></li>
                    <li><a class="nav-link" href="">Order</a></li>
                </ul>
            </li> --}}
            <li class="menu-header">Master Data</li>
            <li class="@stack('active.approval-template')">
                <a class="nav-link"  href="{{ route('approval-template.index') }}">
                    <i class="fas fa-sitemap"></i>
                    <span>Approval Template</span>
                </a>
            </li>
            <li class="@stack('active.claim-type')">
                <a class="nav-link" href="{{ route('claim-type.index') }}">
                    <i class="fas fa-wallet"></i>
                    <span>Claim Type</span>
                </a>
            </li>
            <li class="@stack('active.leave-type')">
                <a class="nav-link" href="{{ route('leave-type.index') }}">
                    <i class="fas fa-bicycle"></i>
                    <span>Leave Type</span>
                </a>
            </li>

            <li class="@stack('active.role')">
                <a class="nav-link" href="{{ route('role.index') }}">
                    <i class="fas fa-briefcase"></i>
                    <span>Role</span>
                </a>
            </li>

            <li class="menu-header">User Management</li>
            <li class="@stack('active.user-management')">
                <a class="nav-link" href="{{ route('user-management.index') }}">
                    <i class="fas fa-user-tie"></i>
                    <span>Employee</span>
                </a>
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
