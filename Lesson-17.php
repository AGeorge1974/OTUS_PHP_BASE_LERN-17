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
  <h1>Галлерея поздравительных открыток</h1>
  <div class="container">
  <div class="row align-items-center">
  <?php
          $aListExtPicture = array('JPG', 'BMP', 'SVG', 'PSD','PNG', 'GIF', 'ICO','TIFF','WEBP');
          $dir    = 'IMG/';
          $aFiles = scandir($dir);
          foreach ($aFiles as $itemFile) {
            $aFile = explode(".", $itemFile);
            $nameFileExt = strtoupper($aFile[1]);
            if (in_array($nameFileExt, $aListExtPicture)) {
              $ref = $dir.'/'.$itemFile;
              echo '<div class=refPicture>';
              echo '<a target="_blank" href=' . $ref . '>';
              echo '<img src="'. $dir . '/' . $itemFile . '" height="200" width="200" vspace="5" hspace="5">';
              echo '</a>';
              echo '</div>';
            };
          };
    ?>
  </div>
  </div>
</body>
</html>


