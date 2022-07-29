<?php

require 'connection.inc.php';

$name = mysqli_real_escape_string($conn,$_POST['name']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
$comment = mysqli_real_escape_string($conn,$_POST['comment']);
$added_on = date('y-m-d h:i:s');

mysqli_query($conn, "insert into contact_us(name, email, mobile, comment, added_on) values('$name', '$email', '$mobile', '$comment', '$added_on')");
echo 'Thank You';