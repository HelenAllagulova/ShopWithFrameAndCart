<meta charset="UTF-8">
<?php
function ShowAllImage( $path, $baza_comments ) {
  global $arrImages;

    $pathImage = opendir($path);
    $text = '<ol>';
    $fl = 0;
    while ( $file = readdir($pathImage) ) {
        if ( $file == '..' || $file == '.' )
            continue;
        elseif (filetype($path . '/' . $file) == 'dir')
            $text .= $file  . '><br>' . ShowAllImage( $path . '/' . $file,$baza_comments );
        else {
            $fullName = trim("$path/$file");
            $check_baza="<img src='{$fullName}'>";
            $com_vivod='';
            foreach ($baza_comments as $row){
                $comment=explode(';',$row);
                if (!isset($comment[5])) continue;
                $pos=strstr($comment[5],$check_baza);
                if($pos!==false){
                    $com_vivod=$comment[3];
                    $idForTextAreaAndCheckBox = $comment[0];
                }
            }
            //$isChecked = in_array($fullName, $arrImages) ? 'checked' : '';
            foreach($arrImages as $value)
            {
              if (strstr($value, $fullName))
              {
                  $isChecked = 'checked';
                  break;
              }
              else
              {
                  $isChecked = '';
              }
            }
            if ($fl == 0)
            {
                $text .= "<br> User comment: <br>
                    <input type='text' hidden form='fSavePerm' name='forId[]'  value='{$idForTextAreaAndCheckBox}'>
                    <textarea form='fSavePerm' name='comment[]'>$com_vivod</textarea><br>"; $fl = 1;
            }
                $text .= "<div> $file 
                    <input type='checkbox'  $isChecked  form='fSavePerm' name='{$idForTextAreaAndCheckBox}[]' value='$fullName'/>
                    <li> $fullName</li> 
                    <img src='$fullName' width='50px' /></div><br>";

        }
    }
    
    return $text.'</ol>';
}
    session_start();
    if ( !isset($_SESSION['login']) ) {
         echo 'not login';
         exit(-1);
    }         

    include_once '../otziv/const.php';
    $arrImages = file('true_image.txt') ? : array();

?>
  <form method="post" action="save_permission.php" id="fSavePerm">
      <button value="submit"> Сохранить изменения! </button>
  </form>
<?php
    
    $baza_comments=fileToArray(FILENAME);

    echo ShowAllImage( '../../data/images_for_comments',$baza_comments );

    echo '<br><b> Коментарии без картинок</b><br>';
    for($i=0; $i<count($baza_comments)-1;$i++ ){
        $stroka=explode(';',$baza_comments[$i]);

        if($stroka[5]==='')
        {
            echo '<div> User '.$stroka[2].' comment from data: 
            <li>'.FILENAME.'</li> to the item - '.$stroka[1].'<br> 
            <input type="checkbox" form="fSavePerm">
            <input type="text" hidden form="fSavePerm" name="forId[]" value='.$stroka[0].'>
            <textarea form="fSavePerm" name="comment[]">'.$stroka[3].'</textarea></div>';
        }
    }




