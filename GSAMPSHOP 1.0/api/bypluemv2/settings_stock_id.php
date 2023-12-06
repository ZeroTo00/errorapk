<?php
include '../../config/class.php';
$pluem = new classadmin_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif($_POST['type'] == "del_stock_id"){
    if(empty($_POST['id_stock'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $del_stock_id = $pluem->del_stock_id($_POST['id_stock']);
    }
}elseif($_POST['type'] == "add_stock_id"){
    if(empty($_POST['details'] and $_POST['idproduct'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $add_stock_id = $pluem->add_stock_id($_POST['details'],$_POST['idproduct']);
    }
}
?>