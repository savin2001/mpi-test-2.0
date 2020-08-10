<?php
// Define variables and initialize with empty values
require_once "config.php";
$email = $f_name = $s_name = $category = "";
$email_err = $f_name_err = $s_name_err = $category_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM user_registration WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email already exists.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate email and names
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    if(empty(trim($_POST["f_name"]))){
        $f_name_err = "Please enter first name.";
    } else{
        $f_name = trim($_POST["f_name"]);
    }
    if(empty(trim($_POST["s_name"]))){
        $s_name_err = "Please enter second name.";
    } else{
        $s_name = trim($_POST["s_name"]);
    }
    if(empty(trim($_POST["category"]))){
        $category_err = "Please select the category.";
    } else{
        $category = trim($_POST["category"]);
    }
    date_default_timezone_set("Africa/Nairobi");
    $reg_date = date("Y-m-d H:i:s");
    // Check input errors before inserting in database
    if(empty($email_err) && empty($f_name_err) && empty($s_name_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO user_registration (email, f_name,s_name,category, reg_date) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_email, $param_fName,$param_sName,$param_category, $param_regDate);

            // Set parameters
            $param_email = $email;
            $param_fName = $f_name;
            $param_sName = $s_name;
            $param_category = $category;
            $param_regDate = $reg_date;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
              // Variable declaration
              $first_name = $_POST["f_name"];
              $second_name = $_POST["s_name"];
              // Generating user id
              function userIdGen($first, $second){
                // Slicing the name strings
                function strSlice($str, $start, $end ){
                  $end = $end - $start;
                  return substr($str, $start, $end);
                }

                // Introducing random number generation
                $rand = rand(100, 1000) - 1;

                return strSlice($first, 0, 2) .strtoupper(strSlice($second, 0, 2)) .$rand;

              }

              // Running the function
              $userId = userIdGen($first_name, $second_name);
              $password = 12345678;
              date_default_timezone_set("Africa/Nairobi");
              $now = date("Y-m-d H:i:sa");
              // MySQL statement
              $sql = "INSERT INTO users (user_id, email, password, user_date) VALUES (?, ?, ?, ?)";
              if($stmt = mysqli_prepare($link, $sql)){
                  // Bind variables to the prepared statement as parameters
                  mysqli_stmt_bind_param($stmt, "ssss", $param_userId, $param_email, $param_password, $param_date);

                  // Set parameters
                  $param_userId = $userId;
                  $param_email = $email;
                  $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                  $param_date = $now;
                  // Attempt to execute the prepared statement
                  if(mysqli_stmt_execute($stmt)){
                      // Redirect to login page
                      header("location: template.php");
                  } else{
                      echo "Something went wrong. ";
                  }

                  // Close statement
                  mysqli_stmt_close($stmt);
              }


            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Close connection
    mysqli_close($link);
}
 ?>
