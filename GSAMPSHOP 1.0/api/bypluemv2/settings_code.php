<?php
include '../../config/class.php';
$pluem = new classadmin_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif($_POST['type'] == "add_code"){
    if(empty($_POST['add_code'] and $_POST['add_point'] and $_POST['add_amount'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $add_code = $pluem->add_code($_POST['add_code'],$_POST['add_point'],$_POST['add_amount']);
    }
}elseif($_POST['type'] == "del_code"){
    if(empty($_POST['id_code'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $del_code = $pluem->del_code($_POST['id_code']);
    }
}
?>