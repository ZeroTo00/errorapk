<?php
$pluem = new classadmin_bypluem;
$history_termgame = $pluem->history_termgame();
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อผู้ใช้</th>
                                <th scope="col">ชื่อผู้ใช้ในเกม</th>
                                <th scope="col">รหัสผ่านในเกม</th>
                                <th scope="col">รายละเอียดสินค้า</th>
                                <th scope="col">ราคา</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">วันที่-เวลา</th>
                                <th scope="col">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($history_termgame as $row){ ?>
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['username_tm']; ?></td>
                                    <td><?php echo $row['password_tm']; ?></td>
                                    <td><?php echo $row['details']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php if($row['status'] == "0"){ echo "<span class='text-warning'>กำลังทำรายการ</span>"; }elseif($row['status'] == "1"){ echo "<span class='text-success'>ทำรายการสำเร็จ</span>"; }elseif($row['status'] == "2"){ echo "<span class='text-danger'>เกิดข้อผิดพาด กรุณาติดต่อแอดมิน</span>"; } ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success mt-2 submit_success" id_termgame="<?php echo $row['id']; ?>">สำเร็จ</button>
                                        <button type="button" class="btn btn-danger mt-2 submit_not_success" id_termgame="<?php echo $row['id']; ?>">ไม่สำเร็จ</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../../assets/js/settings_termgame.js"></script>