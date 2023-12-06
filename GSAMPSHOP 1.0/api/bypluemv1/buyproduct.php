<?php
include '../../config/class.php';
$pluem = new classweb_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif(empty($_POST['id_product'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
}else{
    $buyproduct = $pluem->buyproduct($_POST['id_product']);
}
?>