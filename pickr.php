<?php

$int_filter = array(
    'filter'  => FILTER_VALIDATE_INT,
    'flags'   => FILTER_NULL_ON_FAILURE,
    'options' => array('min_range' => 0),
);
$point = filter_input_array(INPUT_GET, array(
    'x' => $int_filter,
    'y' => $int_filter,
));

if ($point === NULL || in_array(NULL, $point, TRUE)) {
    // Invalid args
    exit;
}

// add path to image here
// eg: dirname(__FILE__) . '/../images/image.jpg';
$pickr = dirname(__FILE__) . '/lightning-tree.jpg';

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

if (empty($image) || $point['x'] > imagesx($image) || $point['y'] > imagesy($image)) {
    // Image not loaded, or coords out of bounds
    exit;
}

$rgb = imagecolorat($image, $point['x'], $point['y']);
printf("#%06X", $rgb);

