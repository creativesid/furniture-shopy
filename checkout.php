<?php 
error_reporting(E_ERROR | E_PARSE);
require('top.php');
if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){
    ?>
    <script>
      window.location.href = 'index.php'
    </script>
    <?php
}
if(!isset($_SESSION['USER_LOGIN'])){
  ?>
    <script>
      window.location.href = 'login.php'
    </script>
  <?php
}

$cart_total = 0;
foreach($_SESSION['cart'] as $key=>$val){
  $productArr = get_products($conn,'','',$key);
  $qty = $val['qty'];
  $price = $productArr[0]['price'];
  $cart_total = $cart_total+($price*$qty);
}

if(isset($_POST['submit'])){
  $address = mysqli_real_escape_string($conn,$_POST['address']);
  $city = mysqli_real_escape_string($conn,$_POST['city']);
  $pincode = mysqli_real_escape_string($conn,$_POST['pincode']);
  $payment_type = mysqli_real_escape_string($conn,$_POST['payment_type']);
  $user_id = $_SESSION['USER_ID'];
  $total_price = $cart_total;
  $payment_status = 'pending';  
  if($payment_type == 'cod'){
    $payment_status = 'success';  
  }
  $order_status = 1;
  $added_on = date('Y-m-d h:i:s');

  $sql = "insert into orders(user_id,address,city,pincode,payment_type,total_price,payment_status,order_status,added_on) values('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on')";
  mysqli_query($conn,$sql);

  $order_id = mysqli_insert_id($conn);

  foreach($_SESSION['cart'] as $key=>$val){
    $productArr = get_products($conn,'','',$key);
    $qty = $val['qty'];
    $price = $productArr[0]['price'];

    $sql2 = "insert into order_detail(order_id,product_id,qty,price) values('$order_id','$key','$qty','$price')";
    mysqli_query($conn,$sql2);
  }

  unset($_SESSION['cart']);

  ?>
  <script>
    window.location.href = 'thank_you.php'
  </script>
  <?php

}

?>

<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="checkout__inner">
          <div class="accordion-list">
            <form method="POST">
              <div class="accordion">
                <div class="accordion__title">Address Information</div>
                <div class="accordion__body">
                  <div class="bilinfo">
                    <form action="#">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="single-input">
                            <input type="text" name="address" placeholder="Street Address" required />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="single-input">
                            <input type="text" name="city" placeholder="City/State" required />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="single-input">
                            <input type="text" name="pincode" placeholder="Post code/ zip" required />
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="accordion__title">payment information</div>
                <div class="accordion__body">
                  <div class="paymentinfo">
                    <div class="single-method">
                      <input type="radio" name="payment_type" value="cod" required /> COD
                    </div>
                    <!-- <div class="single-method">
                      <input type="radio" name="payment_type" value="payu" required /> PayU
                    </div> -->
                    <br>
                  </div>
                </div>
                <div class="single-method">
                    <input type="submit" name="submit" class="btn btn-success" value="SUBMIT"/>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="order-details">
          <h5 class="order-details__title">Your Order</h5>
          <div class="order-details__item">
            <?php
                $cart_total = 0;
                foreach($_SESSION['cart'] as $key=>$val){
                    $productArr = get_products($conn,'','',$key);
                    $pname = $productArr[0]['name'];
                    $mrp = $productArr[0]['mrp'];
                    $price = $productArr[0]['price'];
                    $image = $productArr[0]['image'];
                    $qty = $val['qty'];
                    $cart_total = $cart_total+($price*$qty); 
            ?>
                <div class="single-item">
                    <div class="single-item__thumb">
                        <img src="./media/products/<?php echo $image ?>" alt="ordered item" />
                    </div>
                    <div class="single-item__content">
                            <a href="product.php?id=<?php echo $key;?>" >
                                <?php echo $pname ?>
                            </a>
                        <span class="price">
                            ₹ <?php echo $qty*$price ?>
                        </span>
                    </div>
                    <div class="single-item__remove">
                    <a href="javascript:void(0)" onclick="manage_cart(<?php echo $key;?>,'remove')">
                        <i class="zmdi zmdi-delete"></i>
                    </a>
                    </div>
                </div>
            <?php } ?>
            
          </div>
          <div class="ordre-details__total">
            <h5>Order total</h5>
            <span class="price">
                ₹ <?php echo $cart_total ?>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- cart-main-area end -->



<?php require('footer.php')?>