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
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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
                <div class="col-lg-3 bg-light about ml-auto ">
                    <ul class="nav flex-column stick ">
                        <li>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search search-icon" aria-hidden="true"></i></button>
                              </form>
                        </li>
                        <li class="nav-item  pads present">
                          <a class="nav-link" href="#">News</a>
                        </li>
                        <li class="nav-item pads bottom">
                          <a class="nav-link" href="x-user-photos.php">Photos</a>
                        </li>
                        <li class="nav-item pads bottom">
                            <a class="nav-link" href="x-user-video.php">Videos</a>
                        </li>
                        <li class="nav-item pads bottom">
                            <a class="nav-link" href="x-user-doc.php">Documents</a>
                        </li>
                        <li class="nav-item pads">
                          <a class="btn btn-outline-dark" href="../admin/logout.php">logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </li>
                      </ul>
                </div>
                <div class="col-lg-7 about bg-white ">
                    <h3 class="text-dark margin-center ml-auto">
                            <p >Create a new post
                                <!-- Large modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                            </p>
                    </h3>

                    <h3 class="ml-auto">
                        <p class="text-primary">Recent posts </p>

                    </h3>
                    <ul class="list-unstyled">
                      <?php
                      $sql = "SELECT  	news.news_id,	news.category,	news.news_title,	news.content,	news.news_date,	news.user_id,	news.news_photo,	news.news_path, users.user_id, user_registration.f_name, user_registration.s_name FROM news INNER JOIN users ON news.user_id = users.user_id INNER JOIN user_registration ON users.email = user_registration.email " ;//.$user_id
                      $result = mysqli_query($link, $sql);

                      if (mysqli_num_rows($result)) {
                          // output data of the specific row
                          while($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div id='.$row["news_id"] .' class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative box-sh">
                                <div class="col-auto d-none d-lg-block">
                                  <img src="../admin/'.$row["news_path"] .'" class="bd-placeholder-img" width="200" >
                                </div>
                                <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary">'.$row["category"] .'</strong>
                                <h3 class="mb-0">'.$row["news_title"] .'</h3>
                                <div class="mb-1 text-muted">'.$row["news_date"] .'</div>
                                <p class="card-text mb-auto post-content" >
                                  '.substr($row["content"], 0, 100) .'...
                                </p>
                                <a href="../news/news-presentation.php#'.$row["news_id"] .'" class="stretched-link">Continue reading</a>
                                </div>
                            </div>
                            ';
                          }
                        }


                       ?>


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
                <div class="col-lg-2 about bg-light ">
                    <div class="p-4 stick">
                        <h4 class="font-italic">My posts</h4>
                        <ol class="list-unstyled mb-0">
                          <?php
                          //fetching and diplaying of videos from database
                          $sql = "SELECT * FROM news WHERE user_id = '$sess_user'";
                          $results = mysqli_query($link, $sql);
                          while ($row = mysqli_fetch_array($results)) {
                            echo '
                                <li><a href="#'.$row["news_id"].'">'.$row["news_title"].'</a></li>
                                  <br>
                            ';
                            }

                            ?>
                        </ol>
                      </div>
                </div>
            </div>
            <!-- CKEditor -->
            <div class="about modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10">
                                  <form action="../admin/news_upload.php" method="post" enctype="multipart/form-data">
                                    <select id="cars" class="dropdown show bg-light form-control" name="category">
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <option class="dropdown-item" value="disabled">--category--</option>
                                            <option class="dropdown-item" value="Disaster relief">Disaster relief</option>
                                            <option class="dropdown-item" value="Food distribution">Food distribution</option>
                                            <option class="dropdown-item" value="Food donation">Food donation</option>
                                            <option class="dropdown-item" value="Peace building">Peace building</option>
                                            <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Uncategorized</a>
                                            </div>
                                        </div>
                                    </select>
                                    <br>
                                    <input type="text" name="news_title" class="form-control"  placeholder="News title" required="">
                                    <br>
                                    <textarea class="ckeditor form-control" cols="80" id="editor1" name="editor1" rows="10">
                                        <script>
                                        CKEDITOR.replace( 'editor1' );
                                        </script>
                                    </textarea>
                                    <br>

                                        <div class="form-group form-control">
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fileToUpload">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button  class="btn btn-primary" type="submit" >Post article</button>
                                          </div>
                                    </form>
                                </div>
                                <div class="col-lg-1"></div>
                            </div>
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

    <!-- closing link -->
    <<?php mysqli_close($link) ;?>
    <!-- Main JS -->

    <!-- Font awesome -->
    <script src="https://use.fontawesome.com/224ebf5ddd.js"></script>
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
