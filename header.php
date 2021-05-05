<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-4">
                <img class="header__logo" src="img/logo.jpg" alt="Лого">
            </div>
            <div class="col-lg-6 col-md-7 header__menu-container">
                <menu class="header__menu">
                    <li><a href="index.php" class="header__menu-link">Главная</a></li>
                    <li><a href="packing.php" class="header__menu-link">Упаковочное</a></li>
                    <li><a href="food.php" class="header__menu-link">Пищевое</a></li>
                    <li><a href="contacts.php" class="header__menu-link">Контакты</a></li>
                </menu>
            </div>
            <?php 
                session_start();
                if (array_key_exists("loggedin", $_SESSION) && $_SESSION['loggedin'] == true) {
                    echo ' 
                        <div class="col-xl-2 offset-xl-1 col-md-3 col-6">
                            <a href="requests.php"><img class="header__icon" src="img/list.png" alt="Заявки"></a>
                            <a href="authorization.php"><img class="header__icon" src="img/seller-2.png" alt="Продавец"></a>
                            <a href="sign_up.php"><img class="header__icon" src="img/sign-up.png" alt="Регистрация"></a>
                        </div>
                    ';
                }
                else {
                    echo '
                        <div class="col-lg-1 offset-lg-2 col-md-2 offset-md-1 col-2 offset-4">
                            <a href="authorization.php"><img class="header__icon" src="img/seller-2.png" alt="Продавец"></a>
                        </div>
                    ';
                }
            ?>
            <div class="col-2 mobile-menu__btn-container"> 
                <a href="#" class="mobile-menu__btn">
                    <span></span>
                </a>
            </div>
        </div> 
        <div class="mobile-menu">
            <a href="index.php" class="mobile-menu__link">Главная</a>
            <hr size="1px" width="50px" color="#fff">
            <a href="packing.php" class="mobile-menu__link">Упаковочное</a>
            <hr size="1px" width="50px" color="#fff">
            <a href="food.php" class="mobile-menu__link">Пищевое</a>
            <hr size="1px" width="50px" color="#fff">
            <a href="contacts.php" class="mobile-menu__link">Контакты</a>
        </div>
    </div>
</header>