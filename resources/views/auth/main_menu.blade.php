<nav class="navbar navbar-expand-lg navbar-dark bg-dark main-menu-fill-blue">
    <ul class="navbar-nav">
        <a class="navbar-brand" href="{{ url('welcome') }}"><i class="fas fa-bars"></i></a>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                <i class="fas fa-user"></i> {{ __('main_menu.menu_user') }}
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('user/MyProfile') }}"><i class="fas fa-user"></i> {{ __('main_menu.menu_user_profile') }}</a>
                <a class="dropdown-item" href="{{ url('user/changePassword') }}"><i class="fas fa-key"></i> {{ __('main_menu.menu_user_change_password') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('logout') }}"><i class="fas fa-sign-out-alt"></i> {{ __('main_menu.menu_user_logout') }}</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                <i class="fas fa-tasks"></i> {{ __('main_menu.menu_orders') }}
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('order/New') }}"><i class="fas fa-plus-square"></i> {{ __('main_menu.menu_orders_new') }}</a>
                <a class="dropdown-item" href="#"><i class="fas fa-list-alt"></i> {{ __('main_menu.menu_orders_list') }}</a>
            </div>
        </li>

        @if (Auth::user()->checkRole('operator'))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <i class="fas fa-globe"></i> {{ __('main_menu.menu_operator_dictionaries') }}
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><i class="fas fa-building"></i> {{ __('main_menu.menu_operator_buildings') }}</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-business-time"></i> {{ __('main_menu.menu_operator_companies') }}</a>
                    <a class="dropdown-item" href="{{ url('units') }}"><i class="fas fa-tachometer-alt"></i> {{ __('main_menu.menu_operator_units') }}</a>
                </div>
            </li>
        @endif

        @if (Auth::user()->checkRole('administrator'))
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <i class="fas fa-users-cog"></i> {{ __('main_menu.menu_administrator') }}
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('administrator/NewUser') }}"><i class="fas fa-user-plus"></i> {{ __('main_menu.menu_administrator_new_user') }}</a>
                    <a class="dropdown-item" href="{{ url('administrator/UsersList') }}"><i class="fas fa-users"></i> {{ __('main_menu.menu_administrator_users_list') }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('administrator/Departments') }}"><i class="fas fa-location-arrow"></i> {{ __('main_menu.menu_administrator_departments') }}</a>
                </div>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#aboutWindow"><i class="fas fa-info-circle"></i> {{ __('main_menu.about_info') }}</a>
        </li>
    </ul>
</nav>
