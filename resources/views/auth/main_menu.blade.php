<nav class="navbar navbar-expand-lg navbar-dark bg-dark main-menu-fill-blue">
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                {{ __('main_menu.menu_user') }}
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="user/myProfile"><i class="fas fa-user"></i> {{ __('main_menu.menu_user_profile') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout"><i class="fas fa-sign-out-alt"></i> {{ __('main_menu.menu_user_logout') }}</a>
            </div>
        </li>
    </ul>
</nav>
