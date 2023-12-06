<?php
include '../../config/class.php';
$pluem = new classweb_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif(empty($_POST['id_item'] and $_POST['username_tm'] and $_POST['password_tm'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
}else{
    $termgame = $pluem->termgame($_POST['id_item'],$_POST['username_tm'],$_POST['password_tm']);
}
?>