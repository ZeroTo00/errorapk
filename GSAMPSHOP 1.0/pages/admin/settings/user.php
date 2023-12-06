<?php
$pluem = new classadmin_bypluem;
$show_userAll = $pluem->show_userAll();
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
                            <th scope="col">รหัสผ่าน</th>
                            <th scope="col">เครดิต</th>
                            <th scope="col">ระดับ</th>
                            <th scope="col">สมัครสมาชิกเมื่อ</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($show_userAll as $row){ ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td><?php echo $row['point']; ?></td>
                                <td><?php if($row['class'] == "0"){ echo "สมาชิก"; }elseif($row['class'] == "1"){ echo "แอดมิน"; } ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td>
                                    <a href="edit_user?id=<?php echo $row['id']; ?>" class="btn btn-success">แก้ไข</a>
                                    <button type="button" id_user="<?php echo $row['id']; ?>" name_user="<?php echo $row['username']; ?>" class="btn btn-danger del_user">ลบ</button>
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
<script src="../../../assets/js/settings_user.js"></script>