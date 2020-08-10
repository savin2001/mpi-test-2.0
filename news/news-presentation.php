<?php
include "../admin/config.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../media/mpi.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <title>Mathare Peace Initiative-Kenya</title>
</head>
<body>
     <!-- navigation panel -->
     <nav class="container-fluid navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="../media/mpi image.jpg"  height="50px" alt="mpi-logo"> </a>

            <!-- toggle button for smaller screen sizes -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <!-- navigation links -->
            <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item bottom">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
                <li class="nav-item bottom">
                    <a class="nav-link" href="../about-us.html">About us</a>
                </li>
                <li class="nav-item bottom">
                    <a class="nav-link " href="../our-programs.html">Our programs </a>
                </li>
                <li class="nav-item bottom">
                    <a class="nav-link" href="../gallery.php" >Gallery</a>
                </li>
                <li class="nav-item bottom">
                    <a class="nav-link" href="../news.php">News</a>
                </li>
                <li class="nav-item bottom">
                    <a class="nav-link" href="#Contact">Contact us</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <div class="">
                    <input class="form-control mr-sm-2 search-border" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-dark my-2 my-sm-0 search-btn" type="submit"><i class="fa fa-search search-icon" aria-hidden="true"></i></button>
                </div>

            </form>
            </div>
        </div>
      </nav>
      <!-- End of navigation panel -->

      <!-- Blog reading -->
      <div class="container-fluid">
          <div class="container about">
            <div class="row">
              <aside class="col-md-4 blog-sidebar">
                <div class="p-4">
                  <h4 class="font-italic">Archives</h4>
                  <ol class="list-unstyled mb-0">
                    <?php
                    $sql = "SELECT  	news.news_id,	news.category,	news.news_title,	news.content,	news.news_date,	news.user_id,	news.news_photo,	news.news_path, users.user_id, user_registration.f_name, user_registration.s_name FROM news INNER JOIN users ON news.user_id = users.user_id INNER JOIN user_registration ON users.email = user_registration.email " ;//.$user_id
                    $result = mysqli_query($link, $sql);

                    if (mysqli_num_rows($result)) {
                        // output data of the specific row
                        while($row = mysqli_fetch_assoc($result)) {
                          $news_id = $row["news_id"];
                          $news_title = $row["news_title"];
                          echo '
                              <li><a href="?id = '.$news_id .'">'.$news_title.'</a></li>
                              ';

                          }
                        }
                        ?>
                  </ol>
                </div>
              </aside>

                <!-- /.blog-sidebar -->
                <div class="col-md-8 blog-main" >
                  <?php
                  
                  $sql = "SELECT  	news.news_id,	news.category,	news.news_title,	news.content,	news.news_date,	news.user_id,	news.news_photo,	news.news_path, users.user_id, user_registration.f_name, user_registration.s_name FROM news INNER JOIN users ON news.user_id = users.user_id INNER JOIN user_registration ON users.email = user_registration.email ";//.$user_id
                  $result = mysqli_query($link, $sql);

                  if (mysqli_num_rows($result)) {
                      // output data of the specific row
                      while($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <div id="'.$row["news_id"] .'" style="display : block; overflow : hidden; ">
                        <h3 class="pb-4 mb-4 font-italic border-bottom">
                          From the '.$row["category"] .'
                        </h3>

                        <div class="blog-post">
                          <center>
                            <h2 class=" text-primary " >'.$row["news_title"] .'</h2>
                          </center>
                          <p class="blog-post-meta ml-4 font-italic">'.$row["news_date"] .' by '.$row["f_name"] .' '.$row["s_name"] .'</p> <br>
                          '.$row["content"] .'

                          <div class="img-fluid">
                              <img width="100%" src="../admin/'.$row["news_path"] .'" alt="">
                          </div>
                          <br>
                        </div><!-- /.blog-post -->

                        <nav class="blog-pagination">
                          <a class="btn btn-outline-secondary" href="#">Older</a>
                          <a class="btn btn-outline-primary " href="#">Newer</a>
                        </nav>
                        </div?>
                        <br>
                        <br>


                        ';

                      }
                    } else {
                      echo "Select news from the archives";
                    }
                   ?>


                </div><!-- /.blog-main -->



              </div>
          </div>
      </div>
      <!-- End of blog reading -->

    <!-- Footer -->
    <footer>
        <div class="container-fluid footer-bg bg-primary col-lg-12">
            <div class="container">
                <div class="row  text-white">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="visit">Visit us</h4>
                        <p> P.O. Box 6461 00300 Nairobi Kenya</p>
                        <p> +254 722 419 980</p>
                        <p> info@mpi-kenya.org</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="visit">Latest</h4>
                        <p>Tenants dialogue with regards to COVID-19</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="visit">Visit us</h4>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="visit">Visit us</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="socials navbar navbar-expand-lg text-white bg-dark">
            <p class="paddings">Sign up NewsLetter</p>
            <div class="sign-up">
                <form class="form-inline my-2 my-lg-0 paddings">
                    <div class="">
                        <input class="form-control mr-sm-2 " type="search" placeholder="info@mpi.kenya" aria-label="Search">
                        <button class="btn btn-primary my-2 my-sm-0 " type="submit">Subscribe</i></button>
                    </div>

                </form>
            </div>
            <div id="Contact" class="ml-auto">
                <ul class="navbar-nav ml-auto">
                    <p>Stay in touch</p>
                    <li class="nav-item">
                        <a class="nav-link" href="https://web.facebook.com/matharepeaceinitiativekenya/?_rdc=1&_rdr"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="https://twitter.com/mpi_kenya?lang=en"><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://ke.linkedin.com/in/mathare-initiative-kenya-bb3a76122?trk=public_profile_browsemap_profile-result-card_result-card_full-click&challengeId=AQHSaG4a9nRgDwAAAXNmlnlDgeDD5Sg6N3Sci2u_8Z-vli_g2qFN0r8wvD0vqBHe5exSLr3OKcguvn0ZyIy40Sx3pdX3PW6zTQ&submissionId=03b25284-1d20-2316-35bb-4a229948ba26"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mailto:mathareinitiativeforpeace@gmail.com"><i class="fa fa-google-plus-square fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bg-light">
            <p class="text-primary note">© 2020 - All Rights Reserved - Mathare Peace Initiative</p>
            <br>
            <p class="text-secondary lil-note">Osuka Technologies</p>
        </div>
    </footer>
    <!-- End of footer -->

    <!-- Font awesome -->
    <script src="https://use.fontawesome.com/224ebf5ddd.js"></script>
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
