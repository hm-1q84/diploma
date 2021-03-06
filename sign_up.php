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
            $pswrd = generateStrongPassword();

            //проверка на существование аккаунта с таким логином
            $stmt = $conn->prepare("SELECT login FROM accounts WHERE login = ?");
            $stmt->bind_param("s", $login);
            $stmt->execute();
            if ($stmt->fetch()) {
                echo '<script>alert("Аккаунт с таким логином уже существует!")</script>'; 
            }
            else {
                //регистрация нового аккаунта
                $sql = "INSERT INTO `accounts`(`login`, `email`, `password`, `date`) 
                        VALUES ('$login', '$email', AES_ENCRYPT('".$pswrd."', '".$aes_key."'), '$date')";
                if (!$conn->query($sql)) {
                    echo '<script>alert("Упс, ошибочка в запросе к БД!")</script>'; 
                }
                include 'sign_up_mail.php'; //скрип отправки логина и пароля на почту нового аккаунта продавца
            }

            $conn->close();
        }
    ?> 

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-2 offset-md-10">
                    <a href="account.php" class="back-btn">Назад</a>
                </div>
            </div>
            <div class="row"> 
                <div class="col-lg-6 offset-lg-3">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form form_sign-up mx-auto">
                        <h3 class="form__header">Регистрация продавца</h3>
                        <small class="form__note">*Пароль будет сгенерирован автоматически и отправится на ниже веденную почту нового продавца вместе с его логином.</small>
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
?>