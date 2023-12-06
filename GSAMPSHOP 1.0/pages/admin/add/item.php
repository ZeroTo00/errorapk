<?php
$pluem = new classadmin_bypluem;
$show_stock_item = $pluem->show_stock_item($_GET['id']);
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_stock_item">เพิ่มสินค้า</button>
                    <div class="row">
                        <?php foreach($show_stock_item as $row){ ?>
                            <div class="col-sm-4 mt-2">
                                 <div class="card">
                                    <div class="card-body text-center">
                                        <img src="<?php echo $row['image']; ?>" class="mb-3" width="50%">
                                        <h4 class="text-primary"><?php echo $row['details']; ?></h4>
                                        <h5 class="text-danger">ราคา <?php echo $row['price']; ?> บาท</h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="/edit_stock_id?id=<?php echo $row['id']; ?>" class="btn btn-success w-100 mt-2">แก้ไขสินค้า</a>   
                                                <button type="button" class="btn btn-danger w-100 mt-2 del_stock_item" id_stock_item="<?php echo $row['id']; ?>">ลบสินค้า</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_stock_item">
  <div class="modal-dialog" role="document">
    <div class="modal-content card  ">
      <div class="modal-header">
        <h5 class="modal-title">เพิ่มสินค้า</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <span>รายละเอียดสินค้า</span>
            <input type="text" class="form-control" id="details_stock_item" placeholder="รายละเอียดสินค้า">
        </div>
        <div class="form-group">
            <span>ราคาสินค้า</span>
            <input type="text" class="form-control" id="price_stock_item" placeholder="ราคาสินค้า">
        </div>
        <div class="form-group">
            <span>รูปภาพสินค้า</span>
            <input type="text" class="form-control" id="image_stock_item" placeholder="รูปภาพสินค้า">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-success" id="submit_add_stock_item" id_stock_item="<?php echo $_GET['id'] ?>">เพิ่มข้อมูล</button>
      </div>
    </div>
  </div>
</div>
<script src="../../../assets/js/settings_termgame.js"></script>