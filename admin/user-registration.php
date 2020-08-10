<?php
// Include config file
  require_once "config.php";
  require_once "register.php";
  include_once "loginer.php";
  // Check if the user is already logged in, if not then redirect user to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../admin/login.php");
    exit;
  }



?>
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
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                  </div>
                </div>
              </nav>
        </div>
    </div>
    <div class="container-fluid bg-light">
        <div class="container">
            <div class="row ">
                <div class="col-lg-3 bg-light about">
                    <ul class="nav flex-column stick">
                        <li>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search search-icon" aria-hidden="true"></i></button>
                              </form>
                        </li>
                        <li class="nav-item  pads bottom">
                          <a class="nav-link" href="admin.php">Dashboard</a>
                        </li>
                        <li class="nav-item pads present">
                          <a class="nav-link" href="#">User Registration</a>
                        </li>

                        <li class="nav-item pads">
                          <a class="btn btn-outline-dark" href="../admin/logout.php">logout <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </li>
                      </ul>
                </div>
                <div class="col-lg-8 about bg-white">
                    <h3 class="text-dark margin-center ml-auto">
                        <p class="">Register a new user  </p>

                    </h3>
                    <div class="row"></div>
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10 border bg-white card" >
                            <form class="form-signin  about pl-2" action="register.php" method="post">
                                <img class="mb-4" src="../media/mpi image.jpg" alt="" width="200" height="72">
                                <h1 class="h3 mb-3 font-weight-normal">Enter user details</h1>
                                <label for="inputUser" class="sr-only">Email address</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email address" required="" autofocus="">
                                <span class="help-block"><?php echo $email_err; ?></span>
                                <br>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $f_name; ?>" placeholder="First name">
                                <span class="help-block"><?php echo $f_name_err; ?></span>
                                <br>
                                <input type="text" name="s_name" class="form-control" value="<?php echo $s_name; ?>" placeholder="Second-name" required="" autofocus="">
                                <span class="help-block"><?php echo $s_name_err; ?></span>
                                <br>
                                <select id="cars" class="dropdown show bg-light  form-control" name="category" value="<?php echo $category; ?>"required="">
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <option class="dropdown-item" value="disabled">--category--</option>
                                        <option class="dropdown-item" value="admin">Admin</option>
                                        <option class="dropdown-item" value="x_user">Extended user</option>
                                        <option class="dropdown-item" value="user">Normal user</option>
                                    </div>
                                </select>
                                <span class="help-block"><?php echo $category_err; ?></span>
                                <br>
                                <div class="checkbox mb-3 note">
                                    <label>
                                    <input type="checkbox" value="remember-me" required=""> I agree to terms and conditions
                                    </label>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
                                <br>
                                <input type="reset" class="btn  btn-lg btn-secondary btn-block" value="Reset">
                            </form>
                        </div>
                        <div class="col-lg-1"></div>

                        </div>

            </div
            <!-- User id pop up -->

        </div>
    </div>
    <div class="container-fluid bg-white">
        <div class="container">
            <div class="bg-white">
                <p class="text-primary note">© 2020 - All Rights Reserved - Mathare Peace Initiative</p>
                <br>
                <p class="text-secondary lil-note">Osuka Technologies</p>
            </div>
        </div>
    </div>

    <!-- Font awesome -->
    <script src="https://use.fontawesome.com/224ebf5ddd.js"></script>
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
