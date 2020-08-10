<?php
    // Include config file
    require_once "config.php";
    require "loginer.php";
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Mathare Peace Initiative-Kenya</title>
</head>
<body class="text-center">
    <div class="container-fluid bg-light about">
        <div class="container">
            <div class="row"></div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 border bg-white card">
                    <form class="form-signin  about pl-2" >
                        <img class="mb-4" src="../media/mpi image.jpg" alt="" width="200" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Welcome
                          <?php
                              $sql = "SELECT *  from user_registration ORDER BY reg_date DESC LIMIT 1";
                              $result = mysqli_query($link, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                  // output data of the specific row
                                  while($row = mysqli_fetch_assoc($result)) {
                                    echo  $row["f_name"];
                                  }
                                } else {
                                  echo "no results";
                                }


                         ?>
                       </h1>
                        <p>Your UserID is <b>
                          <?php
                              $sqli = "SELECT *  from users ORDER BY user_date DESC LIMIT 1";
                              $results = mysqli_query($link, $sqli);
                              if (mysqli_num_rows($results) > 0) {
                                  // output data of the specific row
                                  while($row = mysqli_fetch_assoc($results)) {
                                    echo  $row["user_id"];
                                  }
                                } else {
                                  echo "0 results";
                                }
                                mysqli_close($link);

                           ?>
                        </b></p>
                        <p>Your Password is <b>12345678</b></p>
                        <a class="btn btn-lg btn-primary " href="admin.php">Confirm</a>
                        <a class="btn  btn-lg btn-danger text-white"  href="delete.php">Delete</a>
                        <p class="mt-5 mb-3 text-muted note">© 2020 - ALL RIGHTS RESERVED - MATHARE PEACE INITIATIVE</p>
                        <p class="text-secondary lil-note">Osuka Technologies</p>
                    </form>
                </div>
                <div class="col-lg-4"></div>
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
