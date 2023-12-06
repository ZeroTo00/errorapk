<?php
include '../../config/class.php';
$pluem = new classadmin_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif($_POST['type'] == "del_product"){
    if(empty($_POST['id_product'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $del_product = $pluem->del_product($_POST['id_product']);
    }
}elseif($_POST['type'] == "add_product"){
    if(empty($_POST['name_product'] and $_POST['image_product'] and $_POST['price_product'] and $_POST['details_product'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $add_product = $pluem->add_product($_POST['name_product'],$_POST['image_product'],$_POST['price_product'],$_POST['details_product']);
    }
}elseif($_POST['type'] == "edit_product"){
    if(empty($_POST['name_ed'] and $_POST['image_ed'] and $_POST['price_ed'] and $_POST['details_ed']and $_POST['id_ed'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $edit_product = $pluem->edit_product($_POST['name_ed'],$_POST['image_ed'],$_POST['price_ed'],$_POST['details_ed'],$_POST['id_ed']);
    }
}
?>