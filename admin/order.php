<?php
error_reporting(E_ERROR | E_PARSE);

require 'top.inc.php';
require 'connection.inc.php';

if(isset($_GET['type']) && $_GET['type'] !=''){
  $type = mysqli_real_escape_string($conn, $_GET['type']);

  if($type == "delete"){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $delete_sql = "delete from users where id='$id'";
    mysqli_query($conn, $delete_sql);
  }
}

?>

<div class="content pb-0">
  <div class="orders">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <h4 class="box-title">Orders</h4>
          </div>
          <div class="card-body--">
            <div class="table-stats order-table ov-h">
            <table class="table">
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
                    $res = mysqli_query($conn,"select orders.*,order_status.name as order_status_str from orders,order_status where order_status.id=order_status");
                    while($row = mysqli_fetch_assoc($res)){
                    ?>
                    <td class="product-add-to-cart">
                      <a class="btn btn-primary" href="order_detail.php?id=<?php echo $row['id'] ?>"> <?php echo $row['id'] ?> </a>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require 'footer.inc.php';
