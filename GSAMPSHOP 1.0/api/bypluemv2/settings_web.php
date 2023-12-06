<?php
include '../../config/class.php';
$pluem = new classadmin_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif(empty($_POST['set_title'] and $_POST['set_logo'] and $_POST['set_phone'] and $_POST['set_contact'] and $_POST['set_image1'] and $_POST['set_image2'] and $_POST['set_image3'] and $_POST['set_news'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
}else{
    $settings_web = $pluem->settings_web($_POST['set_title'],$_POST['set_logo'],$_POST['set_phone'],$_POST['set_contact'],$_POST['set_image1'],$_POST['set_image2'],$_POST['set_image3'],$_POST['set_news']);
}
?>