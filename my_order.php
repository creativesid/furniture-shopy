<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
  ?>
  <script>
    window.location.href = 'index.php'
  </script>
  <?php
}
?>

<div class="wishlist-area ptb--100 bg__white">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="wishlist-content">
          <form action="#">
            <div class="wishlist-table table-responsive">
              <table>
                <thead>
                  <tr>
                    <th class="product-remove">
                      <span class="nobr">Order ID</span>
                    </th>
                    <!-- <th class="product-thumbnail">Date</th> -->
                    <th class="product-name">
                      <span class="nobr">Date</span>
                    </th>
                    <th class="product-name">
                      <span class="nobr">Address</span>
                    </th>
                    <th class="product-price">
                      <span class="nobr">Payment Type</span>
                    </th>
                    <th class="product-price">
                      <span class="nobr">Payment Status</span>
                    </th>
                    <th class="product-stock-stauts">
                      <span class="nobr"> Order Status </span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $uid = $_SESSION['USER_ID'];
                    $res = mysqli_query($conn,"select orders.*,order_status.name as order_status_str from orders,order_status where order_status.id=order_status and user_id='$uid'");
                    while($row = mysqli_fetch_assoc($res)){
                    ?>
                    <td class="product-add-to-cart">
                      <a href="my_order_detail.php?id=<?php echo $row['id'] ?>"> <?php echo $row['id'] ?> </a>
                    </td>
                    <td class="product-name">
                      <span><?php echo $row['added_on'] ?></span>
                    </td>
                    <td class="product-name">
                      <span>
                      <?php echo $row['address'] ?>,
                      <?php echo $row['city'] ?>,
                      <?php echo $row['pincode'] ?>
                      </span>
                    </td>
                    <td class="product-price">
                      <span class="amount"><?php echo $row['payment_type'] ?></span>
                    </td>
                    <td class="product-stock-status">
                      <span class="wishlist-in-stock"><?php echo $row['payment_status'] ?></span>
                    </td>
                    <td class="product-stock-status">
                      <span class="wishlist-in-stock"><?php echo $row['order_status_str'] ?></span>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<?php require('footer.php')?>