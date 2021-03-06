<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение данных</title>
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

            $old_login = $_SESSION['login'];
            $old_email = $_SESSION['email'];
            $new_login = $_POST['login'];
            $new_email = $_POST['email'];

            if ($new_login == '' && $new_email == '') { //если оба поля пустые
                echo '<script>alert("Введите новые данные для изменения!")</script>'; 
            }
            else { //если данные введены хотя бы в одно из полей
                if ($new_login == '') { // если поле "новый логин" пустое, то обновляем только email
                    $stmt = $conn->prepare("UPDATE accounts 
                                            SET email = ?
                                            WHERE email = ? AND login = ?");
                    $stmt->bind_param("sss", $new_email, $old_email, $old_login);
                    $stmt->execute();
                    if ($stmt->affected_rows == 1) {
                        echo '<script>alert("Данные успешно изменены!")</script>'; 
                        $_SESSION['email'] = $new_email;
                    }
                    else {
                        echo '<script>alert("Упс, ошибочка вышла!")</script>'; 
                    }
                }
                else { //поле "новый логин" заполнено, то сначала проверяем нет ли уже аккаунта с указанным новым логином
                    if ($new_email == '') { //если поле "новый email" пустое
                        $new_email = $old_email;
                    }
                    //проверка на существование аккаунта с таким логином
                    $stmt = $conn->prepare("SELECT login FROM accounts WHERE login = ?");
                    $stmt->bind_param("s", $new_login);
                    $stmt->execute();
                    if ($stmt->fetch()) { 
                        echo '<script>alert("Аккаунт с таким логином уже существует!")</script>'; 
                    }
                    else { //если аккаунта с веденным новым логином ещё не существует, то меняем логин авторизованного аккаунта
                        // prepare and bind
                        $stmt = $conn->prepare("UPDATE accounts 
                                                SET login = ?, email = ?
                                                WHERE login = ? AND email = ?");
                        $stmt->bind_param("ssss", $new_login, $new_email, $old_login, $old_email);
                        $stmt->execute();
                        if ($stmt->affected_rows == 1) {
                            echo '<script>alert("Данные успешно изменены!")</script>'; 
                            $_SESSION['login'] = $new_login;
                            $_SESSION['email'] = $new_email;
                        }
                        else {
                            echo '<script>alert("Упс, ошибочка вышла!")</script>'; 
                        }
                    }
                }
                $stmt->close(); 
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
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form form_modification mx-auto">
                        <h3 class="form__header">Изменение данных</h3>
                        <small class="form__note">*Для изменения только одного из полей личных данных второе оставьте пустым</small>
                        <input name="login" class="form__input" type="text" placeholder="Новый логин">
                        <input name="email" class="form__input" type="email" placeholder="Новый email">
                        <input class="form__btn" type="submit" value="Изменить">
                    </form>
                </div>  
            </div>
        </div> <!-- container  -->
    </main>

    <?php include 'footer.php'; ?>     <!-- dynamic footer connection -->

</body>
</html>