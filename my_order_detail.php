<?php 
require('top.php');
$order_id = mysqli_real_escape_string($conn,$_GET['id']);
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
                    $uid = $_SESSION['USER_ID'];
                    $total = 0;
                    $res = mysqli_query($conn,"select DISTINCT(order_detail.id), order_detail.*, products.name, products.image from order_detail,products,orders where order_detail.order_id='$order_id' and orders.user_id='$uid' and products.id=order_detail.product_id");
                    while($row = mysqli_fetch_assoc($res)){
                        $total = $total+($row['qty']*$row['price']);
                    ?>
                    <td class="product-add-to-cart">
                      <span> <?php echo $row['name'] ?> </span>
                    </td>
                    <td class="product-name">
                      <span>
                        <img width="200px" height="200px" src="./media/products/<?php echo $row['image'] ?>"/>
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
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<?php require('footer.php')?>