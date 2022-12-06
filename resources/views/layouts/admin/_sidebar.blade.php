<nav class="pcoded-navbar" navbar-theme="theme1" active-item-theme="theme1" sub-item-theme="theme2"
     active-item-style="style0" pcoded-navbar-position="fixed">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel" menu-title-theme="theme5">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon" style="background-color: transparent;">
                        <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Дашборд</span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="{{ route('swagger') }}">
                            <span class="pcoded-mtext">Swagger</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('user.index') }}">
                    <span class="pcoded-micon" style="background-color: transparent;">
                        <i class="feather icon-user"></i>
                    </span>
                    <span class="pcoded-mtext">Користувачі</span>
                </a>
            </li>
            <li>
                <a href="{{ route('qr-code.index') }}">
                    <span class="pcoded-micon" style="background-color: transparent;">
                        <i class="icofont icofont-qr-code"></i>
                    </span>
                    <span class="pcoded-mtext">QR Коди</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gym.index') }}">
                    <span class="pcoded-micon" style="background-color: transparent;">
                        <i class="icofont icofont-dumbbell"></i>
                    </span>
                    <span class="pcoded-mtext">Спортивні зали</span>
                </a>
            </li>
        </ul>
    </div>
</nav>