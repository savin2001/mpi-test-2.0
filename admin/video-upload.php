<?php

include "loginer.php";
$conn = mysqli_connect('localhost', 'root', '', 'mpi_kenya_db');

// Check if file already exists

if(isset($_POST["submit"])) {
  //verify url

  //assigning values
  $video = $_POST["vid_name"];
  $vid_url = $_POST["vid_url"];
  $sess_user = htmlspecialchars($_SESSION["user_id"]);
  date_default_timezone_set("Africa/Nairobi");
  $now = date("Y-m-d H:i:sa");
  //insert into database
  $sql = "INSERT INTO videos (video, vid_date, user_id, vid_url) VALUES ('$video', '$now', '$sess_user', '$vid_url')";
  mysqli_query($conn, $sql);

  //redirecting user to video
  $sql = "SELECT users.user_id, users.email, user_registration.category FROM users INNER JOIN user_registration ON users.email = user_registration.email WHERE users.user_id =  '$sess_user'" ;//.$user_id
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result)) {
      // output data of the specific row
      while($row = mysqli_fetch_assoc($result)) {
        // Password is correct, so start a new session
        $category = $row["category"];
        if ($category == "x_user") {
          header("location: ../x-user/x-user-video.php");
          exit;

        } elseif ($category == "user") {
          header("location: ../user/user-video.php");
          exit;
        } else {
          echo "impossible";
        }
      }
    }
} else {
  echo "Video not uploaded";
}

// Close connection
mysqli_close($conn);
?>
