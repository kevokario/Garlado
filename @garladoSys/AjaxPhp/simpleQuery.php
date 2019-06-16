<?php
include '../Core/functions.php';
//sleep(2);

if (isset($_SESSION['marvel']) === false) {
    ?>
    <script>document.location.href = '../@logout.php';</script>    
    <?php

}

if(isset($_POST['cat'])){
    
    $cat = $_POST['cat'];
    
    if($cat === "checkOrder"){
        checkOrder();
//        echo 'Obtained';
    }
    else if($cat === 'loadNewOrders'){
        loadNewOrders();
//        echo 'Welcome';
    }
    
    
}


?>