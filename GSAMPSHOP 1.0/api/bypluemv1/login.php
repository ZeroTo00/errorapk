<?php
include '../../config/class.php';
$pluem = new classweb_bypluem;
if(empty($_POST['username'] and $_POST['password'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
}else{
    $login = $pluem->login($_POST['username'],$_POST['password']);
}
?>