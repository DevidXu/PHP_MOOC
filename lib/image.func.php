<?php
/**
 * Created by PhpStorm.
 * User: 86937
 * Date: 2019/1/7
 * Time: 15:48
 */
require_once "string.func.php";

function buildVerifyImage($sess_name = "verify", $type = 4, $len = 4, $pixel = true, $line = true)
{
    $width = 100;
    $height = 40;

    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);

    imagefilledrectangle($image, 1, 1, $width - 2, $height - 2, $white);
    $chars = buildRandomString($type, $len);
    $sess_name = "verify";
    $_SESSION[$sess_name] = $chars;

    $fontfiles = array("FZYTK.TTF", "simhei.ttf", "STXINGKA.TTF");
    for ($i=0;$i<$len;$i++) {
        $size = mt_rand(18, 22);
        $angle = mt_rand(-15, 15);
        $x = 10 + $i*$size;
        $y = mt_rand(20, 30);
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(40, 250), mt_rand(100, 200));
        $fontfile = "E:/Server/eShop/fonts/" . $fontfiles[mt_rand(0, count($fontfiles)-1)];
        $text = substr($chars, $i, 1);
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    }

    if ($pixel) {
        for ($i = 0; $i < 20; $i++) {
            imagesetpixel($image, mt_rand(0, $width), mt_rand(0, $height), $black);
        }
    }
    if ($line) {
        for ($i = 0; $i < 5; $i++) {
            $lineColor = imagecolorallocate($image, mt_rand(50, 90), mt_rand(40, 250), mt_rand(100, 200));
            imageline($image, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), $lineColor);
        }
    }

    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);
}


function resizeImage($fileName, $destination = null, $dst_w = null, $dst_h = null, $scale = 0.5, $isReservedSource = true) {

    list($src_w, $src_h, $imagetype) = getimagesize($fileName);
    $mime = image_type_to_mime_type($imagetype);
    $createFun = str_replace("/", "createfrom", $mime);
    $outFun=str_replace("/", null, $mime);
    $src_image = $createFun($fileName);

    if (!$dst_w) $dst_w = $src_w*$scale;
    if (!$dst_h) $dst_h = $src_h*$scale;

    $dst_image = imagecreatetruecolor($dst_w, $dst_h);
    imagecopyresampled($dst_image, $src_image, 0,0,0,0,$dst_w, $dst_h, $src_w, $src_h);

    if ($destination and !file_exists(dirname($destination))) {
        mkdir(dirname($destination), 0777, true);
    }

    $dstFileName = $destination==null? getUniName().".".getExt($fileName): $destination;
    $outFun($dst_image, $dstFileName);

    imagedestroy($src_image);
    imagedestroy($dst_image);
    if (!$isReservedSource) {
        unlink($fileName);
    }
    return $dstFileName;
}


?>