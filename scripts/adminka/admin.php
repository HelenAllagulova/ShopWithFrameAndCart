<meta charset="UTF-8">
<?php
    
    session_start();

    if ( !isset($_POST['login']) || !isset($_POST['password']) ) {
       echo 'Недостаточно параметров';
       exit(-1); 
    }


    if ($_SESSION['login'])
        unset($_SESSION['login']); 
    
    $str = file_get_contents('secret.txt');

    $arrAdmin = explode(';', $str);

    if( $arrAdmin[0] == $_POST['login'] && $arrAdmin[1] == $_POST['password'] ) {
        
        $_SESSION['login'] = $_POST['login'];
        echo 'Успешная авторизация <br>';
    }
    else
        echo 'Неверное значение имени и пароля!';
?>
<form method="post", action="admin_photo.php">
    <button>Загрузить картинки и комментарии на проверку</button>
</form>
