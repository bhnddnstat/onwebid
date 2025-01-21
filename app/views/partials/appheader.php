<div id="topbar" class="navbar col-sm-8 navbar-expand-md fixed-top navbar-dark mx-auto" style="background-color: #1440b8; color: #ecf0f1; border-radius: 5px">
    <div class="container-fluid">
            <?php 
            if(user_login_status() == true ){ 
            ?>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <?php Html :: render_menu(Menu :: $navbartopleft  , "navbar-nav mr-auto" ); ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown p-3">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            <span class="avatar-icon"><i class="material-icons">account_box</i></span> 
                            <span>Hi <?php echo ucwords(USER_NAME); ?> !</span>
                        </a>
                        <ul class="dropdown-menu">
                            <a class="dropdown-item" href="<?php print_link('account') ?>"><i class="material-icons">account_box</i> My Account</a>
                            <a class="dropdown-item" href="<?php print_link('index/logout?csrf_token=' . Csrf::$token) ?>"><i class="material-icons">exit_to_app</i> Logout</a>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php 
            } 
            ?>
        </div>
    </div>