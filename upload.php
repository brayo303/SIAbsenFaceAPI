<?php
namespace controllers;

require_once "api.php";
require_once "controller.php";


$filename = 'pic_'.date('YmdHis') . '.jpeg';


if( move_uploaded_file($_FILES['webcam']['tmp_name'],'upload/'.$filename) ){
   $url = 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/upload/' . $filename;
}

$api = new API();
$con = new Controller();

$arrhasil=$api->detectFace($url);

//var_dump($arrhasil);
if($arrhasil==true){
	$maha = $con->searchMahasiswaByNama($arrhasil['name']);

	$con->insertAbsen($arrhasil['confidence'],1,$maha['id'],0);
	//var_dump($maha);

	$hasil = array('status'=>1,'name'=>$maha['nama'],'urlfoto'=>$maha['urlPhoto']);
}else{
	$hasil = array('status'=>0);
}
echo json_encode($hasil);

?>