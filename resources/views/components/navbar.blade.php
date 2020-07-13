@php
    $routeName= Route::current()->getName();
@endphp
<nav class="navbar navbar-expand-md navbar-light">
    <img src="{{asset('img/logos/tonic-white.png')}}" style="width: 25%">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-top: 10%">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_user_index' ? 'active' : ''}}"
                   href="{{route('admin_user_index')}}">
                    <span>
                        <i class="fas fa-user"></i>
                    </span>
                    <span class="sidebar-text">Usuarios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_branch_index' ? 'active' : ''}}"
                   href="{{route('admin_branch_index')}}">
                    <span>
                        <i class="fas fa-building"></i>
                    </span>
                    <span class="sidebar-text">Sucursales</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_distributor_index' ? 'active' : ''}}"
                   href="{{route('admin_distributor_index')}}">
                    <span>
                        <i class="fas fa-users"></i>
                    </span>
                    <span class="sidebar-text">Distribuidores</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_product_index' ? 'active' : ''}}"
                   href="{{route('admin_product_index')}}">
                    <span>
                        <i class="fab fa-product-hunt"></i>
                    </span>
                    <span class="sidebar-text">Productos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_inventory_index' ? 'active' : ''}}"
                   href="{{route('admin_inventory_index')}}">
                    <span>
                        <i class="fas fa-boxes"></i>
                    </span>
                    <span class="sidebar-text">Inventarios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_order_index' ? 'active' : ''}}"
                   href="{{route('admin_order_index')}}">
                    <span>
                        <i class="fas fa-cart-arrow-down"></i>
                    </span>
                    <span class="sidebar-text">Ordenes de compra</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_promotion_index' ? 'active' : ''}}"
                   href="{{route('admin_promotion_index')}}">
                    <span>
                        <i class="fas fa-percent"></i>
                    </span>
                    <span class="sidebar-text">Promociones</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == '' ? 'active' : ''}}"
                   href="#">
                    <span>
                        <i class="fas fa-building"></i>
                    </span>
                    <span class="sidebar-text">Reorden de compras</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_shipping_index_menu' ? 'active' : ''}}"
                   href="#">
                    <span>
                        <i class="fas fa-shipping-fast"></i>
                    </span>
                    <span class="sidebar-text">Envíos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_org_chart_index' ? 'active' : ''}}"
                   href="{{route('admin_org_chart_index')}}">
                    <span>
                        <i class="fas fa-sitemap"></i>
                    </span>
                    <span class="sidebar-text">Red de distribuidores</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_country_index' ? 'active' : ''}}"
                   href="{{route('admin_country_index')}}">
                    <span>
                        <i class="fas fa-globe-americas"></i>
                    </span>
                    <span class="sidebar-text">Países</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'admin_kits_index' ? 'active' : ''}}"
                   href="{{route('admin_kits_index')}}">
                    <span>
                        <i class="fas fa-box-open"></i>
                    </span>
                    <span class="sidebar-text">Kits de inscripción</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$routeName == 'login_logout' ? 'active' : ''}}"
                   href="{{route('login_logout')}}">
                    <span>
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    <span class="sidebar-text">Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
