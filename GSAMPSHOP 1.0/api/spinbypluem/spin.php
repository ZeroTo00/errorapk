<?php
include '../../config/class.php';
$pluem = new classweb_bypluem;
if(empty($_SESSION['id'])){
    echo json_encode(array('status'=>"error",'message'=>"กรุณาเข้าสู่ระบบ"));
}elseif($_GET['game'] != "spin"){

}else{
    $spin = $pluem->gamespin();
}
?>