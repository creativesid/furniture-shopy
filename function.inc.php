<?php

function get_products($conn,$limit='',$cat_id='',$product_id=''){
    $sql = "select products.*,categories.categories from products,categories where products.status=1";
    if($cat_id!=''){
        $sql.= " and products.categories_id = $cat_id";
    }
    if($product_id!=''){
        $sql.= " and products.id = $product_id";
    }
    $sql.= " and products.categories_id = categories.id";
    $sql.= " order by products.id desc";
    if($limit!=''){
        $sql.= " limit $limit";
    }
    $res = mysqli_query($conn, $sql);
    $data= array();
    while($row = mysqli_fetch_assoc($res)){
        $data[]=$row;
    }
    return $data;
}

function productSoldQtyById($conn,$pid){
    $sql = "select sum(order_detail.qty) as qty from order_detail,orders where orders.id=order_detail.order_id and order_detail.product_id='$pid' and orders.order_status!=4";
    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $res['qty'];
}

function productQty($conn,$pid){
    $sql = "select qty from products where id='$pid'";
    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $res['qty'];
}

?>