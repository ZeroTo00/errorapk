<?php
$pluem = new classweb_bypluem;
$history_shop = $pluem->history_shop();
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">ประวัติการสั่งซื้อสินค้า</h3>
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อสินค้า</th>
                                <th scope="col">สินค้าที่ได้รับ</th>
                                <th scope="col">ราคา</th>
                                <th scope="col">วันที่-เวลา</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($history_shop as $row){ ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['details']; ?></td>
                                    <td><?php echo $row['price']; ?> บาท</td>
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
