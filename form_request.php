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
    
        $stmt = $conn->prepare("INSERT INTO requests (name, phone, email, comment) VALUES (?, ?, ?, ?)"); // prepared statement
        $stmt->bind_param("ssss", $name, $phone, $email, $comment);
        $stmt->execute();
        if ($stmt->affected_rows != 1) {
            echo '<script>alert("Ошибка в запросе к БД!")</script>'; 
        }
        $stmt->close();
        $conn->close();

        /* https://api.telegram.org/botXXXXXXXXXXXXXXXXXXXXXXX/getUpdates,
        где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        $token = "1772008932:AAHZak7CcBBi6IpGfd4DtvfpRbp_zwsnvk8";
        $chat_id = "-543378880";
        $arr = array(
            'Имя пользователя: ' => $name,
            'Телефон: ' => $phone,
            'Email: ' => $email,
            'Комментарий: ' => $comment
        );

        $txt = "";
        foreach($arr as $key => $value) {
            $txt .= "<b>".$key."</b> ".$value."%0A";
        };

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

        if ($sendToTelegram) {
            echo '<script>alert("Заявка успешно отправлена!")</script>'; 
        } else {
            echo '<script>alert("Упс, что-то пошло не так... Ошибочка!")</script>'; 
        }

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