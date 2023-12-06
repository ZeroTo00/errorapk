<?php
$pluem = new classweb_bypluem;
$resultuser = $pluem->resultuser();
$web_config = $pluem->web_config();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <a class="navbar-brand" href="/">
        <img src="<?php echo $web_config['logo']; ?>" width="60" class="rounded-circle">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
            <?php if(empty($_SESSION['id'])){ ?>
                <a class="nav-item nav-link active" href="/login">
                    <i class="fas fa-sign-in-alt" style="color: #2ccc00;"></i> เข้าสู่ระบบ
                </a>
                <a class="nav-item nav-link active" href="/register">
                    <i class="fas fa-user-plus"style="color: #ff3d3d;"></i> สมัครสมาชิก
                </a>
            <?php }else{ ?>
                <a class="nav-item nav-link active" href="/">
                <i class="fa-solid fa-house" style="color: #4766ff;"></i> หน้าหลัก
                </a>
                <a class="nav-item nav-link active" href="/shop">
                <i class="fa-solid fa-cart-arrow-down" style="color: #2ccc00;"></i> ร้านค้า
                </a>
                <a class="nav-item nav-link active" href="/topup">
                <i class="fa-solid fa-won-sign" style="color: #eeff00;"></i> เติมเงิน
                </a>
                <a class="nav-item nav-link active" href="/code">
                <i class="fa-solid fa-gift" style="color: #ff3d3d;"></i> กรอกโค้ด
                </a>
                <a class="nav-item nav-link active" href="/gamespin">
                <i class="fa-solid fa-users-rays" style="color: #005eff;"></i> แนะนำ SAMP
                </a>
                <a class="nav-item nav-link active" href="/account">
                <i class="fa-solid fa-user" style="color: #8000ff;"></i> บัญชีของฉัน
                </a>
                <a class="nav-item nav-link active" href="/history_shop">
                <i class="fa-solid fa-truck" style="color: #ffea00;"></i> สินค้าของฉัน
                </a>
                <a class="nav-item nav-link active" href="<?php echo $web_config['contact']; ?>" target="_blank">
                <i class="fa-brands fa-facebook" style="color: #337eff;"></i> ติดต่อแอดมิน
                </a>
                <a class="nav-item nav-link active logout" href="#">
                <i class="fa-solid fa-power-off" style="color: #ff0000;"></i> ออกจากระบบ
                </a>
                <?php if($resultuser['class'] == "1"){ ?>
                    <a class="nav-item nav-link active" href="/backend">
                    <i class="fa-solid fa-circle-check" style="color: #ff3333;"></i> จัดการระบบ
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</nav>
<script src="../assets/js/navbar.js"></script>