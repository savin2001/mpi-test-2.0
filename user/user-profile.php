<?php
// Include config file and login
require_once "../admin/config.php";
require "../admin/loginer.php";
// Check if the user is already logged in, if not then redirect user to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../admin/login.php");
  exit;

}
 ?>
 <?php
 $sess_user = htmlspecialchars($_SESSION["user_id"]);
 //to count news
 $sql= "SELECT COUNT(*) AS news_num FROM news WHERE user_id =  '$sess_user'";
 $results = mysqli_query($link, $sql);
 if (mysqli_num_rows($results) > 0) {
     // output data of the specific row
     while($row = mysqli_fetch_assoc($results)) {
       $news_repeater= $row["news_num"];

     }
   } else {
     echo "0 results";
   }
//to count Documents
$sql= "SELECT COUNT(*) AS doc_num FROM documents WHERE user_id =  '$sess_user'";
$results = mysqli_query($link, $sql);
if (mysqli_num_rows($results) > 0) {
    // output data of the specific row
    while($row = mysqli_fetch_assoc($results)) {
      $doc_repeater= $row["doc_num"];

    }
  } else {
    echo "0 results";
  }
//to count Photos
$sql= "SELECT COUNT(*) AS photo_num FROM photos WHERE user_id =  '$sess_user'";
$results = mysqli_query($link, $sql);
if (mysqli_num_rows($results) > 0) {
    // output data of the specific row
    while($row = mysqli_fetch_assoc($results)) {
      $photo_repeater= $row["photo_num"];

    }
  } else {
    echo "0 results";
  }
//to count videos
$sql= "SELECT COUNT(*) AS vid_num FROM videos WHERE user_id =  '$sess_user'";
$results = mysqli_query($link, $sql);
if (mysqli_num_rows($results) > 0) {
    // output data of the specific row
    while($row = mysqli_fetch_assoc($results)) {
      $vid_repeater= $row["vid_num"];

    }
  } else {
    echo "0 results";
  }


  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../media/mpi.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">
    <!-- CKEditor -->
    <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <title>Mathare Peace Initiative-Kenya</title>
</head>
<body>
    <div class="container-fluid navbar sticky-top navbar-expand-lg navbar-white bg-white navigation-panel">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="../media/mpi image.jpg"  height="50px" alt="mpi-logo"> </a>
            <nav class=" ml-auto">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                  <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link" href="#">
                      <?php
                      $sess_user = htmlspecialchars($_SESSION["user_id"]);
                      //getting the first and second names of the current user using user_id
                      $sql = "SELECT users.user_id, users.email,user_registration.f_name, user_registration.s_name FROM users INNER JOIN user_registration ON users.email = user_registration.email WHERE users.user_id =  '$sess_user'" ;
                      $result = mysqli_query($link, $sql);
                      if (mysqli_num_rows($result)) {
                          // output data of the specific row
                          while($row = mysqli_fetch_assoc($result)) {
                            //bind results to variables first and second
                            $first = $row["f_name"];
                            $second = $row["s_name"];

                          }
                        }
                        echo $first ." " .$second;

                      ?>
                      <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                  </a>

                  </div>
                </div>
              </nav>
        </div>
    </div>
    <div class="container-fluid bg-light">
        <div class="container">
            <div class="row ">
                <div class="col-lg-3 bg-light about ml-auto ">
                    <ul class="nav flex-column stick">
                        <li>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search search-icon" aria-hidden="true"></i></button>
                              </form>
                        </li>
                        <li class="nav-item  pads bottom">
                          <a class="nav-link" href="user.php">News</a>
                        </li>
                        <li class="nav-item pads bottom">
                          <a class="nav-link" href="user-photos.php">Photos</a>
                        </li>
                        <li class="nav-item pads bottom">
                            <a class="nav-link" href="user-video.php">Videos</a>
                        </li>
                        <li class="nav-item pads">
                          <a class="btn btn-outline-dark" href="../admin/logout.php">logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </li>
                      </ul>
                </div>
                <div class="col-lg-9 about bg-white">
                  <!-- Profile details -->
                  <?php

                  //getting the first and second names of the current user using user_id
                  $sql = "SELECT users.user_id, users.email,user_registration.f_name, user_registration.s_name FROM users INNER JOIN user_registration ON users.email = user_registration.email WHERE users.user_id =  '$sess_user'" ;
                  $result = mysqli_query($link, $sql);
                  if (mysqli_num_rows($result)) {
                      // output data of the specific row
                      while($row = mysqli_fetch_assoc($result)) {
                        //bind results to variables first and second
                        $user_id = $row["user_id"];
                        $first = $row["f_name"];
                        $second = $row["s_name"];
                        $email = $row["email"];

                      }
                    }
                    echo '
                      <div class="row about p-4">
                        <div class="col-md-6">
                          <i class="fa fa-user-circle-o fa-4x" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-6 text-dark">
                          <h5>
                            User-id : '.$user_id.'<br><br>
                            User name : '.$first .' '.$second.'<br><br>
                            Email : '   .$email.'
                          </h5>
                        </div>
                      </div>
                      <br>
                      <div class="about p-4">
                      <a href="../admin/reset-password.php" class="btn btn-outline-warning btn-large">Change your password</a>
                      </div>
                      <div class="p-4">
                        <h2 id="dashboard" class="Dashboards about">Dashboard</h2>
                        <ul class="list-group margin-center">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a class="nav-link" href="user.php">News</a>
                                <span class="badge badge-primary badge-pill">'.$news_repeater.'</span>
                              </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              <a class="nav-link" href="user-photos.php">Photos</a>
                              <span class="badge badge-primary badge-pill">'.$photo_repeater.'</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              <a class="nav-link" href="user-video.php">Videos</a>
                              <span class="badge badge-primary badge-pill">'.$vid_repeater.'</span>
                            </li>
                          </ul>
                      </div>
                  ';
                  ?>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="bg-white">
                <p class="text-primary note">© 2020 - All Rights Reserved - Mathare Peace Initiative</p>
                <br>
                <p class="text-secondary lil-note">Osuka Technologies</p>
            </div>
        </div>
    </div>
    <!-- closing link -->
    <<?php mysqli_close($link) ;?>

    <!-- Font awesome -->
    <script src="https://use.fontawesome.com/224ebf5ddd.js"></script>
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
