<?php // Initialize the session
session_start();



// Include config file
require_once "config.php";
// include "login.php";


// Define variables and initialize with empty values
$user_id = $password = "";
$user_id_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if user_id is empty
    if(empty(trim($_POST["user_id"]))){
        $user_id_err = "Please enter user_id.";
    } else{
        $user_id = trim($_POST["user_id"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);

    }



    // Validate credentials
    if(empty($user_id_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_id, password FROM users WHERE user_id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user_id);

            // Set parameters
            $param_user_id = $user_id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if user_id exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $user_id, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){


echo $user_id;
$sql = "SELECT users.user_id, users.email, user_registration.category, users.status FROM users INNER JOIN user_registration ON users.email = user_registration.email WHERE users.user_id =  '$user_id'" ;//.$user_id
                                                      $result = mysqli_query($link, $sql);

                                                      if (mysqli_num_rows($result)) {
                                                          // output data of the specific row
                                                          while($row = mysqli_fetch_assoc($result)) {
                                                            // Password is correct, so start a new session
                                                            $category = $row["category"];
                                                            $status = $row["status"];
                                                            session_start();


                                                           // Store data in session variables
                                                           if ($status=="active") {
                                                             $_SESSION["loggedin"] = true;

                                                           }else {
                                                             $_SESSION["loggedin"] = false;
                                                             echo "This user account is deactivated";
                                                           }

                                                           $_SESSION["user_id"] = $user_id;
                                                           // Redirect user to welcome page


                                                           if ($category == "x_user") {
                                                             //to reset password for new users
                                                             if ($password == "12345678") {
                                                               header("location: reset-password.php");
                                                             } else{
                                                             header("location: ../x-user/x-user-profile.php");
                                                           }
                                                             exit;

                                                           } elseif ($category == "admin") {
                                                             //to reset password for new users
                                                             if ($password == "12345678") {
                                                               header("location: reset-password.php");
                                                             } else{
                                                             header("location: admin-profile.php");
                                                           }
                                                             exit;
                                                           } elseif ($category == "user") {
                                                             //to reset password for new users
                                                             if ($password == "12345678") {
                                                               header("location: reset-password.php");
                                                             } else{
                                                             header("location: ../user/user-profile.php");
                                                           }
                                                             exit;
                                                           } else {
                                                             echo "impossible";
                                                           }



                                                         }//end while
                                                        } else {
                                                          echo "0 results";
                                                        }


                        } else{
                            // Display an error message if password is not valid
                            echo "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if user_id doesn't exist
                    echo "No account found with that user_id.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
} ?>
