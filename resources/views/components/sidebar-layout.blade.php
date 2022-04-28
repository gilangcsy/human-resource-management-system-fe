<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">{{Session::get('roleCheck') == 2 ? 'Seller Dashboard' : 'Admin' }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        @foreach ($lists as $list)
            @if ($list['childs'])
                <li class="menu-header">{{ $list['name'] }}</li>
                @foreach ($list['childs'] as $child)
                @php
                    $stack = 'active.' . $child['url'];
                @endphp
                    <li class="@stack($stack)">
                        <a class="nav-link" href="{{ route($child['url'] . '.index') }}">
                            <i class="{{ $child['icon'] }}"></i>
                            <span>{{ $child['name'] }}</span>
                        </a>
                    </li>
                @endforeach
            @endif
        @endforeach
    </ul>

    {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
        </a>
    </div> --}}
</aside>