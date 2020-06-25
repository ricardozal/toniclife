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
    <a class="nav-link {{$routeName == 'admin_user_index' ? 'active' : ''}}"
       href="{{route('admin_user_index')}}">
        <span>
            <i class="fas fa-user"></i>
        </span>
        <span class="sidebar-text">Usuarios</span>
    </a>
    <a class="nav-link {{$routeName == '' ? 'active' : ''}}"
       href="#">
        <span>
            <i class="fas fa-users"></i>
        </span>
        <span class="sidebar-text">Distribuidores</span>
    </a>
    <a class="nav-link {{$routeName == '' ? 'active' : ''}}"
               href="#">
        <span>
            <i class="fas fa-boxes"></i>
        </span>
        <span class="sidebar-text">Inventarios</span>
    </a>
    <a class="nav-link {{$routeName == '' ? 'active' : ''}}"
       href="#">
        <span>
            <i class="fas fa-cart-arrow-down"></i>
        </span>
        <span class="sidebar-text">Orden de compra</span>
    </a>
    <a class="nav-link {{$routeName == '' ? 'active' : ''}}"
       href="#">
        <span>
            <i class="fas fa-building"></i>
        </span>
        <span class="sidebar-text">Reordenes</span>
    </a>
    <a class="nav-link {{$routeName == '' ? 'active' : ''}}"
       href="#">
        <span>
            <i class="fas fa-shipping-fast"></i>
        </span>
        <span class="sidebar-text">Envíos</span>
    </a>
    <a class="nav-link {{$routeName == '' ? 'active' : ''}}"
       href="#">
        <span>
            <i class="fas fa-sitemap"></i>
        </span>
        <span class="sidebar-text">Red</span>
    </a>
    <a class="nav-link {{$routeName == 'login_logout' ? 'active' : ''}}"
       href="{{route('login_logout')}}">
        <span>
            <i class="fas fa-sign-out-alt"></i>
        </span>
        <span class="sidebar-text">Cerrar Sesión</span>
    </a>
</nav>

