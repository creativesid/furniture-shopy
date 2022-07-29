<?php
error_reporting(E_ERROR | E_PARSE);

require 'top.inc.php';
require 'connection.inc.php';

if(isset($_GET['type']) && $_GET['type'] !=''){
  $type = mysqli_real_escape_string($conn, $_GET['type']);

  if($type == "status"){
    $operation = mysqli_real_escape_string($conn, $_GET['operation']);
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    if($operation == 'active'){
      $status = 1;
    }else{
      $status = 0;
    }
    $update_status = "update categories set status='$status' where id='$id'";
    mysqli_query($conn, $update_status);
  }

  if($type == "delete"){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $delete_sql = "delete from categories where id='$id'";
    mysqli_query($conn, $delete_sql);
  }
}

$sql = "select * from categories order by categories asc";
$res = mysqli_query($conn, $sql);

?>

<div class="content pb-0">
  <div class="orders">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <h4 class="box-title">Categories</h4>
            <a href="manage_category.php" class="btn btn-success mt-3">Add Category</a>
          </div>
          <div class="card-body--">
            <div class="table-stats order-table ov-h">
              <table class="table">
                <thead>
                  <tr>
                    <th class="serial">#</th>
                    <th class="avatar">ID</th>
                    <th>Category</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i = 1;while ($row = mysqli_fetch_assoc($res)) {?>
                        <tr>
                            <td class="serial"><?php echo $i ?></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['categories'] ?></td>
                            <td>
                                <?php
                                  if ($row['status'] == 1) {
                                      echo "<a class='btn btn-success' href='?type=status&operation=deactive&id=".$row['id']."'>Active</a>&nbsp;&nbsp;&nbsp;";
                                  } else {
                                    echo "<a class='btn btn-warning' href='?type=status&operation=active&id=".$row['id']."'>Deactive</a>&nbsp;&nbsp;&nbsp;";
                                  }
                                  echo "<a class='btn btn-primary' href='manage_category.php?id=".$row['id']."'>Edit</a>&nbsp;&nbsp;&nbsp;";
                                  echo "<a class='btn btn-danger' href='?type=delete&id=".$row['id']."'>Delete</a>&nbsp;";
                                ?>
                            </td>
                        </tr>
                  <?php }?>
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
