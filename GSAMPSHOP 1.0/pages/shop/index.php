<?php
$pluem = new classweb_bypluem;
$show_card_product = $pluem->show_card_product();
?>
<div class="container">
    <div class="mt-3 text-center">
    <br>
    <br>
    <h2>สินค้าทั้งหมด</h2>
    <h2>สินค้าอัพเดทใหม่ล่าสุดทุกวัน ^-^</h2>
    <br>
    <br>
    </div>
    <div class="row">
        <?php if(empty($show_card_product)){ ?>
            <div class="col-12 mt-2">
                <h3 class='text-center'>ไม่มีสินค้า ณ ขณะนี้</h3>
            </div>
        <?php } ?>
        <?php foreach($show_card_product as $row){
            $totalproduct = $pluem->totalproduct($row['id']);
        ?>
            <div class="col-sm-4 mt-2">
                <div class="card" style="background-color: #292929;">
                    <img class="image_show_card rounded" src="<?php echo $row['image']; ?>" height="200" width="100%" alt="Product Image">
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
                                    <button type="button" class="btn btn-danger mt-2 w-100 submit_buyproduct" id_product="<?php echo $row['id']; ?>" name_product="<?php echo $row['name']; ?>">ซื้อสินค้า</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script src="../../assets/js/buyproduct.js"></script>