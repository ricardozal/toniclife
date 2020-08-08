{{--<a href="{{route('login_logout')}}">cerrar seion</a>--}}

@php
    $routeName= Route::current()->getName();
@endphp

<nav class="nav">
    <div class="row mb-3">
        <div class="col-12 text-center">
            <img src="{{asset('img/logos/tonic-white.png')}}" style="width: 50%">
        </div>
    </div>
    @if(Auth::user()->isAdmin())
    <a class="nav-link {{$routeName == 'admin_user_index' ? 'active' : ''}}"
       href="{{route('admin_user_index')}}">
        <span>
            <i class="fas fa-user"></i>
        </span>
        <span class="sidebar-text">Usuarios</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_branch_index' ? 'active' : ''}}"
       href="{{route('admin_branch_index')}}">
        <span>
            <i class="fas fa-building"></i>
        </span>
        <span class="sidebar-text">Sucursales</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_distributor_index' ? 'active' : ''}}"
       href="{{route('admin_distributor_index')}}">
        <span>
            <i class="fas fa-users"></i>
        </span>
        <span class="sidebar-text">Distribuidores</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_category_index' ? 'active' : ''}}"
       href="{{route('admin_category_index')}}">
        <span>
            <i class="fas fa-book"></i>
        </span>
        <span class="sidebar-text">Categorias</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_product_index' ? 'active' : ''}}"
       href="{{route('admin_product_index')}}">
        <span>
            <i class="fab fa-product-hunt"></i>
        </span>
        <span class="sidebar-text">Productos</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_inventory_index' ? 'active' : ''}}"
               href="{{route('admin_inventory_index')}}">
        <span>
            <i class="fas fa-boxes"></i>
        </span>
        <span class="sidebar-text">Inventarios</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_order_index' ? 'active' : ''}}"
       href="{{route('admin_order_index')}}">
        <span>
            <i class="fas fa-cart-arrow-down"></i>
        </span>
        <span class="sidebar-text">Ordenes de compra</span>

    </a>
    <a class="nav-link {{$routeName == 'admin_promotion_index' ? 'active' : ''}}"
       href="{{route('admin_promotion_index')}}">
        <span>
            <i class="fas fa-percent"></i>
        </span>
        <span class="sidebar-text">Promociones</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_reorder_index' ? 'active' : ''}}"
       href="{{route('admin_reorder_index')}}">
        <span>
            <i class="fas fa-building"></i>
        </span>
        <span class="sidebar-text">Reorden de compras</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_shipping_index' ? 'active' : ''}}"
       href="{{route('admin_shipping_index_menu')}}">
        <span>
            <i class="fas fa-box-open"></i>
        </span>
        <span class="sidebar-text">Entregas</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_org_chart_index' ? 'active' : ''}}"
       href="{{route('admin_org_chart_index')}}">
        <span>
            <i class="fas fa-sitemap"></i>
        </span>
        <span class="sidebar-text">Red de distribuidores</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_country_index' ? 'active' : ''}}"
       href="{{route('admin_country_index')}}">
        <span>
            <i class="fas fa-globe-americas"></i>
        </span>
        <span class="sidebar-text">Países</span>
    </a>
    <a class="nav-link {{$routeName == 'admin_kits_index' ? 'active' : ''}}"
           href="{{route('admin_kits_index')}}">
                    <span>
                        <i class="fas fa-box-open"></i>
                    </span>
            <span class="sidebar-text">Kits de inscripción</span>
    </a>
    @endif
    @if(Auth::user()->isBranch())
        <a class="nav-link {{$routeName == 'branch_inventory_index' ? 'active' : ''}}"
           href="{{route('branch_inventory_index')}}">
        <span>
            <i class="fas fa-boxes"></i>
        </span>
            <span class="sidebar-text">Inventario</span>
        </a>
        <a class="nav-link {{$routeName == '' ? 'active' : ''}}"
           href="#">
        <span>
            <i class="fas fa-paper-plane"></i>
        </span>
            <span class="sidebar-text">Envíos</span>
        </a>
        <a class="nav-link {{$routeName == '' ? 'active' : ''}}"
           href="#">
            <span>
                <i class="fas fa-store"></i>
            </span>
            <span class="sidebar-text">Entregas</span>
        </a>
    @endif
    <a class="nav-link {{$routeName == 'login_logout' ? 'active' : ''}}"
       href="{{route('login_logout')}}">
        <span>
            <i class="fas fa-sign-out-alt"></i>
        </span>
        <span class="sidebar-text">Cerrar Sesión</span>
    </a>
</nav>

