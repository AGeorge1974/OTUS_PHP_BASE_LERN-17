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
    showPicture();
    echo 1;
    if  (isset ($_POST['send'])){
      echo 2;
      if(!empty($_FILES['photo'])) {
        echo 3;
          $name = basename($_FILES["photo"]['name']);
          $ext = strtoupper(pathinfo($name,PATHINFO_EXTENSION));
          $newName = pathinfo($name,PATHINFO_FILENAME) . date('_Ymd');
          if(!in_array($ext,$aListExtPicture)) // Отбросим все файлы - не картинки
            echo "Не картинка";
            echo 4;
            return;
            echo 5;
          move_uploaded_file($_FILES["photo"]['tmp_name'], $dir . "$newName".".".$ext);
          echo $_FILES["photo"]['tmp_name'] . "<br>";
          echo $_FILES["photo"]['tmp_name'] . $dir . "$newName".".".$ext;
          image_resize($dir . $newFile, $dirMini . $itemFile, 100,100,100);
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


