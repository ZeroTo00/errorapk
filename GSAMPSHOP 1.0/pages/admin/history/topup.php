<?php
$pluem = new classadmin_bypluem;
$history_topup = $pluem->history_topup();
?>
<div class="container mt-3 text-center">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อผู้ใช้</th>
                                <th scope="col">ชื่อบัญชี</th>
                                <th scope="col">จำนวนเงิน</th>
                                <th scope="col">ลิงค์</th>
                                <th scope="col">วันที่-เวลา</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($history_topup as $row){ ?>
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['amount']; ?></td>
                                    <td><?php echo $row['link']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>