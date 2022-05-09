<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="#">
                            <span class="pcoded-mtext">Default</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pcoded-mtext">CRM</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pcoded-mtext">Analytics</span>
                            <span class="pcoded-badge label label-info ">NEW</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('user.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                    <span class="pcoded-mtext">Users</span>
                </a>
            </li>
        </ul>
    </div>
</nav>