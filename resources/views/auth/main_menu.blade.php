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
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#aboutWindow"><i class="fas fa-info-circle"></i> {{ __('main_menu.about_info') }}</a>
        </li>
    </ul>
</nav>
