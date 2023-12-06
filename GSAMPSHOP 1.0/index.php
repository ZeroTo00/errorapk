<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include 'config/class.php';
    $pluem = new classweb_bypluem;
    $web_config = $pluem->web_config();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $web_config['title']; ?></title>
    <link rel="icon" type="image" href="<?php echo $web_config['logo']; ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <script src="assets/js/main.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    require 'vendor/autoload.php';
    $router = new AltoRouter();
    include 'layouts/navbar.php';
    $resultuser = $pluem->resultuser();
    if(empty($_SESSION['id'])){
        $router->map('GET','/',function(){
            include 'pages/account/login.php';
        });
        $router->map('GET','/login',function(){
            include 'pages/account/login.php';
        });
        $router->map('GET','/register',function(){
            include 'pages/account/register.php';
        });
    }else{
        $router->map('GET','/',function(){
            include 'pages/home.php';
        });
        $router->map('GET','/home',function(){
            include 'pages/home.php';
        });
        $router->map('GET','/shop',function(){
            include 'pages/shop/index.php';
        });
        $router->map('GET','/topup',function(){
            include 'pages/topup/index.php';
        });
        $router->map('GET','/termgame',function(){
            include 'pages/termgame/index.php';
        });
        $router->map('GET','/account',function(){
            include 'pages/account/index.php';
        });
        $router->map('GET','/history_shop',function(){
            include 'pages/history/shop.php';
        });
        $router->map('GET','/code',function(){
            include 'pages/code/index.php';
        });
        $router->map('GET','/gamespin',function(){
            include 'pages/game/spin.php';
        });
        if($resultuser['class'] == "1"){
            $router->map('GET','/backend',function(){
                include 'layouts/menu.php';
                include 'pages/admin/index.php';
            }); 
            $router->map('GET','/settings_user',function(){
                include 'layouts/menu.php';
                include 'pages/admin/settings/user.php';
            });
            $router->map('GET','/settings_web',function(){
                include 'layouts/menu.php';
                include 'pages/admin/settings/web.php';
            });
            $router->map('GET','/settings_product',function(){
                include 'layouts/menu.php';
                include 'pages/admin/settings/product.php';
            });
            $router->map('GET','/settings_termgame',function(){
                include 'layouts/menu.php';
                include 'pages/admin/settings/termgame.php';
            });
            $router->map('GET','/settings_code',function(){
                include 'layouts/menu.php';
                include 'pages/admin/settings/code.php';
            });
            $router->map('GET','/history_topup',function(){
                include 'layouts/menu.php';
                include 'pages/admin/history/topup.php';
            });
            $router->map('GET','/history_product',function(){
                include 'layouts/menu.php';
                include 'pages/admin/history/product.php';
            });
            $router->map('GET','/history_termgame',function(){
                include 'layouts/menu.php';
                include 'pages/admin/history/termgame.php';
            });
            $router->map('GET','/history_random',function(){
                include 'layouts/menu.php';
                include 'pages/admin/history/random.php';
            });
            $router->map('GET','/edit_user',function(){
                include 'layouts/menu.php';
                include 'pages/admin/edit/user.php';
            });
            $router->map('GET','/edit_product',function(){
                include 'layouts/menu.php';
                include 'pages/admin/edit/product.php';
            });
            $router->map('GET','/add_stock_id',function(){
                include 'layouts/menu.php';
                include 'pages/admin/add/stock_id.php';
            });
            $router->map('GET','/edit_stock_id',function(){
                include 'layouts/menu.php';
                include 'pages/admin/edit/stock_id.php';
            });
            $router->map('GET','/add_item',function(){
                include 'layouts/menu.php';
                include 'pages/admin/add/item.php';
            });
            $router->map('GET','/edit_item',function(){
                include 'layouts/menu.php';
                include 'pages/admin/edit/item.php';
            });
        }
    }
    $match = $router->match();
    if( is_array($match) && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        echo "<script>window.location.href = '/';</script>";
    }
    ?>
    <small class="pb-3 d-block my-auto footer-copyright text-secondary text-center py-4 w-100">
        ©  Copyright 2022 Website By
        <a href="https://www.facebook.com/people/Esso_Lee/100089885736945/" target="_blank">Esso_Lee & G.SAMPSHOP</a>
        All Rights Reserved.
    </small>
</body>
</html>