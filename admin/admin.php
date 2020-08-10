<?php

// Include config file and login
require_once "config.php";
require_once "loginer.php";
// Check if the user is already logged in, if not then redirect user to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../admin/login.php");
  exit;
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
                    <li class="nav-item active">
                        <a class="nav-link" href="#dashboard">Dashboard <span class="sr-only">(current)</span></a>
                      </li>
                     <li class="nav-item ">
                        <a class="nav-link" href="#users">Users</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#news">News</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#docs">Documents</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#photos">Photos</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#videos">Videos</a>
                      </li>
                    <a class="nav-item nav-link" href="admin-profile.php">
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
                      -Admin
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
                <div class="col-lg-3 bg-light about ">
                    <ul class="nav flex-column stick">
                        <li>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search search-icon" aria-hidden="true"></i></button>
                              </form>
                        </li>
                        <li class="nav-item  pads present">
                          <a class="nav-link" href="#dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item pads bottom">
                          <a class="nav-link" href="user-registration.php">User Registration</a>
                        </li>

                        <li class="nav-item pads">
                             <a class="btn btn-outline-dark" href="logout.php">logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </li>
                      </ul>
                </div>
                <div class="col-lg-8 about bg-white">
                    <div>
                      <h2 id="dashboard" class="Dashboards about">Dashboard</h2>
                        <ul class="list-group margin-center">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                News
                                <span class="badge badge-primary badge-pill">
                                  <?php
                                  $sql= "SELECT COUNT(*) AS news_num FROM news";
                                  $results = mysqli_query($link, $sql);
                                  if (mysqli_num_rows($results) > 0) {
                                      // output data of the specific row
                                      while($row = mysqli_fetch_assoc($results)) {
                                        $repeater= $row["news_num"];
                                        echo $repeater;
                                      }
                                    } else {
                                      echo "0 results";
                                    }


                                   ?>
                                </span>
                              </li>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                Documents
                                <span class="badge badge-primary badge-pill">
                                  <?php
                                  $sql= "SELECT COUNT(*) AS doc_num FROM documents";
                                  $results = mysqli_query($link, $sql);
                                  if (mysqli_num_rows($results) > 0) {
                                      // output data of the specific row
                                      while($row = mysqli_fetch_assoc($results)) {
                                        $repeater= $row["doc_num"];
                                        echo $repeater;
                                      }
                                    } else {
                                      echo "0 results";
                                    }


                                   ?>
                                </span>
                              </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Photos
                              <span class="badge badge-primary badge-pill">
                                <?php
                                $sql= "SELECT COUNT(*) AS photo_num FROM photos";
                                $results = mysqli_query($link, $sql);
                                if (mysqli_num_rows($results) > 0) {
                                    // output data of the specific row
                                    while($row = mysqli_fetch_assoc($results)) {
                                      $repeater= $row["photo_num"];
                                      echo $repeater;
                                    }
                                  } else {
                                    echo "0 results";
                                  }


                                 ?>
                              </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Videos
                              <span class="badge badge-primary badge-pill">
                                <?php
                                $sql= "SELECT COUNT(*) AS vid_num FROM videos";
                                $results = mysqli_query($link, $sql);
                                if (mysqli_num_rows($results) > 0) {
                                    // output data of the specific row
                                    while($row = mysqli_fetch_assoc($results)) {
                                      $repeater= $row["vid_num"];
                                      echo $repeater;
                                    }
                                  } else {
                                    echo "0 results";
                                  }


                                 ?>
                              </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Users
                              <span class="badge badge-primary badge-pill">
                                <?php
                                $sql= "SELECT COUNT(*) AS user_num FROM users";
                                $results = mysqli_query($link, $sql);
                                if (mysqli_num_rows($results) > 0) {
                                    // output data of the specific row
                                    while($row = mysqli_fetch_assoc($results)) {
                                      $repeater= $row["user_num"];
                                      echo $repeater;
                                    }
                                  } else {
                                    echo "0 results";
                                  }


                                 ?>
                              </span>
                            </li>
                          </ul>
                    </div>
                    <br>
                    <div class="about" width="100%">
                        <h2 id="users" class="users">Users</h2>
                        <table class="table" id="user_table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">User_id</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Status</th>
                                <th scope="col">Options</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php

                              // to generate col2, col3, col4 and col5

                                $sql = "SELECT users.user_id, users.email, users.status, user_registration.f_name, user_registration.s_name, users.user_date FROM users INNER JOIN user_registration ON users.email = user_registration.email ORDER BY users.user_date ASC";
                                $result = mysqli_query($link, $sql);

                                        if (mysqli_num_rows($results) > 0) {
                                          while($row = mysqli_fetch_assoc($result)) {
                                          $col1 = "<th scope=\"row\" >" .$row["user_id"] ."</th>";
                                          $col2 = "<td>" .$row["f_name"] ."</td>";
                                          $col3 = "<td>" .$row["s_name"] ."</td>";
                                          $col4 = "<td>" .$row["status"] ."</td>";
                                          $col5 = "<td>
                                          <button id=\"".$row["user_id"] ."\" onClick=\"reply_click(this.id)\" type=\"button\" class=\"btn btn-outline-primary\" data-toggle=\"modal\" data-target=\"#exampleModalLong\">
                                                Change
                                            </button>
                                          </td>
                                          ";
                                          echo "<tr >" .$col1 .$col2 .$col3 .$col4 .$col5 ."</tr>";
                                          }

                                        } else{
                                          echo "nothing to display";
                                        }


                               ?>

                            </tbody>
                          </table>
                          <br>
                          <br>
                          <h2 id="news" class="users">News</h2>
                          <table class="table">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">News_id</th>
                                <th scope="col">News_title</th>
                                <th scope="col">Author</th>

                                <th scope="col">Options</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              // to generate col2, col3, col4 and col5

                                $sql = "SELECT users.user_id, news.news_id, news.news_title, news.news_date FROM news INNER JOIN users ON news.user_id = users.user_id ORDER BY news.news_date ASC";
                                $result = mysqli_query($link, $sql);

                                        if (mysqli_num_rows($results) > 0) {
                                          while($row = mysqli_fetch_assoc($result)) {

                                          $col1 = "<th scope=\"row\" >" .$row["news_id"] ."</th>";
                                          $col2 = "<td>" .$row["news_title"] ."</td>";
                                          $col3 = "<td>" .$row["user_id"] ."</td>";

                                          $col4 = "<td>
                                          <button id=\"".$row["news_id"] ."\" onClick=\"media_reply_click(this.id)\" type=\"button\" class=\"btn btn-outline-danger\" data-toggle=\"modal\" data-target=\"#exampleModalLong1\">
                                              Delete
                                          </button>
                                          ";
                                          echo "<tr>" .$col1 .$col2 .$col3 .$col4 ."</tr>";
                                          }

                                        } else{
                                          echo "nothing to display";
                                        }
                                        ?>
                            </tbody>
                          </table>
                          <br>
                          <br>
                          <h2 id="docs" class="users">Documents</h2>
                          <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">Doc_id</th>
                                <th scope="col">Document_title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Options</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              // to generate col2, col3, col4 and col5

                                $sql = "SELECT users.user_id, documents.doc_id, documents.document, documents.doc_date FROM documents INNER JOIN users ON documents.user_id = users.user_id ORDER BY documents.doc_date ASC";
                                $result = mysqli_query($link, $sql);

                                        if (mysqli_num_rows($results) > 0) {
                                          while($row = mysqli_fetch_assoc($result)) {

                                          $col1 = "<th scope=\"row\" >" .$row["doc_id"] ."</th>";
                                          $col2 = "<td>" .$row["document"] ."</td>";
                                          $col3 = "<td>" .$row["user_id"] ."</td>";

                                          $col4 = "<td>
                                          <button id=\"".$row["doc_id"] ."\" onClick=\"media_reply_click(this.id)\" type=\"button\" class=\"btn btn-outline-danger\" data-toggle=\"modal\" data-target=\"#exampleModalLong1\">
                                              Delete
                                          </button>
                                          ";
                                          echo "<tr>" .$col1 .$col2 .$col3 .$col4 ."</tr>";
                                          }

                                        } else{
                                          echo "nothing to display";
                                        }
                                        ?>


                            </tbody>
                          </table>
                          <br>
                          <br>
                          <h2 id="photos" class="photos">Photos</h2>
                          <table class="table">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">Photo_id</th>
                                <th scope="col">Photo</th>
                                <th scope="col">User</th>
                                <th scope="col">Options</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              // to generate col2, col3, col4 and col5

                                $sql = "SELECT users.user_id, photos.photo_id, photos.photo, photos.photo_date FROM photos INNER JOIN users ON photos.user_id = users.user_id ORDER BY photos.photo_date ASC";
                                $result = mysqli_query($link, $sql);

                                        if (mysqli_num_rows($results) > 0) {
                                          while($row = mysqli_fetch_assoc($result)) {

                                          $col1 = "<th scope=\"row\" >" .$row["photo_id"] ."</th>";
                                          $col2 = "<td>" .$row["photo"] ."</td>";
                                          $col3 = "<td>" .$row["user_id"] ."</td>";

                                          $col4 = "<td>
                                          <button id=\"".$row["photo_id"] ."\" onClick=\"media_reply_click(this.id)\" type=\"button\" class=\"btn btn-outline-danger\" data-toggle=\"modal\" data-target=\"#exampleModalLong1\">
                                              Delete
                                          </button>
                                          ";
                                          echo "<tr>" .$col1 .$col2 .$col3 .$col4 ."</tr>";
                                          }

                                        } else{
                                          echo "nothing to display";
                                        }
                                        ?>

                            </tbody>
                          </table>
                          <br>
                          <h2 id="videos" class="videos">Videos</h2>
                          <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">Video_id</th>
                                <th scope="col">Video</th>
                                <th scope="col">User</th>
                                <th scope="col">Options</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              // to generate col2, col3, col4 and col5

                                $sql = "SELECT users.user_id, videos.vid_id, videos.video, videos.vid_date FROM videos INNER JOIN users ON videos.user_id = users.user_id ORDER BY videos.vid_date ASC";
                                $result = mysqli_query($link, $sql);

                                        if (mysqli_num_rows($results) > 0) {
                                          while($row = mysqli_fetch_assoc($result)) {

                                          $col1 = "<th scope=\"row\" >" .$row["vid_id"] ."</th>";
                                          $col2 = "<td>" .$row["video"] ."</td>";
                                          $col3 = "<td>" .$row["user_id"] ."</td>";

                                          $col4 = "<td>
                                          <button id=\"".$row["vid_id"] ."\" onClick=\"media_reply_click(this.id)\" type=\"button\" class=\"btn btn-outline-danger\" data-toggle=\"modal\" data-target=\"#exampleModalLong1\">
                                              Delete
                                          </button>
                                          ";
                                          echo "<tr>" .$col1 .$col2 .$col3 .$col4 ."</tr>";
                                          }

                                        } else{
                                          echo "nothing to display";
                                        }
                                        ?>

                            </tbody>
                          </table>
                          <br>
                          <br>
                    </div>
                </div>
                <!-- User -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">User status</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                      <div class="modal-body">
                          <form class="form-signin" action="change-status.php" method="post">

                            <label class="" for="user_id">User_Id</label>
                            <input id="user_id" class="form-control" type="text" name="user_id"   ><br>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="active" >
                              <label class="form-check-label" for="exampleRadios1">
                                Active
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="deactivated">
                              <label class="form-check-label" for="exampleRadios2">
                                Deactivated
                              </label>
                            </div>

                           </div>
                           <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <input type="submit" value="Change status" name="submit" class="btn btn-primary">
                           </div>
                          </form>

                  </div>
                  </div>
              </div>

              <!-- News,Documents,Photos,Videos  -->
              <div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                      <p>Are you sure you want to delete this ?<br>This action is permanent!</p>
                    </div>
                    <div class="modal-footer">
                      <form class="" action="delete-media.php" method="post">
                        <input type="hidden" name="media_id" id="media">
                        <input type="submit" value="Yes" name="submit" class="btn btn-primary">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                      </form>

                    </div>
                </div>
                </div>
              </div>

            </div>
        </div>
    </div>
    <div class="container-fluid bg-white">
        <div class="container">
            <div class="">
                <p class="text-primary note">© 2020 - All Rights Reserved - Mathare Peace Initiative</p>
                <br>
                <p class="text-secondary lil-note">Osuka Technologies</p>
            </div>
        </div>
    </div>
<!-- closing link -->
<<?php mysqli_close($link) ;?>
    <!-- Main JS file -->
    <script src="../js/index.js" charset="utf-8"></script>
    <!-- Font awesome -->
    <script src="https://use.fontawesome.com/224ebf5ddd.js"></script>
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
