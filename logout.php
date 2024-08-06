<?php
if(isset($_GET['admin_logout'])){
    session_start();
    session_unset();
    session_destroy();
    header("Location: admin.php");
    exit();    
}
elseif(isset($_GET['seller_logout'])){
    session_start();
    session_unset();
    session_destroy();
    header("Location: product.php");
    exit();    
}
elseif(isset($_GET['menu'])){
    session_start();
    session_unset();
    session_destroy();
    header("Location: menu.php");
    exit();    
}
else{


session_start();
session_unset();
session_destroy();
header("Location: home.php");
exit();
}
?>