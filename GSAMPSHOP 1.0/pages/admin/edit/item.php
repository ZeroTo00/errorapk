<?php
$pluem = new classadmin_bypluem;
$show_edit_card_other = $pluem->show_edit_card_other($_GET['id']);
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2">
                        <span>รูปภาพสินค้า</span>
                        <input type="text" class="form-control" value="<?php echo $show_edit_card_other['image']; ?>" id="edit_image_card_other" placeholder="รูปภาพสินค้า">
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-success w-100" id="submit_edit_image_card_other" id_edit_image_card_other="<?php echo $_GET['id']; ?>">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../../assets/js/settings_termgame.js"></script>