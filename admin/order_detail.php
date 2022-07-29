<?php
error_reporting(E_ERROR | E_PARSE);

require 'top.inc.php';
require 'connection.inc.php';
$order_id = mysqli_real_escape_string($conn,$_GET['id']);

if(isset($_POST['update_order_status'])){
  $update_order_status = $_POST['update_order_status'];
  mysqli_query($conn, "update orders set order_status='$update_order_status' where id='$order_id'");
}

?>

<div class="content pb-0">
  <div class="orders">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <h4 class="box-title">Orders Detail</h4>
          </div>
          <div class="card-body--">
            <div class="table-stats order-table ov-h">
            <table class="table">
                <thead>
                  <tr>
                    <th class="product-remove">
                      <span class="nobr">Product Name</span>
                    </th>
                    <th class="product-name">
                      <span class="nobr">Image</span>
                    </th>
                    <th class="product-name">
                      <span class="nobr">QTY</span>
                    </th>
                    <th class="product-price">
                      <span class="nobr">Price</span>
                    </th>
                    <th class="product-price">
                      <span class="nobr">Total</span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $total = 0;
                    $res = mysqli_query($conn,"select order_detail.*, products.name, products.image, orders.address,orders.city,orders.pincode,orders.order_status from order_detail,products,orders where order_detail.order_id='$order_id' and products.id=order_detail.product_id");
                    while($row = mysqli_fetch_assoc($res)){
                        $total = $total+($row['qty']*$row['price']);
                        $address = $row['address'];
                        $city = $row['city'];
                        $pincode = $row['pincode'];
                        $order_status = $row['order_status'];
                    ?>
                    <td class="product-add-to-cart">
                      <span> <?php echo $row['name'] ?> </span>
                    </td>
                    <td class="product-name">
                      <span>
                        <img src="../media/products/<?php echo $row['image'] ?>"/>
                      </span>
                    </td>
                    <td class="product-name">
                      <span>
                      <?php echo $row['qty'] ?>
                      </span>
                    </td>
                    <td class="product-name">
                      <span class="amount"><?php echo $row['price'] ?></span>
                    </td>
                    <td class="product-name">
                      <span class="wishlist-in-stock"><?php echo $row['qty']*$row['price'] ?></span>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
                <tr>
                    <td colspan="3"> Total Price </td>
                    <td colspan="3"><?php echo $total ?></td>
                </tr>
              </table>
              <div id="address_details" class="p-3">
                <strong>Address: </strong>
                <?php echo $address ?>,  <?php echo $city ?>,  <?php echo $pincode ?>
                <br>
                <strong>Order Status: </strong>
                <?php 
                $order_status_arr =mysqli_fetch_assoc( mysqli_query($conn,"select name from order_status where id='$order_status'"));
                echo $order_status_arr['name'];
                ?><br>
                <div>
                  <form method="post">
                    <select class="form-control" name="update_order_status">
                        <option>Select Status</option>
                        <?php 
                        $res = mysqli_query($conn, "select id, name from order_status");
                        while($row = mysqli_fetch_assoc($res)){
                            if($row['id'] == $order_status){
                                echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                            }else{
                                echo "<option value=".$row['id'].">".$row['name']."</option>";
                            }
                        }
                        ?>
                      </select> <br>
                      <input type="submit" value="submit" class="form-control"/> <br>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require 'footer.inc.php';
