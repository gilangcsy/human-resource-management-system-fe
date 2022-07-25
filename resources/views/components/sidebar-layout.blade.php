<div class="sidebar-menu">
    <!-- BEGIN SIDEBAR MENU ITEMS-->
    <ul class="menu-items">
        @foreach ($lists as $list)
            @if ($list['childs'])
                <li class="{{ $loop->iteration == 1 ? 'm-t-20' : '' }}">
                    <a href="javascript:;"><span class="title">{{ $list['name'] }}</span>
                        <span class=" arrow"></span></a>
                    <span class="icon-thumbnail"><i class="pg-icon">{{ $list['icon'] }}</i></span>
                    <ul class="sub-menu">
                        @foreach ($list['childs'] as $child)
                            <li class="">
                                <a href="/{{ $child['url'] }}">{{ $child['name'] }}</a>
                                <span class="icon-thumbnail"><i class="pg-icon">{{ $child['icon'] }}</i></span>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="{{ $loop->iteration == 1 ? 'm-t-20' : '' }}">
                    <a href="/{{ $list['url'] }}">
                        <span class="title">{{ $list['name'] }}</span>
                    </a>
                    <span class="icon-thumbnail"><i class="pg-icon">{{ $list['icon'] }}</i></span>
                </li>
            @endif
        @endforeach
    </ul>
    <div class="clearfix"></div>
</div>