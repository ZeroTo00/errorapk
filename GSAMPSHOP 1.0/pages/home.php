<?php
$pluem = new classweb_bypluem;
$allproduct = $pluem->allproduct();
$soldproduct = $pluem->soldproduct();
$readyproduct = $pluem->readyproduct();
$web_config = $pluem->web_config();
$show_card_other = $pluem->show_card_other();
$show_card_productlimit = $pluem->show_card_productlimit();
?>
<script>
  let visitorCount = 0;

  function incrementVisitorCount() {
    visitorCount++;
    updateVisitorCount();
  }

  function updateVisitorCount() {
    const countElement = document.getElementById("visitorCount");
    countElement.textContent = visitorCount;
  }
</script>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 image_show" src="<?php echo $web_config['image1'] ?>" style="max-width: 100%;">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 image_show" src="<?php echo $web_config['image2'] ?>" style="max-width: 100%;">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 image_show" src="<?php echo $web_config['image3'] ?>" style="max-width: 100%;">
                </div>
            </div>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="card mt-3">
                <div class="card-obdy">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text bg-danger text-white"><i class="fa fa-newspaper"></i>&nbsp; ข่าวสารเเละอัพเดท</span>
                        </div>
                        <marquee class="form-control bg-card"><?php echo $web_config['news']; ?></marquee>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block">
            <div class="row mt-3">
                <div class="col-md-3 mt-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="mt-0 mb-0" style="font-size: 2.5rem;"><i class="fa-solid fa-cubes fa-spin fa-spin-reverse" style="color: #ffffff;"></i></h1>
                            <h1 class="mt-0 mb-0"><?php echo $allproduct['total']; ?></h1>
                            <span class="text-muted">สินค้าทั้งหมดในระบบ</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="mt-0 mb-0" style="font-size: 2.5rem;"><i class="fa-regular fa-circle-check fa-beat-fade"></i></h1>
                            <h1 class="mt-0 mb-0"><?php echo $soldproduct['total']; ?></h1>
                            <span class="text-muted">สินค้าที่จำหน่ายแล้ว</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="mt-0 mb-0" style="font-size: 2.5rem;"><i class="fa-solid fa-signal fa-fade" style="color: #ffffff;"></i></h1>
                            <h1 class="mt-0 mb-0"><span id="visitorCount">0</span></h1>
                            <span class="text-muted">จำนวนผู้ใช้งานที่ออนไลน์อยู่ขณะนี้</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="mt-0 mb-0" style="font-size: 2.5rem;"><i class="fa-solid fa-dolly fa-beat"></i></h1>
                            <h1 class="mt-0 mb-0"><?php echo $readyproduct['total']; ?></h1>
                            <span class="text-muted">สินค้าพร้อมจำหน่าย</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block d-lg-none">
            <div class="row mt-3">
                <div class="col-12 mt-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="mt-0 mb-0" style="font-size: 2.5rem;"><i class="fa-solid fa-cubes fa-spin fa-spin-reverse" style="color: #ffffff;"></i></h1>
                            <h1 class="mt-0 mb-0"><?php echo $allproduct['total']; ?></h1>
                            <span class="text-muted">สินค้าทั้งหมดในระบบ</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="mt-0 mb-0" style="font-size: 2.5rem;"><i class="fa-regular fa-circle-check fa-beat-fade"></i></h1>
                            <h1 class="mt-0 mb-0"><?php echo $soldproduct['total']; ?></h1>
                            <span class="text-muted">สินค้าที่จำหน่ายแล้ว</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="mt-0 mb-0" style="font-size: 2.5rem;"><i class="fa-solid fa-dolly fa-beat"></i></h1>
                            <h1 class="mt-0 mb-0"><?php echo $readyproduct['total']; ?></h1>
                            <span class="text-muted">สินค้าพร้อมจำหน่าย</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            </div>
            </div>
            <br>
            <br>
            <h3 class="text-center py-4" style="background-color: #FF0000; color: #ffffff; font-size: 2rem; font-weight: bold;">สินค้าใหม่ล่าสุด</h3>
            <br>
            <div class="row">
                <?php if(empty($show_card_productlimit)){ ?>
                    <div class="col-12 mt-2">
                        <h3 class='text-center'>ไม่มีสินค้า ณ ขณะนี้</h3>
                    </div>
                <?php } ?>
                <?php foreach($show_card_productlimit as $row){
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
    </div>
</div>
<body onload="incrementVisitorCount()">
<script src="../assets/js/buyproduct.js"></script>