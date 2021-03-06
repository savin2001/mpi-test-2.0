<?php

include "loginer.php";
$conn = mysqli_connect('localhost', 'root', '', 'mpi_kenya_db');
$target_dir = "doc-upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx"
&& $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "accdb" && $imageFileType != "pptx" && $imageFileType != "odt") {
  echo "Sorry, only PDF, DOC, DOCX, XLS, XLSX, ACCDB, PPTX & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  //assigning values
  $filesize = $_FILES["fileToUpload"]["size"];
  $photo = $_FILES["fileToUpload"]["name"];
  $sess_user = htmlspecialchars($_SESSION["user_id"]);
  date_default_timezone_set("Africa/Nairobi");
  $now = date("Y-m-d H:i:sa");
  //insert into database
  $sql = "INSERT INTO documents (document, doc_date, user_id, doc_path, doc_size) VALUES ('$photo', '$now', '$sess_user', '$target_file', '$filesize')";
  mysqli_query($conn, $sql);


//insert photos to folder
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    $sql = "SELECT users.user_id, users.email, user_registration.category FROM users INNER JOIN user_registration ON users.email = user_registration.email WHERE users.user_id =  '$sess_user'" ;//.$user_id
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)) {
        // output data of the specific row
        while($row = mysqli_fetch_assoc($result)) {
          // Password is correct, so start a new session
          $category = $row["category"];
          if ($category == "x_user") {
            header("location: ../x-user/x-user-doc.php");
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
// Close connection
mysqli_close($conn);

?>
