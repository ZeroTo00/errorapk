<?php
include '../../config/class.php';
$pluem = new classadmin_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif($_POST['type'] == "del_user"){
    if(empty($_POST['id_user'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $del_user = $pluem->del_user($_POST['id_user']);
    }
}elseif($_POST['type'] == "edit_user"){
    if(empty($_POST['id_user_edit'] and $_POST['username_ed'] and $_POST['password_ed'] and $_POST['point_ed'])){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
    }else{
        $edit_user = $pluem->edit_user($_POST['id_user_edit'],$_POST['username_ed'],$_POST['password_ed'],$_POST['point_ed'],$_POST['class_ed']);
    }
}
?>