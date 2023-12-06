<?php
include '../../config/class.php';
$pluem = new classweb_bypluem;
if(empty($_POST['username'] and $_POST['password'] and $_POST['password_cm'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
}elseif($_POST['password'] != $_POST['password_cm']){
    echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกรหัสให้ตรงกัน"));
}else{
    $register = $pluem->register($_POST['username'],$_POST['password']);
}
?>