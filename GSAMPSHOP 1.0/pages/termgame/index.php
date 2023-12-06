<?php
$pluem = new classweb_bypluem;
$resultuser = $pluem->resultuser();
$id_card_other = $_GET['id'];
$show_stock_item = $pluem->show_stock_item($id_card_other);
$history_termgame = $pluem->history_termgame();
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-sm-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <h3>บริการเติมแบบ ID +PASS</h3>
                    <div class="mt-2">
                        <span>ชื่อผู้ใช้ในเกม</span>
                        <input class="form-control" id="username_tm" placeholder="ชื่อผู้ใช้ในเกม">
                    </div>
                    <div class="mt-2">
                        <span>รหัสผ่านในเกม</span>
                        <input class="form-control" id="password_tm" placeholder="รหัสผ่านในเกม">
                    </div>
                    <div class="mt-2">
                        <p class="text-center">( จำนวนเงินคงเหลือ <span class="text-success"><?php echo $resultuser['point']; ?></span> บาท )</p>
                    </div>
                    <div class="mt-2">
                        <p class="text-center"><span class="text-danger">**อย่าลืมทำเมลแดง+ปลดพิน**</span></p>
                    </div>
                    <div class="mt-2 text-center">
                        <h3>เช็คคิว ID+PASS</h3>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">รายละเอียด</th>
                                <th scope="col">ราคา</th>
                                <th scope="col">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($history_termgame as $row){ ?>
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><span class="text-primary"><?php echo $row['details']; ?></span></td>
                                    <td><span class="text-info"><?php echo $row['price']; ?> บาท</span></td>
                                    <td><?php if($row['status'] == "0"){ echo "<span class='text-warning'>กำลังทำรายการ</span>"; }elseif($row['status'] == "1"){ echo "<span class='text-success'>ทำรายการสำเร็จ</span>"; }elseif($row['status'] == "2"){ echo "<span class='text-danger'>เกิดข้อผิดพาด กรุณาติดต่อแอดมิน</span>"; } ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-8 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php if(empty($id_card_other)){ ?>
                            <div class="col-12 text-center">
                                <h3>ไม่พบสินค้านี้</h3>
                            </div>
                        <?php }else{ ?>
                            <?php if(empty($show_stock_item)){ ?>
                                <div class="col-12 text-center">
                                    <h3>ยังไม่มีสินค้า</h3>
                                </div>
                            <?php }else{ ?>
                                <?php foreach($show_stock_item as $row){ ?>
                                    <div class="col-sm-4 mt-2">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <img src="<?php echo $row['image']; ?>" class="mb-3" width="50%">
                                                <h4 class="text-primary"><?php echo $row['details']; ?></h4>
                                                <button type="button" class="btn btn-success w-100 submit_termgame" id_item="<?php echo $row['id']; ?>" name_item="<?php echo $row['details']; ?>">ซื้อ (<?php echo $row['price']; ?> บาท)</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../assets/js/termgame.js"></script>