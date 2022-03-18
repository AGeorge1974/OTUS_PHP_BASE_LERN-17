<?php
  include_once('functions.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson-17</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Галлерея картинок.</h1>
  <div class="container">
  <div class="row align-items-center">
  <?php
    $aListExtPicture = array('JPG', 'PNG', 'GIF');
    $dir    = 'IMG/';
    $dirMini    = 'IMG_MINI/';
    $aFiles = scandir($dir);
    foreach ($aFiles as $itemFile) {
      $aFile = explode(".", $itemFile);
      $nameFileExt = strtoupper($aFile[1]);
      if (in_array($nameFileExt, $aListExtPicture)) {
        $ref = $dir.'/'.$itemFile;
        image_resize($dir.'/'.$itemFile, $dirMini.'/'.$itemFile, 100,100,100);
        echo '<div class=refPicture>';
        echo '<a target="_blank" href=' . $ref . '>';
        echo '<img src="'. $dirMini . '/' . $itemFile . '" vspace="1" hspace="1">';
        echo '</a>';
        echo '</div>';
      };
    };
    if  (isset ($_POST['send'])){
      if(!empty($_FILES['photo'])) {
          $name = basename($_FILES["photo"]['name']);
          $ext = strtoupper(pathinfo($name,PATHINFO_EXTENSION));
          $newName = pathinfo($name,PATHINFO_FILENAME) . date('_Ymd');
          if(!in_array($ext,$aListExtPicture)) // Отбросим все файлы - не картинки
            echo "Не картинка";
            return;
          move_uploaded_file($_FILES["photo"]['tmp_name'], "IMG/$newName".".".$ext);
      };
    };
  ?>
  </div>
  </div>
  <form action="/" method="POST" enctype="multipart/form-data">
    <input type="file" name="photo"><br>
    <input type="submit" name='send' value="Отправить">
  </form>


</body>
</html>


