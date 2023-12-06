<?php
$pluem = new classadmin_bypluem;
$show_code = $pluem->show_code();
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2">
                        <span>รหัสโค๊ด</span>
                        <input type="text" class="form-control" id="add_code" placeholder="กรุณากรอกโค๊ด เช่น Test123">
                    </div>
                    <div class="mt-2">
                        <span>จำนวนเงินที่ได้</span>
                        <input type="text" class="form-control" id="add_point" placeholder="กรุณากรอกจำนวนเงินที่ได้ เช่น 100">
                    </div>
                    <div class="mt-2">
                        <span>จำนวนครั้งที่ใช้ได้</span>
                        <input type="text" class="form-control" id="add_amount" placeholder="กรุณากรอกจำนวนครั้งที่ใช้ได้ เช่น 100">
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-success w-100" id="submit_add_code" type="button">เพิ่มโค๊ด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ไอดี</th>
                                <th>โค๊ด</th>
                                <th>จำนวนเงินที่ได้</th>
                                <th>คงเหลือ</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($show_code as $row){ ?>
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['code']; ?></td>
                                    <td><?php echo $row['point']; ?> เครดิต</td>
                                    <td><?php echo $row['amount']; ?> ครั้ง</td>
                                    <td><button class="btn btn-danger del_code" id_code="<?php echo $row['id']; ?>" name_code="<?php echo $row['code'] ?>">ลบ</button></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../../assets/js/code.js"></script>