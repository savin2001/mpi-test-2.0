<?php
include 'config.php';
if(isset($_POST["submit"])) {
  $user_id = $_POST["user_id"];
  $status = $_POST["status"];
  $sql = "UPDATE users SET status = '$status' WHERE users.user_id = '$user_id'";
  mysqli_query($link, $sql);
  header("location: admin.php");
}else {
  echo "status not changed";
}
 ?>
