<?php
function image_resize(
    $source_path,
    $destination_path,
    $newwidth,
    $newheight = FALSE,
    $quality = FALSE // качество для формата jpeg
    ) {
    ini_set("gd.jpeg_ignore_warning", 1); // иначе на некотоых jpeg-файлах не работает
    list($oldwidth, $oldheight, $type) = getimagesize($source_path);
    switch ($type) {
        case IMAGETYPE_JPEG: $typestr = 'JPEG'; break;
        case IMAGETYPE_GIF: $typestr = 'GIF' ;break;
        case IMAGETYPE_PNG: $typestr = 'PNG'; break;
    }
    $function = "imagecreatefrom$typestr";
    $src_resource = $function($source_path);
   
    if (!$newheight) { $newheight = round($newwidth * $oldheight/$oldwidth); }
    elseif (!$newwidth) { $newwidth = round($newheight * $oldwidth/$oldheight); }
    $destination_resource = imagecreatetruecolor($newwidth,$newheight);
   
    imagecopyresampled($destination_resource, $src_resource, 0, 0, 0, 0, $newwidth, $newheight, $oldwidth, $oldheight);
   
    if ($type = 2) { # jpeg
        imageinterlace($destination_resource, 1); // чересстрочное формирование изображение
        imagejpeg($destination_resource, $destination_path, $quality);     
    }
    else { # gif, png
        $function = "image$typestr";
        $function($destination_resource, $destination_path);
    }
   
    imagedestroy($destination_resource);
    imagedestroy($src_resource);
};

function showPicture (){
    global $dir;
    global $dirMini;
    global $aListExtPicture;
    $aFiles = scandir($dir);
    foreach ($aFiles as $itemFile) {
        $aFile = explode(".", $itemFile);
        $nameFileExt = strtoupper($aFile[1]);
        if (in_array($nameFileExt, $aListExtPicture)) {
            if (!file_exists($dirMini . $itemFile)){  // На случай, если сжатое изображение "потерялось"
            image_resize($dir.'/'.$itemFile, $dirMini.'/'.$itemFile, 100,100,100);
            }
            $ref = $dir.'/'.$itemFile;
            $showImage = '<div class=refPicture>';
            $showImage = $showImage . '<a target="_blank" href=' . $ref . '>';
            $showImage = $showImage .  '<img src="'. $dirMini . '/' . $itemFile . '" vspace="1" hspace="1">';
            $showImage = $showImage .  '</a>';
            $showImage = $showImage .  '</div>';
            echo $showImage;
        };
    };
}
?>

