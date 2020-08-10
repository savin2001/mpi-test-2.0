<?php
require_once "config.php";
session_start();



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  // Check if category, title and content is empty
  if(empty(trim($_POST["category"]))){
      $category_err = "Please enter category.";
  } else{
      $category = trim($_POST["category"]);
  }
  if(empty(trim($_POST["news_title"]))){
      $news_title_err = "Please enter news title.";
  } else{
      $news_title = trim($_POST["news_title"]);
  }
  if(empty(trim($_POST["editor1"]))){
      $content_err = "Please enter content.";
  } else{
      $content = trim($_POST["editor1"]);
  }
//photo
  $target_dir = "news-upload/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  $photo = $_FILES["fileToUpload"]["name"];


    //set time
    date_default_timezone_set("Africa/Nairobi");
    $news_date = date("Y-m-d H:i:s");

    $sess_user = $_SESSION["user_id"];
    // Check input errors before inserting in database
    if(empty($category_err) && empty($news_title_err) && empty($content_err)){

      //insert into database
      $sql = "INSERT INTO news (category, news_date, user_id, news_title, content, news_photo, news_path) VALUES ('$category', '$news_date', '$sess_user', '$news_title', '$content', '$photo', '$target_file')";
      mysqli_query($link, $sql);
    }
    //insert photos to folder
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $sql = "SELECT users.user_id, users.email, user_registration.category FROM users INNER JOIN user_registration ON users.email = user_registration.email WHERE users.user_id =  '$sess_user'" ;//.$user_id
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result)) {
            // output data of the specific row
            while($row = mysqli_fetch_assoc($result)) {
              // Password is correct, so start a new session
              $category = $row["category"];
              if ($category == "x_user") {
                header("location: ../x-user/x-user.php");
                exit;

              } elseif ($category == "user") {
                header("location: ../user/user.php");
                exit;
              } else {
                echo "impossible";
              }
            }
          }


      } else {
        echo "Sorry, there was an error uploading your file.";
      }

  }
}



 ?>
