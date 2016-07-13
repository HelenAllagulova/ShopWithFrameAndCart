<meta charset="UTF-8">
<?php
    require_once ('admin_class.php');
    $adm = new admin_class();
    $adm ->admin_exit();
    echo ($adm->admin_enter());
?>
<form method="post" action="admin_photo.php">
    <button>Загрузить картинки и комментарии на проверку</button>
</form>
