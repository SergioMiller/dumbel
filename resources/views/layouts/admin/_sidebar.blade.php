<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href=" {{ route('user.edit', auth()->id()) }}" class="d-block">
                    {{ auth()->user()->name }} {{ auth()->user()->lastname }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('swagger') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Swagger</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Користувачі</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('qr-code.index') }}" class="nav-link">
                        <i class="fas fa-barcode"></i>
                        <p>QR Коди</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('gym.index') }}" class="nav-link">
                        <i class="fas fa-futbol"></i>
                        <p>Спортивні зали</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>