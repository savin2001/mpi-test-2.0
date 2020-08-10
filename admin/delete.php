<?php
require_once "config.php";
// to get the value of the user_id to be deleted from users table
$sql = "SELECT *  from users ORDER BY user_date DESC LIMIT 1";
$results = mysqli_query($link, $sql);
if (mysqli_num_rows($results) > 0) {
    // output data of the specific row
    while($row = mysqli_fetch_assoc($results)) {
      $deletee = $row["user_id"];
    }
  } else {
    echo "0 results";
  }
  // to get the value of the email to be deleted from user_registration table
  $sqli = "SELECT *  from user_registration ORDER BY reg_date DESC LIMIT 1";
  $results = mysqli_query($link, $sql);
  if (mysqli_num_rows($results) > 0) {
      // output data of the specific row
      while($row = mysqli_fetch_assoc($results)) {
        $rdeletee = $row["email"];
      }
    } else {
      echo "0 results";
    }

// actual deletion of record form users and user_registration respectively
  $sqld = "DELETE FROM users WHERE user_id = '$deletee';
  DELETE FROM user_registration WHERE email = '$rdeletee'";

  if (mysqli_multi_query($link, $sqld)){
    // Close connection
 header("location:user-registration.php"); // redirects to user-registration page

}
else
{
  echo $deletee;
 echo "Error deleting record"; // display error message if not delete
}
mysqli_close($link);
 ?>
