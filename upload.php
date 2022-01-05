<?php

// new filename
$filename = 'pic_'.date('YmdHis') . '.jpeg';


if( move_uploaded_file($_FILES['webcam']['tmp_name'],'upload/'.$filename) ){
   $url = 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/upload/' . $filename;
}


//$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/upload/';
echo $url;

?>