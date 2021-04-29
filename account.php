<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аккаунт</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <?php 
        include 'header.php'; //dynamic header connection
        if ($_SESSION['loggedin'] == false) { 
            header("Location: authorization.php");
        }
        elseif (isset($_POST['old_pas']) && isset($_POST['new_pas'])) {
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
  
            $old_pswrd = $_POST["old_pas"]; 
            $new_pswrd = $_POST["new_pas"];
            $aes_key = 'Hj.92X$m`SD[S<ew';

            // prepare and bind
            $stmt = $conn->prepare("UPDATE accounts 
                                    SET password = AES_ENCRYPT(?, '".$aes_key."') 
                                    WHERE AES_DECRYPT(`password`, '".$aes_key."') = ? AND login = '".$_SESSION['login']."'");
            $stmt->bind_param("ss", $new_pswrd, $old_pswrd);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                echo '<script>alert("Пароль успешно изменен!")</script>'; 
            }
            else {
                echo '<script>alert("Неверный старый пароль!")</script>'; 
            }

            $stmt->close();
            $conn->close();
        }
    ?>

    <main>
        <div class="container">
            <h1 class="account__header">Аккаунт</h1>
            <p class="account__info"><strong>Логин: </strong> <?php echo $_SESSION['login']; ?></p>
            <p class="account__info"><strong>Email: </strong> <?php echo $_SESSION['email']; ?></p>
            <p class="account__info"><strong>Дата регистрации: </strong> <?php echo date("d.m.Y", strtotime($_SESSION['date'])); ?></p>
            <div class="buttons-container">
                <a class="account__btn modify-btn" href="modification.php">Редактировать</a><br>
                <a class="account__btn logout-btn" href="logout.php">Выйти</a>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form form_authorization mx-auto">
                        <h3 class="form__header">Смена пароля</h3>
                        <input name="old_pas" class="form__input" type="password" placeholder="Старый пароль" required>
                        <input name="new_pas" class="form__input" type="password" placeholder="Новый пароль" required>
                        <input class="form__btn" type="submit" value="Изменить">
                    </form>
                </div>
            </div>
        </div> <!-- container  -->
    </main>

    <?php include 'footer.php'; ?>     <!-- dynamic footer connection -->

</body>
</html>