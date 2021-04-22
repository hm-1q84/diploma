<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <img class="header__logo" src="img/logo.jpg" alt="Лого">
            </div>
            <div class="col-lg-6">
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
                        <div class="col-lg-2 offset-lg-1">
                            <a href="requests.php"><img class="header__icon" src="img/list.png" alt="Заявки"></a>
                            <a href="authorization.php"><img class="header__icon" src="img/seller-2.png" alt="Продавец"></a>
                            <a href="sign_up.php"><img class="header__icon" src="img/sign-up.png" alt="Регистрация"></a>
                        </div>
                    ';
                }
                else {
                    echo '
                        <div class="col-lg-1 offset-lg-2">
                            <a href="authorization.php"><img class="header__icon" src="img/seller-2.png" alt="Продавец"></a>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
</header>