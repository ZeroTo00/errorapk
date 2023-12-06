<?php
$pluem = new classadmin_bypluem;
$show_web_config = $pluem->show_web_config();
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2">
                        <span>ชื่อเว็บไซต์</span>
                        <input type="text" class="form-control" id="set_title" value="<?php echo $show_web_config['title']; ?>" placeholder="ชื่อเว็บไซต์">
                    </div>
                    <div class="mt-2">
                        <span>โลโก้เว็บไซต์</span>
                        <input type="text" class="form-control" id="set_logo" value="<?php echo $show_web_config['logo']; ?>" placeholder="โลโก้เว็บไซต์">
                    </div>
                    <div class="mt-2">
                        <span>เบอร์รับเงิน</span>
                        <input type="text" class="form-control" id="set_phone" value="<?php echo $show_web_config['phone']; ?>" placeholder="เบอร์รับเงิน">
                    </div>
                    <div class="mt-2">
                        <span>ติดต่อแอดมิน</span>
                        <input type="text" class="form-control" id="set_contact" value="<?php echo $show_web_config['contact']; ?>" placeholder="ติดต่อแอดมิน">
                    </div>
                    <div class="mt-2">
                        <span>รูปสไลด์1</span>
                        <input type="text" class="form-control" id="set_image1" value="<?php echo $show_web_config['image1']; ?>" placeholder="รูปสไลด์1">
                    </div>
                    <div class="mt-2">
                        <span>รูปสไลด์2</span>
                        <input type="text" class="form-control" id="set_image2" value="<?php echo $show_web_config['image2']; ?>" placeholder="รูปสไลด์2">
                    </div>
                    <div class="mt-2">
                        <span>รูปสไลด์3</span>
                        <input type="text" class="form-control" id="set_image3" value="<?php echo $show_web_config['image3']; ?>" placeholder="รูปสไลด์3">
                    </div>
                    <div class="mt-2">
                        <span>ประกาศ</span>
                        <input type="text" class="form-control" id="set_news" value="<?php echo $show_web_config['news']; ?>" placeholder="ประกาศ">
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-success w-100" id="submit_set_web">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../../assets/js/settings_web.js"></script>