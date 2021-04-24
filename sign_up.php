<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <?php 
        include 'header.php'; //dynamic header connection
        include 'password-generator.php'; //script for password generation
        if ($_SESSION['loggedin'] == false) { //authorization check
            header("Location: authorization.php");
        }
        elseif (isset($_POST['login']) && isset($_POST['email'])) {
            $servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "sms";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

            $login = $_POST["login"];     
            $email = $_POST["email"]; 
            $aes_key = 'Hj.92X$m`SD[S<ew';
            $date = date("Y-m-d");

            $sql = "INSERT INTO `accounts`(`login`, `email`, `password`, `date`) 
                    VALUES ('$login', '$email', AES_ENCRYPT('sms_pass', '".$aes_key."'), '$date')";
            if ($conn->query($sql)) {
                echo '<script>alert("Аккаунт успешно создан! Пароль сгенерирован и отправлен на указанную почту.")</script>'; 
            }
            else {
                echo 'Упс, ошибочка вышла!';
            }

            $conn->close();
        }
    ?> 

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 offset-lg-10">
                    <a href="account.php" class="back-btn">Назад</a>
                </div>
            </div>
            <div class="row"> 
                <div class="col-lg-6 offset-lg-3">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form form_sign-up mx-auto">
                        <h3 class="form__header">Регистрация продавца</h3>
                        <small class="form__note">*Пароль будет сгенерирован автоматически и отправится на почту нового продавца, введенную ниже.</small>
                        <input name="login" class="form__input" type="text" placeholder="Логин" required>
                        <input name="email" class="form__input" type="email" placeholder="Email" required>
                        <input class="form__btn" type="submit" value="Зарегистрировать">
                    </form>
                </div>
            </div>
        </div> <!-- container  -->
    </main>

    <?php include 'footer.php'; ?>     <!-- dynamic footer connection -->

</body>
</html>

<?php 
    // secret key: Hj.92X$m`SD[S<ew
    // INSERT INTO `accounts`(`login`, `email`, `password`, `date`) VALUES ('test', 'test@gmail.com', AES_ENCRYPT('sms_pass', 'Hj.92X$m`SD[S<ew'), '2020-05-22')
?>