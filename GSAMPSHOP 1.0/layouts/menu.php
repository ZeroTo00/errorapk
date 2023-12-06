<style>
    .menu-card {
        border: 2px solid #3498db; /* ขอบสีเขียว */
        background-color: #000000; /* พื้นหลังสีเทา */
    }

    .menu-card:hover {
        border-color: #e74c3c; /* ขอบสีแดงเมื่อเม้าส์ชี้ไป */
        background-color: #ecf0f1; /* พื้นหลังสีฟ้าเท่ากับสีเทา */
    }
</style>

<?php
$pluem = new classadmin_bypluem;
$totaluser = $pluem->totaluser();
$totaltopup = $pluem->totaltopup();
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-sm-4 mt-2">
            <div class="card text-center menu-card">
                <div class="card-body">
                    <h3>รายละเอียดเว็บ</h3>
                    <h5>SEVER : <?php echo $_SERVER['SERVER_NAME']; ?></h5>
                    <h5>ผู้ใช้ทั้งหมด : <?php echo $totaluser['total']; ?> คน</h5>
                    <h5>รายได้ทั้งหมด :
                    <?php
                    if(empty($totaltopup['total'])){
                        echo "0.00";
                    }else{
                        echo $totaltopup['total'];
                    }
                    ?> บาท</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-4 mt-2">
                    <a href="/settings_user">
                        <div class="card menu-card">
                            <div class="card-body">
                                <i class="fas fa-users-cog"></i> จัดการผู้ใช้
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/settings_web">
                        <div class="card menu-card">
                            <div class="card-body">
                                <i class="fas fa-cog"></i> จัดการเว็บ
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/settings_product">
                        <div class="card menu-card">
                            <div class="card-body">
                                <i class="fas fa-shopping-basket"></i> จัดการสินค้า
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/settings_termgame">
                        <div class="card menu-card">
                            <div class="card-body">
                                <i class="fas fa-gamepad"></i> จัดการเติมไอดี-พาส
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/settings_code">
                        <div class="card menu-card">
                            <div class="card-body">
                                <i class="fas fa-code"></i> จัดการโค๊ด
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/history_topup">
                        <div class="card menu-card">
                            <div class="card-body">
                                <i class="fas fa-history"></i> ประวัติการเติมเงิน
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/history_product">
                        <div class="card menu-card">
                            <div class="card-body">
                                <i class="fas fa-history"></i> สินค้าของฉัน
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/history_termgame" class="text-decoration-none">
                        <div class="card text-center menu-card">
                            <div class="card-body">
                                <i class="fas fa-history" style="color: #fff;"></i> ประวัติการเติมไอดี-พาส
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-4 mt-2">
                    <a href="/history_random">
                        <div class="card menu-card">
                            <div class="card-body">
                                <i class="fas fa-history"></i> ประวัติการสุ่มของรางวัล
                            </div>
                        </div>
                    </a>
                </div>
                <!-- เพิ่มเมนูอื่น ๆ ตามที่คุณต้องการ -->
            </div>
        </div>
    </div>
</div>
