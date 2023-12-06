<?php
$pluem = new classadmin_bypluem;
$show_user_id = $pluem->show_user_id($_GET['id']);
?>
<?php if(empty($_GET['id'])){ ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-2 text-center">
                            <h5>กรุณากรอกไอดี</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }elseif($_GET['id'] != $show_user_id['id']){ ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-2 text-center">
                            <h5>ไม่พบข้อมูล</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else{ ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-2">
                            <span>ชื่อผู้ใช้</span>
                            <input id="username_ed" value="<?php echo $show_user_id['username']; ?>" type="text" class="form-control" placeholder="ชื่อผู้ใช้">
                        </div>
                        <div class="mt-2">
                            <span>รหัสผ่าน</span>
                            <input id="password_ed" value="<?php echo $show_user_id['password']; ?>" type="text" class="form-control" placeholder="รหัสผ่าน">
                        </div>
                        <div class="mt-2">
                            <span>เครดิตคงเหลือ</span>
                            <input id="point_ed" value="<?php echo $show_user_id['point']; ?>" type="text" class="form-control" placeholder="เครดิตคงเหลือ">
                        </div>
                        <div class="mt-2">
                            <span>ระดับ</span>
                            <select class="custom-select" id="class_ed">
                                <option value="0" <?php if($show_user_id['class'] == "0"){ echo "selected"; } ?>>สมาชิก</option>
                                <option value="1" <?php if($show_user_id['class'] == "1"){ echo "selected"; } ?>>แอดมิน</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-success w-100" id="submit_edit_user" id_user_edit="<?php echo $show_user_id['id'] ?>" >บันทึกข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../assets/js/settings_user.js"></script>
<?php } ?>