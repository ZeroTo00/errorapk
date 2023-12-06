<?php
$pluem = new classweb_bypluem;
$resultuser = $pluem->resultuser();
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-sm-5 text-center">
            <div class="card">
                <div class="card-body">
                    <img src="https://hypeshop.store/assets/img/f906f0e8c4ca476b9bafa56577e97f78_logo.png" width="99px" class="rounded-circle">
                    <div class="mt-2">
                        <h6 class="text-secondary">Username</h6>
                        <h5><?php echo $_SESSION['username']; ?></h5>
                    </div>
                    <div class="mt-2">
                        <h6 class="text-secondary">Point คงเหลือ</h6>
                        <h5><?php echo $resultuser['point']; ?> Points</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center"><i class="fas fa-key"></i> เปลี่ยนรหัสผ่าน</h5>
                    <div class="mt-3">
                        <span>รหัสผ่านเก่า</span>
                        <input type="password" class="form-control" placeholder="รหัสผ่านเก่า" id="old_password">
                    </div>
                    <div class="mt-3">
                        <span>รหัสผ่านใหม่</span>
                        <input type="password" class="form-control" placeholder="รหัสผ่านใหม่" id="new_password">
                    </div>
                    <div class="mt-3">
                        <span>ยืนยันรหัสผ่านใหม่</span>
                        <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่านใหม่" id="new_password_cm">
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary w-100" id="submit_password"><i class="fas fa-key"></i> เปลี่ยนรหัสผ่าน</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../assets/js/password.js"></script>