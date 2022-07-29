<?php

function pr($arr)
{
    echo '<pre/>';
    print_r($arr);
}
function prx()
{
    echo '<pre/>';
    print_r($arr);
    die();
}


function productSoldQtyById($conn,$pid){
    $sql = "select sum(order_detail.qty) as qty from order_detail,orders where orders.id=order_detail.order_id and order_detail.product_id='$pid' and orders.order_status!=4";
    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $res['qty'];
}