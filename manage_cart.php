<?php
require 'connection.inc.php';
require 'function.inc.php';
require 'add_to_cart.inc.php';

$pid = mysqli_real_escape_string($conn,$_POST['pid']);
$qty = mysqli_real_escape_string($conn,$_POST['qty']);
$type = mysqli_real_escape_string($conn,$_POST['type']);

if($type != 'remove'){
    $productSoldQtyById=productSoldQtyById($conn, $pid);
    $productQty=productQty($conn, $pid);
    
    $pending_qty = $productQty - $productSoldQtyById;
    
    if($qty > $pending_qty){
        echo "not_available";
        die();
    }
}

$obj = new AddToCart();

if($type == 'add'){
    $obj->addProduct($pid,$qty);
}
if($type == 'update'){
    $obj->updateProduct($pid,$qty);
}
if($type == 'remove'){
    $obj->removeProduct($pid);
}

echo $obj->totalProduct()
?>