<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Восстановление пароля</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <?php 
        include 'header.php'; //dynamic header connection
        if (isset($_POST['login']) && isset($_POST['email'])) {
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

            $stmt = $conn->prepare("SELECT AES_DECRYPT(`password`, '".$aes_key."') AS password 
                                    FROM accounts 
                                    WHERE login = ? AND email = ?");
            $stmt->bind_param("ss", $login, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $record = $result->fetch_assoc(); // fetch data   
            if (!empty($record)) { //if record isn't empty then get password
                $pswrd = $record['password'];
                $stmt->close();
                $conn->close();
                include 'recovery_mail.php';
            }
            else { //if record is empty then smth is wrong, throw an error
                $stmt->close();
                $conn->close();
                echo '<script>alert("Аккаунта с таким логином и паролем не существует!")</script>'; 
            }
        }
    ?> 

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 offset-lg-10">
                    <a href="authorization.php" class="back-btn">Назад</a>
                </div>
            </div>
            <div class="row"> 
                <div class="col-lg-6 offset-lg-3">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form form_sign-up mx-auto">
                        <h3 class="form__header">Восстановление пароля</h3>
                        <small class="form__note">*Введите логин и почту, привязанную к аккаунту. На нее будет выслан пароль.</small>
                        <input name="login" class="form__input" type="text" placeholder="Логин" required>
                        <input name="email" class="form__input" type="email" placeholder="Email" required>
                        <input class="form__btn" type="submit" value="Восстановить">
                    </form>
                </div>
            </div>
        </div> <!-- container  -->
    </main>

    <?php include 'footer.php'; ?>     <!-- dynamic footer connection -->

</body>
</html>