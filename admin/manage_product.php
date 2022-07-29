<?php
error_reporting(E_ERROR | E_PARSE);
$name= '';
$categories_id= '';
$mrp= '';
$price= '';
$qty= '';
$image= '';
$short_desc= '';
$description= '';
$meta_title= '';
$meta_desc= '';
$meta_keyword= '';

$image_requires= 'required';

require 'top.inc.php';
require 'connection.inc.php';

if(isset($_GET['id']) && $_GET['id'] !=''){
    $image_requires='';
  $id = mysqli_real_escape_string($conn,$_GET['id']);
  $res = mysqli_query($conn,"select * from products where id='$id'");
  $check = mysqli_num_rows($res);
  if($check>0){
    $row = mysqli_fetch_assoc($res);
    $categories_id = $row['categories_id'];
    $name = $row['name'];
    $mrp = $row['mrp'];
    $price = $row['price'];
    $qty = $row['qty'];
    $image = $row['image'];
    $short_desc = $row['short_desc'];
    $description = $row['description'];
    $meta_title = $row['meta_title'];
    $meta_desc = $row['meta_desc'];
    $meta_keyword = $row['meta_keyword'];
  }else{
    header('location:products.php');
  }
}

if(isset($_POST['submit'])){
  $categories_id = mysqli_real_escape_string($conn, $_POST['categories_id']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $mrp = mysqli_real_escape_string($conn, $_POST['mrp']);
  $price = mysqli_real_escape_string($conn, $_POST['price']);
  $qty = mysqli_real_escape_string($conn, $_POST['qty']);
  $short_desc = mysqli_real_escape_string($conn, $_POST['short_desc']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
  $meta_desc = mysqli_real_escape_string($conn, $_POST['meta_desc']);
  $meta_keyword = mysqli_real_escape_string($conn, $_POST['meta_keyword']);

  if($_FILES['image']['name'] != '' && ($_FILES['image']['type'] !='image/png' && $_FILES['image']['type'] !='image/jpg' && $_FILES['image']['type'] !='image/jpeg') ){
    echo '<script>alert("only jpg, jpeg, png are supported");</script>';
    header('location:product.php');
    die();
  }

  if(isset($_GET['id']) && $_GET['id'] !=''){
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    if($_FILES['image']['name'] != ''){
        $image = rand(1111111111,9999999999)."_".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'../media/products/'.$image);

        $sql = "update products set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',image='$image',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' where id='$id'";
    }else{
        $sql = "update products set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',short_desc='$short_desc',description='$description',meta_title='$meta_title',meta_desc='$meta_desc',meta_keyword='$meta_keyword' where id='$id'";
    }
    mysqli_query($conn, $sql);
  }else{
    $image = rand(1111111111,9999999999)."_".$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],'../media/products/'.$image);

    $sql = "insert into products(categories_id,name,mrp,price,qty,image,short_desc,description,meta_title,meta_desc,meta_keyword,status) values('$categories_id','$name','$mrp','$price','$qty','$image','$short_desc','$description','$meta_title','$meta_desc','$meta_keyword','1')";
    mysqli_query($conn, $sql);
  }
  header('location:product.php');

}

?>

<div class="content pb-0">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            Add Product
          </div>
          <form method="POST" class="card-body card-block" enctype="multipart/form-data">
            <div class="form-group">
              <label for="categories" class="form-control-label">Category</label>
              <select class="form-control" name="categories_id">
                <option>Select Categories</option>
                <?php 
                $res = mysqli_query($conn, "select id, categories from categories order by categories asc");
                while($row = mysqli_fetch_assoc($res)){
                    if($row['id'] == $categories_id){
                        echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                    }else{
                        echo "<option value=".$row['id'].">".$row['categories']."</option>";
                    }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="name" class="form-control-label">Name</label
              ><input
                type="text"
                value="<?php echo $name ?>"
                name="name"
                placeholder="product name"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="mrp" class="form-control-label">MRP</label
              ><input
                type="text"
                value="<?php echo $mrp ?>"
                name="mrp"
                placeholder="enter mrp"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="price" class="form-control-label">Price</label
              ><input
                type="text"
                value="<?php echo $price ?>"
                name="price"
                placeholder="enter price"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="qty" class="form-control-label">QTY</label
              ><input
                type="number"
                value="<?php echo $qty ?>"
                name="qty"
                placeholder="enter qty"
                class="form-control"
                required
              />
            </div>
            <div class="form-group">
              <label for="image" class="form-control-label">Image</label
              ><input
                type="file"
                value="<?php echo $category_name ?>"
                name="image"
                placeholder="enter image"
                class="form-control"
                <?php echo $image_requires?>
              />
            </div>
            <div class="form-group">
              <label for="short_desc" class="form-control-label">Short Desc</label
              ><textarea
                type="text"
                name="short_desc"
                placeholder="enter short_desc"
                class="form-control"
                required
              ><?php echo $short_desc ?></textarea>
            </div>
            <div class="form-group">
              <label for="description" class="form-control-label">Description</label
              ><textarea
                type="text"
                name="description"
                placeholder="enter description"
                class="form-control"
                required
              ><?php echo $description ?></textarea>
            </div>
            <div class="form-group">
              <label for="meta_title" class="form-control-label">Meta Title</label
              ><textarea
                name="meta_title"
                placeholder="enter meta_title"
                class="form-control"
              ><?php echo $meta_title ?></textarea>
            </div>
            <div class="form-group">
              <label for="meta_desc" class="form-control-label">meta desc</label
              ><textarea
                type="text"
                name="meta_desc"
                placeholder="enter meta_desc"
                class="form-control"
              ><?php echo $meta_desc ?></textarea>
            </div>
            <div class="form-group">
              <label for="meta_keyword" class="form-control-label">meta keyword</label
              ><textarea
                type="text"
                name="meta_keyword"
                placeholder="enter meta_keyword"
                class="form-control"
              ><?php echo $meta_keyword ?></textarea>
            </div>
            <button
              id="payment-button"
              type="submit"
              name="submit"
              class="btn btn-lg btn-info btn-block"
            >
              <span id="payment-button-amount">Submit</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
require 'footer.inc.php';
