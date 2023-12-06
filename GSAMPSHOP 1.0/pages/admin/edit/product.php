<?php
$pluem = new classadmin_bypluem;
$show_product_id = $pluem->show_product_id($_GET['id']);
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
<?php }elseif($_GET['id'] != $show_product_id['id']){ ?>
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
                            <span>ชื่อสินค้า</span>
                            <input id="name_ed" value="<?php echo $show_product_id['name']; ?>" type="text" class="form-control" placeholder="ชื่อสินค้า">
                        </div>
                        <div class="mt-2">
                            <span>รูปภาพสินค้า</span>
                            <input id="image_ed" value="<?php echo $show_product_id['image']; ?>" type="text" class="form-control" placeholder="รูปภาพสินค้า">
                        </div>
                        <div class="mt-2">
                            <span>ราคาสินค้า</span>
                            <input id="price_ed" value="<?php echo $show_product_id['price']; ?>" type="text" class="form-control" placeholder="ราคาสินค้า">
                        </div>
                        <div class="mt-2">
                            <span>รายละเอียดสินค้า</span>
                            <textarea id="details_ed" placeholder="รายละเอียดสินค้า" class="form-control text-input-none1"><?php echo $show_product_id['details']; ?></textarea>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-success w-100" id="submit_edit_product" id_product_edit="<?php echo $show_product_id['id'] ?>" >บันทึกข้อมูล</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../assets/js/settings_product.js"></script>
<?php } ?>