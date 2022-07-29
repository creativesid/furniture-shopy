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

$sql = "select * from users order by id desc";
$res = mysqli_query($conn, $sql);

?>

<div class="content pb-0">
  <div class="orders">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <h4 class="box-title">Users</h4>
          </div>
          <div class="card-body--">
            <div class="table-stats order-table ov-h">
              <table class="table">
                <thead>
                  <tr>
                    <th class="serial">#</th>
                    <th class="avatar">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i = 1;while ($row = mysqli_fetch_assoc($res)) {?>
                        <tr>
                            <td class="serial"><?php echo $i ?></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['mobile'] ?></td>
                            <td><?php echo $row['added_on'] ?></td>
                            <td>
                                <?php
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
