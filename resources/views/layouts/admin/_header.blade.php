<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Help
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                <a class="dropdown-item" href="#">FAQ</a>
                <a class="dropdown-item" href="#">Support</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Contact</a>
            </div>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                        class="fas fa-th-large"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

{{--<nav class="navbar header-navbar pcoded-header iscollapsed" navbar-theme="theme1" header-theme="theme1" pcoded-header-position="fixed">--}}
{{--    <div class="navbar-wrapper">--}}

{{--        <div class="navbar-logo" logo-theme="theme1">--}}
{{--            <a class="mobile-menu" id="mobile-collapse" href="#!">--}}
{{--                <i class="feather icon-menu"></i>--}}
{{--            </a>--}}
{{--            <a href="{{ route('dashboard') }}">--}}
{{--                <img class="img-fluid" src="/libraries/assets/images/logo.png" alt="Theme-Logo">--}}
{{--            </a>--}}
{{--            <a class="mobile-options">--}}
{{--                <i class="feather icon-more-horizontal"></i>--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="navbar-container container-fluid">--}}
{{--            <ul class="nav-left">--}}
{{--                <li>--}}
{{--                    <a href="#!" onclick="javascript::toggleFullScreen()">--}}
{{--                        <i class="feather icon-maximize full-screen"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--            <ul class="nav-right">--}}
{{--                <li class="header-notification">--}}
{{--                    <div class="dropdown-primary dropdown">--}}
{{--                        <div class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                            <i class="feather icon-bell"></i>--}}
{{--                            <span class="badge bg-c-pink">5</span>--}}
{{--                        </div>--}}
{{--                        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn"--}}
{{--                            data-dropdown-out="fadeOut">--}}
{{--                            <li>--}}
{{--                                <h6>Notifications</h6>--}}
{{--                                <label class="label label-danger">New</label>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="media">--}}
{{--                                    <img class="d-flex align-self-center img-radius"--}}
{{--                                         src="libraries\assets\images\avatar-4.jpg"--}}
{{--                                         alt="Generic placeholder image">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="notification-user">John Doe</h5>--}}
{{--                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer--}}
{{--                                            elit.</p>--}}
{{--                                        <span class="notification-time">30 minutes ago</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="media">--}}
{{--                                    <img class="d-flex align-self-center img-radius"--}}
{{--                                         src="libraries\assets\images\avatar-3.jpg"--}}
{{--                                         alt="Generic placeholder image">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="notification-user">Joseph William</h5>--}}
{{--                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer--}}
{{--                                            elit.</p>--}}
{{--                                        <span class="notification-time">30 minutes ago</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="media">--}}
{{--                                    <img class="d-flex align-self-center img-radius"--}}
{{--                                         src="libraries\assets\images\avatar-4.jpg"--}}
{{--                                         alt="Generic placeholder image">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h5 class="notification-user">Sara Soudein</h5>--}}
{{--                                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer--}}
{{--                                            elit.</p>--}}
{{--                                        <span class="notification-time">30 minutes ago</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li class="user-profile header-notification">--}}
{{--                    <div class="dropdown-primary dropdown">--}}
{{--                        <div class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                            <img src="\libraries\assets\images\avatar-4.jpg" class="img-radius" alt="User-Profile-Image">--}}
{{--                            <span>{{ Auth::user()->name }}</span>--}}
{{--                            <i class="feather icon-chevron-down"></i>--}}
{{--                        </div>--}}
{{--                        <ul class="show-notification profile-notification dropdown-menu"--}}
{{--                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">--}}
{{--                            <li>--}}
{{--                                <a href="#!">--}}
{{--                                    <i class="feather icon-settings"></i> Settings--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="user-profile.htm">--}}
{{--                                    <i class="feather icon-user"></i> Profile--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="email-inbox.htm">--}}
{{--                                    <i class="feather icon-mail"></i> My Messages--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="auth-lock-screen.htm">--}}
{{--                                    <i class="feather icon-lock"></i> Lock Screen--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
{{--                                    <i class="feather icon-log-out"></i> Logout--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                            @csrf--}}
{{--                        </form>--}}

{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}