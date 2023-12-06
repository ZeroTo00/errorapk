<?php
$pluem = new classadmin_bypluem;
$stock_id_id = $pluem->stock_id_id($_GET['id']);
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success" data-toggle="modal" data-target="#add_stock_id">เพิ่มสินค้า</button>
                    <div class="mt-3 text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">สินค้าที่ได้รับ</th>
                                    <th scope="col">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($stock_id_id as $row){ ?>
                                  <tr>
                                      <th scope="row"><?php echo $row['id']; ?></th>
                                      <td><?php echo $row['details']; ?></td>
                                      <td>
                                        <button class="btn btn-danger del_stock_id" id_stock="<?php echo $row['id']; ?>">ลบ</button>
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
</div>
<div class="modal fade" id="add_stock_id">
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
        <h6 class="ml-auto text-white">สต๊อก <span id="stock"> 0</span> ชิ้น <span style="color: red;">*ห้ามเว้นบรรทัด</span></h6>
            <span>สินค้าที่ได้รับ</span>
            <textarea id="add_details_stock_id" placeholder="สินค้าที่ได้รับ" class="text-input-none1 bg-pluem"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-success" id="submit_add_stock_id" idproduct="<?php echo $_GET['id']; ?>">เพิ่มข้อมูล</button>
      </div>
    </div>
  </div>
</div>
<script src="../../../assets/js/settings_stock_id.js"></script>