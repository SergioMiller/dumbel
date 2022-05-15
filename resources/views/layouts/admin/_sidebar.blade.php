<nav class="pcoded-navbar" navbar-theme="theme1" active-item-theme="theme1" sub-item-theme="theme2" active-item-style="style0" pcoded-navbar-position="fixed">
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
            <li>
                <a href="{{ route('qr-code.index') }}">
                    <span class="pcoded-micon"><i class="icofont icofont-qr-code"></i></span>
                    <span class="pcoded-mtext">QR Codes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gym.index') }}">
                    <span class="pcoded-micon"><i class="icofont icofont-dumbbell"></i></span>
                    <span class="pcoded-mtext">Gyms</span>
                </a>
            </li>
        </ul>
    </div>
</nav>