<?php
include "admin/config.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="media/mpi.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="/css/admin.css">
    <title>Mathare Peace Initiative-Kenya</title>
</head>
<body>
     <!-- navigation panel -->
     <nav class="container-fluid navbar sticky-top navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="media/mpi image.jpg"  height="50px" alt="mpi-logo"> </a>

            <!-- toggle button for smaller screen sizes -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <!-- navigation links -->
            <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item bottom">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item bottom">
                    <a class="nav-link" href="about-us.html">About us</a>
                </li>
                <li class="nav-item bottom">
                    <a class="nav-link color-prime" href="our-programs.html">Our programs <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item bottom">
                    <a class="nav-link" href="gallery.php" >Gallery</a>
                </li>
                <li class="nav-item active present">
                    <a class="nav-link color-prime" href="#">News <span class="sr-only">(current)</span></a>
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

      <!-- News section -->
      <div class="container-fluid">
          <div class="container about">
              <div class="row">
                  <div class="col-md-4 ">
                    <div class="p-4 categories stick">
                        <h4 class="font-italic text-primary ">Categories</h4>
                        <ol class="list-unstyled mb-0">
                          <li><a href="#">Disaster relief</a></li>
                          <li><a href="#">Food distrubution</a></li>
                          <li><a href="#">Food donation</a></li>
                          <li><a href="#">Peace building</a></li>
                          <li><a href="#">Uncategorized</a></li>
                        </ol>
                      </div>
                  </div>
                  <div class="col-md-8">
                    <ul class="list-unstyled " >
                      <?php
                      $sql = "SELECT  	news.news_id,	news.category,	news.news_title,	news.content,	news.news_date,	news.user_id,	news.news_photo,	news.news_path, users.user_id, user_registration.f_name, user_registration.s_name FROM news INNER JOIN users ON news.user_id = users.user_id INNER JOIN user_registration ON users.email = user_registration.email " ;//.$user_id
                      $result = mysqli_query($link, $sql);

                      if (mysqli_num_rows($result)) {
                          // output data of the specific row
                          while($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative box-sh">
                                <div class="col-auto d-none d-lg-block">
                                  <img src="admin/'.$row["news_path"] .'" class="bd-placeholder-img" width="200" >
                                </div>
                                <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary">'.$row["category"] .'</strong>
                                <h3 class="mb-0">'.$row["news_title"] .'</h3>
                                <div class="mb-1 text-muted">'.$row["news_date"] .'</div>
                                <p class="card-text mb-auto post-content" >
                                  '.substr($row["content"], 0, 100) .'...
                                </p>
                                <a href="news/news-presentation.php#'.$row["news_id"] .'" class="stretched-link">Continue reading</a>
                                </div>
                            </div>
                            ';
                          }
                        }
                       ?>
                       <br>
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
            </div>
          </div>
      </div>

      <!-- End of news section -->

    <!-- Footer -->
    <footer>
      <div class="container-fluid footer-bg bg-primary">
          <div class="container">
              <div class="row  text-white">
                  <div class="col-lg-4 col-md-6">
                      <h4 class="visit">Contact us</h4>
                      <p> P.O. Box 6461 00300 Nairobi Kenya</p>
                      <p> +254 722 419 980</p>
                      <p> info@mpikenya.org</p>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <h4 class="visit">Visit us </h4>
                      <p>Huruma(Kwa Chief)</p>
                      <p>Inside Undugu Society of Kenya</p>
                      <p>Behind Mathare Sub-County headquarter</p>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <h4 class="visit">Our focus</h4>
                      <p>Consultative, inclusive and decisive</p>
                      <p>Respectful, disciplined and results-oriented</p>
                      <p>Transparent, honest and sincere</p>
                  </div>
              </div>
          </div>
      </div>
        <div class="socials navbar navbar-expand-lg text-white bg-dark">
          <div class="row  p-4">
                <p class="paddings">Sign up NewsLetter</p>
                <div class="sign-up">
                    <form class="form-inline my-2 my-lg-0 paddings">
                        <div class="">
                            <input class="form-control mr-sm-2 " type="search" placeholder="info@mpi.kenya" aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0 " type="submit">Subscribe</i></button>
                        </div>

                    </form>
                </div>
                <div id="Contact" >

                        <p class="paddings">Stay in touch</p>
                        <br>


                            <a class="my-2 my-lg-0 paddings" href="https://web.facebook.com/matharepeaceinitiativekenya/?_rdc=1&_rdr"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
                            </a>


                            <a class="my-2 my-lg-0 paddings" href="https://twitter.com/mpi_kenya?lang=en"><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i>
                            </a>

                            <a class="my-2 my-lg-0 paddings" href="https://ke.linkedin.com/in/mathare-initiative-kenya-bb3a76122?trk=public_profile_browsemap_profile-result-card_result-card_full-click&challengeId=AQHSaG4a9nRgDwAAAXNmlnlDgeDD5Sg6N3Sci2u_8Z-vli_g2qFN0r8wvD0vqBHe5exSLr3OKcguvn0ZyIy40Sx3pdX3PW6zTQ&submissionId=03b25284-1d20-2316-35bb-4a229948ba26"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i>
                            </a>

                            <a class="my-2 my-lg-0 paddings" href="mailto:mathareinitiativeforpeace@gmail.com"><i class="fa fa-google-plus-square fa-2x" aria-hidden="true"></i>
                            </a>

                            <a class="my-2 my-lg-0 paddings" href="mailto:info@mpi.kenya"><i class="fa fa-inbox fa-2x" aria-hidden="true"></i>
                            </a>

                  </div>
              </div>
        </div>
        <div class="bg-light">
          <p class="text-primary note"><a class="nav-link" href="admin/login.php">© 2020 - All Rights Reserved - Mathare Peace Initiative</a></p>
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
