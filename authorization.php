<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <?php 
        include 'header.php'; //dynamic header connection
        if (!array_key_exists("loggedin", $_SESSION)) { //if log in status doen't exist then set it false
            $_SESSION['loggedin'] = false;
        }
        if ($_SESSION['loggedin'] == true) {
            header("Location: account.php"); //if already authorized than redirect to requests
        }
        elseif (isset($_POST['login']) && isset($_POST['password'])) {
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
            $password = $_POST["password"]; 
            $aes_key = 'Hj.92X$m`SD[S<ew';

            $stmt = $conn->prepare("SELECT login, AES_DECRYPT(`password`, '".$aes_key."') AS password, email, date 
                                    FROM accounts 
                                    WHERE login = ? AND AES_DECRYPT(`password`, '".$aes_key."') = ?");
            $stmt->bind_param("ss", $login, $password);
            $stmt->execute();
            /* Store the result (to get properties) */
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                 /* Bind the result to variables */
                $stmt->bind_result($login, $password, $email, $date);
                while ($stmt->fetch()) { 
                    $_SESSION['loggedin'] = true; //user is authorized
                    $_SESSION['login'] = $login;
                    $_SESSION['email'] = $email;
                    $_SESSION['date'] = $date;
                }
                $stmt->free_result();
                $stmt->close();
                $conn->close();
                header("Location: account.php"); //redirect to requests
            }
            else {
                echo '<script>alert("Неверный логин или пароль")</script>'; 
            }
            $stmt->free_result();
            $stmt->close();
            $conn->close();
        }
    ?> 

    <main>
        <div class="container">
            <div class="row"> 
                <div class="col-lg-6 offset-lg-3">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form form_authorization mx-auto">
                        <h3 class="form__header">Авторизация продавца</h3>
                        <input name="login" class="form__input" type="text" placeholder="Логин" required>
                        <input name="password" class="form__input" type="password" placeholder="Пароль" required>
                        <input class="form__btn" name="submit" type="submit" value="Войти">
                        <small class="authorization__forgot"><a href="recovery.php">Забыли пароль?</a></small>
                    </form>
                </div>
            </div>
        </div> <!-- container  -->
    </main>

    <?php include 'footer.php'; ?>     <!-- dynamic footer connection -->

</body>
</html>