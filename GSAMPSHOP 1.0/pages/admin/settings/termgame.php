<?php
$pluem = new classadmin_bypluem;
$show_card_other = $pluem->show_card_other();
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success" data-toggle="modal" data-target="#add_card_other">เพิ่มสินค้า</button>
                    <div class="row">
                        <?php foreach($show_card_other as $row){ ?>
                            <div class="col-6 mt-2">
                                <img class="card" src="<?php echo $row['image']; ?>" width="100%">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="/add_item?id=<?php echo $row['id']; ?>" class="btn btn-success w-100 mt-2">จัดการสินค้า</a>
                                        <a href="/edit_item?id=<?php echo $row['id']; ?>" class="btn btn-warning w-100 mt-2">แก้ไขสินค้า</a>   
                                        <button type="button" class="btn btn-danger w-100 mt-2 del_card_other" id_card_other="<?php echo $row['id']; ?>">ลบสินค้า</button>
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
<div class="modal fade" id="add_card_other">
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
            <span>รูปภาพสินค้า</span>
            <input type="text" class="form-control" id="add_image_card_other" placeholder="รูปภาพสินค้า">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-success" id="submit_add_card_other">เพิ่มข้อมูล</button>
      </div>
    </div>
  </div>
</div>
</div>
<script src="../../../assets/js/settings_termgame.js"></script>