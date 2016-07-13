<meta charset="UTF-8">
<?php


    require_once 'admin_class.php';
    require_once '../db_config.php';
    $adm = new admin_class();

    if ( !isset($_SESSION['login']) ) {
         echo 'not login';
         exit(-1);
    }         

    include_once '../otziv/const.php';
    $arrImages = file('true_image.txt') ? : array();

?>
    <form method="post" action="exit.php" id="exit">
        <button value="submit" form="exit">Выйти</button>
    </form>
      <form method="post" action="save_permission.php" id="fSavePerm">
          <button value="submit" form="fSavePerm"> Сохранить изменения! </button>
<?php
    $baza_comments=fileToArray(FILENAME);
    echo $adm->ShowAllImage( '../../data/images_for_comments',$baza_comments );
    
    echo '<br><b> Коментарии без картинок</b><br>';
    $adm->commentFromFileWithoutIMG($baza_comments);

    echo '<br><b> Коментарии из БД</b><br>';
    $adm->connectDB($db_hostname,$db_username,$db_password,$db_database);
    $adm->commentFromDB();
?>
      </form>



