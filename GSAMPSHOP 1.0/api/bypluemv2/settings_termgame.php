<?php
include '../../config/class.php';
$pluem = new classadmin_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif($_POST['type'] == "success"){
    if(empty($_POST['id_termgame'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $termgame_success = $pluem->termgame_success($_POST['id_termgame']);
    }
}elseif($_POST['type'] == "not_success"){
    if(empty($_POST['id_termgame'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $termgame_not_success = $pluem->termgame_not_success($_POST['id_termgame']);
    }
}elseif($_POST['type'] == "add_stock_item"){
    if(empty($_POST['details'] and $_POST['price'] and $_POST['image'] and $_POST['id_stock_item'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $add_stock_item = $pluem->add_stock_item($_POST['details'],$_POST['price'],$_POST['image'],$_POST['id_stock_item']);
    }
}elseif($_POST['type'] == "del_stock_item"){
    if(empty($_POST['id_stock_item'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $del_stock_item = $pluem->del_stock_item($_POST['id_stock_item']);
    }
}elseif($_POST['type'] == "edit_stock_id"){
    if(empty($_POST['details'] and $_POST['price'] and $_POST['image'] and $_POST['id_edit_stock_id'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $edit_stock_id = $pluem->edit_stock_id($_POST['details'],$_POST['price'],$_POST['image'],$_POST['id_edit_stock_id']);
    }
}elseif($_POST['type'] == "del_card_other"){
    if(empty($_POST['id_card_other'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $del_card_other = $pluem->del_card_other($_POST['id_card_other']);
    }
}elseif($_POST['type'] == "add_card_other"){
    if(empty($_POST['image'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $add_card_other = $pluem->add_card_other($_POST['image']);
    }
}elseif($_POST['type'] == "edit_image_card_other"){
    if(empty($_POST['image'] and $_POST['id'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $edit_image_card_other = $pluem->edit_image_card_other($_POST['image'],$_POST['id']);
    }
}
?>