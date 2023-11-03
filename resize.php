<?php
header('Content-Type: image/png');
if (isset($_GET['image'])) {
    $img = file_get_contents($_GET['image']);

    // new width and height
    $w = 50;
    $h = 50;
    $crop = FALSE;

    $file = imagecreatefromstring($img);
    $width = imagesx($file);
    $height = imagesy($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width - ($width * abs($r - $w / $h)));
        } else {
            $height = ceil($height - ($height * abs($r - $w / $h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w / $h > $r) {
            $newwidth = $h * $r;
            $newheight = $h;
        } else {
            $newheight = $w / $r;
            $newwidth = $w;
        }
    }

    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresized($dst, $file, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    imagepng($dst);
    imagedestroy($dst);
}
?>