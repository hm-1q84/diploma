<?php 
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

    if (isset($_POST['submit_insert'])) {  
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];

        $conn->query("SET NAMES utf8"); //для корректного отображения русских букв
    
        $sql = "INSERT INTO requests (name, phone, email, comment) VALUES ('$name', '$phone', '$email', '$comment')";
        $conn->query($sql);

        echo '<script>alert("Заявка успешно отправлена!")</script>'; 

        $conn->close();
    }
?>
<div class="row"> 
    <div class="col-lg-6 offset-lg-3">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form form_request mx-auto" method="post">
            <h3 class="form__header">Оставить заявку</h3>
            <input name="name" class="form__input" type="text" placeholder="Имя" required>
            <input name="phone" class="form__input" type="text" placeholder="Телефон" required>
            <input name="email" class="form__input" type="email" placeholder="Email">
            <textarea name="comment" class="form__input form__textarea" cols="30" rows="5" placeholder="Комментарий"></textarea>
            <input name="submit_insert" class="form__btn" type="submit" value="Отправить">
        </form>
    </div>
</div>