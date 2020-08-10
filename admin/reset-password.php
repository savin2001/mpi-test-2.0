<?php
// Initialize the session
//include_once "loginer.php";
require_once 'reseter.php';
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
    <div class="container-fluid about bg-light">
        <div class="container">
            <div class="row"></div>
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 border bg-white card">
                  <center>
                    <img class="mb-4" src="../media/mpi image.jpg" alt="" width="200" height="72">
                  </center>
                    <h2 class="h3 mb-3 font-weight-normal"><?php echo htmlspecialchars($_SESSION["user_id"]); ?> <br>Reset Password</h2>
                    <p>Please fill out this form to reset your password.</p>
                    <form class="form-signin  about pl-2" action="reseter.php" method="post">
                      <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                          <label class="sr-only">Current Password</label>
                          <input type="password" name="old_password" class="form-control" placeholder="Current Password" required="" value="<?php echo $new_password; ?>">
                          <span class="help-block"><?php echo $new_password_err; ?></span>
                      </div>
                        <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                            <label class="sr-only">New Password</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Password" required="" value="<?php echo $new_password; ?>">
                            <span class="help-block"><?php echo $new_password_err; ?></span>
                        </div>
                        <br>
                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label class="sr-only">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" required="">
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Submit">
                            <a class="btn btn-lg btn-secondary btn-block" href="logout.php">Cancel</a>
                        </div>
                    </form>
                </div>
</body>
</html>
