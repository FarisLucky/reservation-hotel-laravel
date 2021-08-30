<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" width="50px" src="{{ asset('images/charlee.png') }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">John Doe</p>
            <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item {{ activeMenu('/') }}" href="/"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview {{ activeMenu(['rooms*'],'is-expanded') }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Data Master</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ activeSubMenu('rooms*') }}" href="{{route('rooms.index')}}">
                        <i class="icon fa fa-circle-o"></i>
                        Rooms
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
