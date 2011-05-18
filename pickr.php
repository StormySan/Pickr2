<?php

if (empty($_GET['x']) && empty($_GET['y'])) {
    exit;
}

// add path to image here
// eg: dirname(__FILE__) . '/../images/image.jpg';
$pickr = dirname(__FILE__) . '/lightning-tree.jpg';

if (!empty($pickr)) {
    $type = exif_imagetype($pickr);
    if ($type === IMAGETYPE_GIF) {
        $image = imagecreatefromgif($pickr);
    }
    elseif ($type === IMAGETYPE_JPEG) {
        $image = imagecreatefromjpeg($pickr);
    }
    elseif ($type === IMAGETYPE_PNG) {
        $image = imagecreatefrompng($pickr);
    }
    if (empty($image)) {
        exit;
    }

    // taken from mac_doggie at hotmail dot com http://www.php.net/manual/en/book.image.php#98153
    $rgb = imagecolorat($image, intval($_GET['x']), intval($_GET['y']));
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;        
    echo "#".str_repeat("0",2-strlen(dechex($r))).dechex($r).
        str_repeat("0",2-strlen(dechex($g))).dechex($g).
        str_repeat("0",2-strlen(dechex($b))).dechex($b);
}
