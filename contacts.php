<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/contacts.css">
</head>
<body>

    <?php include 'header.php' ?> <!-- dynamic header connection -->

    <main>
        <div class="container">
            <!-- map -->
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ae0aa2ba1d5236d38977621bf15898aee6f09b65526d9254b0fdd33d623d938ce&amp;width=100%&amp;height=500&amp;lang=ru_RU&amp;scroll=false"></script>
            <div class="contacts">
                <p class="contacts__info">
                    <b>Адрес:</b>
                    Россия, Ленинградская область, Санкт-Петербург, Наб. реки Екатерингофки, д. 19
                </p>
                <p class="contacts__info">
                    <b>Email:</b>
                    drobilka77@list.ru
                </p>
                <p class="contacts__info">
                    <b>Телефон:</b>
                    +78129009807
                </p>
            </div>
            <?php include 'form_request.php' ?>
        </div> <!-- container  -->
    </main>

    <?php include 'footer.php'; ?>     <!-- dynamic footer connection -->

    <script> //script changing color of the current page link in header menu
        var cur = document.getElementsByTagName("a")[3];
        cur.classList.add("nav");
    </script>

</body>
</html>