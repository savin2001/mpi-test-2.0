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
                    <a class="nav-item nav-link" href="x-user-profile.php">
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
                <div class="col-lg-3  about ml-auto ">
                    <ul class="nav flex-column stick">
                        <li>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search search-icon" aria-hidden="true"></i></button>
                              </form>
                        </li>
                        <li class="nav-item pads bottom">
                          <a class="nav-link" href="x-user.php">News</a>
                        </li>
                        <li class="nav-item pads present">
                          <a class="nav-link" href="#">Photos</a>
                        </li>
                        <li class="nav-item pads bottom">
                            <a class="nav-link" href="x-user-video.php">Videos</a>
                        </li>
                        <li class="nav-item pads bottom">
                            <a class="nav-link" href="x-user-doc.php">Documents</a>
                        </li>
                        <li class="nav-item pads">
                            <button type="button" class="btn btn-outline-primary"><a class="" href="../admin/logout.php">logout<i class="fa fa-sign-out" aria-hidden="true"></i></a></button>
                        </li>
                      </ul>
                </div>
                <div class="col-lg-7 about bg-white">
                    <ul class="list-unstyled">
                        <h3 class="text-dark margin-center ml-auto">
                          <p class="">Upload new photos <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalLong">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                         </p>

                        </h3>
                        <h3 class="ml-auto">
                            <p class="text-primary">Recent photos </p>

                        </h3>
                        <div class="row">
                        <?php
                        //fetching and diplaying of photos from database
                        $sql = "SELECT * FROM photos WHERE user_id = '$sess_user'";
                        $results = mysqli_query($link, $sql);
                        while ($row = mysqli_fetch_array($results)) {
                          echo "
                          <div  class=\"col-lg-4 col-md-6  padding-con\">
                              <div class=\"card\" style=\"width: 100%;\">
                                  <img src="."../admin/".$row['photo_path'] ." class=\"card-img-top\" alt=\"...\">
                                  <div class=\"card-body\">
                                    <h5 class=\"card-title\"><small>".$row['photo']."</small></h5>
                                    <button id=".$row['photo_id']." onClick=\"media_reply_click(this.id)\" type=\"button\" class=\"btn btn-outline-danger\" data-toggle=\"modal\" data-target=\"#exampleModalLong1\">
                                      <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
                                    </button>
                                  </div>
                                </div>
                          </div>
                          <br>

                          ";
                        }
                         ?>

                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </ul>
                </div>
                <div class="col-lg-2 about ">
                  <div class="p-4 stick">
                    <h4 class="font-italic">My photos</h4>
                    <ol class="list-unstyled mb-0">
                      <?php
                      //fetching and diplaying of photos from database
                      $sql = "SELECT * FROM photos WHERE user_id = '$sess_user'";
                      $results = mysqli_query($link, $sql);
                      while ($row = mysqli_fetch_array($results)) {
                        echo '
                              <li><a href="../admin/'.$row['photo_path'] .'">'.$row['photo'] .'</a></li>

                        ';
                      }
                       ?>
                   </ol>
                 </div>
                </div>
            </div>

              <!-- Photos upload -->
              <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Choose photo(s)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="../admin/photo_upload.php" method="post" enctype="multipart/form-data">
                            <div class="form-group form-control">
                              <input type="file" name="fileToUpload" class="form-control-file" id="exampleFormControlFile1">

                            </div>
                            <br>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                    <input type="submit" value="Post photo" name="submit" class="btn btn-primary">
                            </form>
                      </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- Photos deleting -->
            <div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-body">
                    <p>Are you sure you want to delete this ?<br>This action is permanent!</p>
                  </div>
                  <div class="modal-footer">
                    <form class="" action="x-user-delete-media.php" method="post">
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

    <div class="container-fluid">
        <div class="container">
            <div class="bg-white">
                <p class="text-primary note">© 2020 - All Rights Reserved - Mathare Peace Initiative</p>
                <br>
                <p class="text-secondary lil-note">Osuka Technologies</p>
            </div>
        </div>
    </div>

    <!-- mainJS -->
<script src="../js/index.js" charset="utf-8"></script>
    <!-- Font awesome -->
    <script src="https://use.fontawesome.com/224ebf5ddd.js"></script>
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
