<?php
require_once "api.php";
require_once "controller.php";


$filename = 'pic_'.date('YmdHis') . '.jpeg';


if( move_uploaded_file($_FILES['webcam']['tmp_name'],'upload/'.$filename) ){
   $url = 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/upload/' . $filename;
}

$api = new API();
echo $url;




?>