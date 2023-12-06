<?php
$pluem = new classadmin_bypluem;
$show_card_product = $pluem->show_card_product();
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success" data-toggle="modal" data-target="#add_product">เพิ่มสินค้า</button>
                    <div class="row">
                        <?php foreach($show_card_product as $row){
                        $totalproduct = $pluem->totalproduct($row['id']);
                        ?>
                            <div class="col-sm-4 mt-2">
                                <div class="card" style="background-color: #292929;">
                                    <img class="image_show_card" src="<?php echo $row['image']; ?>" width="100%">
                                    <div class="card-body">
                                        <div class="mt-2">
                                            <h5><?php echo $row['name']; ?></h5>
                                            <h6>ราคา :
                                                <span style="color: yellow;">
                                                    <?php echo $row['price']; ?>
                                                </span> บาท
                                            </h6>
                                            <h6>สถานะสินค้า:
                                            <span>
                                                <?php
                                                if($totalproduct['total'] == "0"){
                                                echo "<span class='badge bg-danger'>หมด</span>";
                                                }else{
                                                echo "<span class='badge bg-success'>มีของ</span>";
                                                }
                                                ?>
                                            </span>
                                            </h6>
                                            <h6><i class="fas fa-box-open"></i> สินค้าในสต็อก : <?php echo $totalproduct['total']; ?> ชิ้น</h6>
                                            <h6>รายละเอียดสินค้า : <br><span style="color:#E71C1C;"><textarea disabled class="text-input-none"><?php echo $row['details']; ?></textarea></span></h6>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <a href="/add_stock_id?id=<?php echo $row['id']; ?>" class="btn btn-success w-100 mt-2">จัดการสินค้า</a>
                                                    <a href="/edit_product?id=<?php echo $row['id']; ?>" class="btn btn-warning w-100 mt-2">แก้ไขสินค้า</a>   
                                                    <button type="button" class="btn btn-danger w-100 mt-2 del_product" id_product="<?php echo $row['id']; ?>" name_product="<?php echo $row['name']; ?>">ลบสินค้า</button>
                                                </div>
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
<div class="modal fade" id="add_product">
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
            <span>ชื่อสินค้า</span>
            <input type="text" class="form-control" id="name_product" placeholder="ชื่อสินค้า">
        </div>
        <div class="form-group">
            <span>รูปภาพสินค้า</span>
            <input type="text" class="form-control" id="image_product" placeholder="รูปภาพสินค้า">
        </div>
        <div class="form-group">
            <span>ราคาสินค้า</span>
            <input type="text" class="form-control" id="price_product" placeholder="ราคาสินค้า">
        </div>
        <div class="form-group">
            <span>รายละเอียดสินค้า</span>
            <textarea id="details_product" placeholder="รายละเอียดสินค้า" class="text-input-none1 form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-success" id="submit_add_product">เพิ่มข้อมูล</button>
      </div>
    </div>
  </div>
</div>
<script src="../../../assets/js/settings_product.js"></script>