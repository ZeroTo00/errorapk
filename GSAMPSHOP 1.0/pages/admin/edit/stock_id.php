<?php
$pluem = new classadmin_bypluem;
$show_edit_stock_id = $pluem->show_edit_stock_id($_GET['id']);
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2">
                        <span>รายละเอียดสินค้า</span>
                        <input type="text" class="form-control" id="edit_stock_id_details" value="<?php echo $show_edit_stock_id['details']; ?>" placeholder="รายละเอียดสินค้า">
                    </div>
                    <div class="mt-2">
                        <span>ราคาสินค้า</span>
                        <input type="text" class="form-control" id="edit_stock_id_price" value="<?php echo $show_edit_stock_id['price']; ?>" placeholder="ราคาสินค้า">
                    </div>
                    <div class="mt-2">
                        <span>รูปภาพสินค้า</span>
                        <input type="text" class="form-control" id="edit_stock_id_image" value="<?php echo $show_edit_stock_id['image']; ?>" placeholder="รูปภาพสินค้า">
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-success w-100" id="submit_edit_stock_id" id_edit_stock_id="<?php echo $_GET['id']; ?>">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../../../assets/js/settings_termgame.js"></script>