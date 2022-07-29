<?php
error_reporting(E_ERROR | E_PARSE);
$categories= '';
require 'top.inc.php';
require 'connection.inc.php';

if(isset($_GET['id']) && $_GET['id'] !=''){
  $id = mysqli_real_escape_string($conn,$_GET['id']);
  $res = mysqli_query($conn,"select * from categories where id='$id'");
  $check = mysqli_num_rows($res);
  if($check>0){
    $row = mysqli_fetch_assoc($res);
    $category_name = $row['categories'];
  }else{
    header('location:categories.php');
  }
}

if(isset($_POST['submit'])){
  $categories = mysqli_real_escape_string($conn, $_POST['categories']);

  if(isset($_GET['id']) && $_GET['id'] !=''){
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $sql = "update categories set categories='$categories' where id='$id'";
    mysqli_query($conn, $sql);
  }else{
    $sql = "insert into categories(categories, status) values('$categories','1')";
    mysqli_query($conn, $sql);
  }
  header('location:categories.php');

}

?>

<div class="content pb-0">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            Add Category
          </div>
          <form method="POST" class="card-body card-block">
            <div class="form-group">
              <label for="categories" class="form-control-label">Category</label
              ><input
                type="text"
                value="<?php echo $category_name ?>"
                name="categories"
                placeholder="Enter your Category name"
                class="form-control"
                required
              />
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
