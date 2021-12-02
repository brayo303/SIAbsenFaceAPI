<?php

// new filename
$filename = 'pic_' . date('YmdHis') . '.jpeg';

$url = '';
if (move_uploaded_file($_FILES['webcam']['tmp_name'], 'upload/' . $filename)) {
    $url = 'localhost/' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['lbw_project/image']) . '/upload/' . $filename;
}

// Return image url
echo $url;
