<?php
include '../../config/class.php';
$pluem = new classweb_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif(empty($_POST['old_password'] and $_POST['new_password'] and $_POST['new_password_cm'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
}elseif($_POST['new_password'] != $_POST['new_password_cm']){
    echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกรหัสให้ตรงกัน"));
}else{
    $passsword = $pluem->password($_POST['old_password'],$_POST['new_password']);
}
?>