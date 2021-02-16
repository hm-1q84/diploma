<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявки</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <?php include 'header.php' ?> <!-- dynamic header connection -->

    <main>
        <div class="container">
            <h1 class="requests__header">Заявки</h1>
            <div class="row">
                <div class="col-lg-12">
                    <form action="#" class="form form_find ml-auto">
                        <input class="form__input form_find__input" type="text" placeholder="Имя клиента" required>
                        <input class="form__btn form_find__btn" type="submit" value="Найти">
                    </form>
                </div>
            </div>
        </div> <!-- container  -->
    </main>

    <?php include 'footer.php'; ?>     <!-- dynamic footer connection -->

    <script>  //script changing image of seller to the log-out image
        var img = document.getElementById("header__seller");
        img.src = 'img/logout.png';
    </script>

</body>
</html>