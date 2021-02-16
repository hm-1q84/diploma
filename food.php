<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пищевое</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/food.css">
</head>
<body>
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
                        <li><a href="food.php" class="header__menu-link nav">Пищевое</a></li>
                        <li><a href="#" class="header__menu-link">Контакты</a></li>
                    </menu>
                </div>
                <div class="col-lg-1 offset-lg-2">
                    <a href="#"><img class="header__seller" src="img/seller.png" alt="Продавец"></a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="product">
                <div class="row">
                    <div class="col-lg-4">
                        <h2>Отсадочная машина MB-120</h2>
                        <img class="product__photo" src="img/otsadochnye-mashiny-dlja-pechenja-i-prjanikov-MB.jpg" alt="MB-120">
                    </div>
                    <div class="col-lg-7 offset-lg-1">
                        <table class="product__table">
                            <tr>
                                <th>Модель отсадочной машины</th>
                                <th>МВ-120</th>
                            </tr>
                            <tr>
                                <td>Производительность по тесту</td>
                                <td>160 кг/час</td>
                            </tr>
                            <tr>
                                <td>Производительность по печенью «курабье» в кг/час (смену)</td>
                                <td>60 кг/час</td>
                            </tr>
                            <tr>
                                <td>Производительность по печенью «курабье» в шт/час (смену)</td>
                                <td>2700 шт/час</td>
                            </tr>
                            <tr>
                                <td>Масса одного изделия</td>
                                <td>5 - 60 грамм</td>
                            </tr>
                            <tr>
                                <td>Количество форсунок</td>
                                <td>3 в ряд</td>
                            </tr>
                            <tr>
                                <td>Шаг между форсунками</td>
                                <td>70 мм</td>
                            </tr>
                            <tr>
                                <td>Объем бункера</td>
                                <td>20 литров</td>
                            </tr>
                            <tr>
                                <td>Напряжение</td>
                                <td>380В</td>
                            </tr>
                            <tr>
                                <td>Потребляемая мощность</td>
                                <td>550 Вт</td>
                            </tr>
                            <tr>
                                <td>Габаритные размеры</td>
                                <td>1150*850*1400 мм</td>
                            </tr>
                            <tr>
                                <td>Масса</td>
                                <td>120 кг</td>
                            </tr>
                            <tr>
                                <td><b>Цена</b></td>
                                <td><b>109 000 руб</b></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="product__info">
                            Отсадочная машина MB-120 формирует изделия из песочного, заварного, творожного, бисквитного и другого теста. Благодаря высокой универсальности покупатель может на одной машине делать несколько видов изделий. Например кексы и профитроли, или овсяное и песочное печенье. Перенастройка машины занимает менее 10 минут. Минимальный объем отсаживаемой продукции от 10 кг. Можно поставить в один ряд форсунки разного рисунка и одновременно выпускать разный ассортимент.
                        </p>
                    </div>
                </div>
            </div>
        </div> <!-- container  -->
    </main>
    <?php include("footer.php"); ?>     <!-- dynamic footer connection -->
</body>
</html>