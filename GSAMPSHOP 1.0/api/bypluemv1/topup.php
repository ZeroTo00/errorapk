<?php
include '../../config/class.php';
$pluem = new classweb_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif(empty($_POST['link_topup'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกข้อมูลให้ครบ"));
}elseif ($_POST['link_topup'][0] !== "h") {
    echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกอั่งเปาให้ถูกต้อง"));
}else{
    $string = "https://gift.truemoney.com/campaign/?v=";
	$voucher = $_POST['link_topup'];
	$link_topup = explode("?v=", $voucher)[1];
    if(empty($link_topup)){
        echo json_encode(array('status'=>"error",'message'=>"กรุณากรอกอั่งเปาให้ถูกต้อง"));
    }else{
        $topup = $pluem->topup($link_topup);
    }
}
?>