<?php
include "../admin/config.php";
if(isset($_POST["submit"])) {
  $media_id = $_POST["media_id"];
  if ($media_id >= 1000 && $media_id < 2000) {
    //delete news image from folder
    $sql = "SELECT * FROM news WHERE news_id = '$media_id'";
    $results  = mysqli_query($link, $sql);
    if (mysqli_num_rows($results ) > 0) {
      while($row = mysqli_fetch_assoc($results )) {
        // unlink("../admin/" .$row["photo_path"]);
      }
    }
    //delete article from database
    $sqli = "DELETE FROM news WHERE news_id = '$media_id'";
    mysqli_query($link, $sqli);
  } elseif ($media_id >= 2000 && $media_id < 3000) {
    //delete photo from folder
    $sql = "SELECT * FROM photos WHERE photo_id = '$media_id'";
    $results  = mysqli_query($link, $sql);
    if (mysqli_num_rows($results ) > 0) {
      while($row = mysqli_fetch_assoc($results )) {
        unlink("../admin/" .$row["photo_path"]);
      }
    }
    //delete photo from database
    $sqli = "DELETE FROM photos WHERE photo_id = '$media_id'";
    mysqli_query($link, $sqli);
    header("location: user-photos.php");
  }elseif ($media_id >= 3000 && $media_id < 4000) {
    //delete document from folder
    $sql = "SELECT * FROM documents WHERE doc_id = '$media_id'";
    $results  = mysqli_query($link, $sql);
    if (mysqli_num_rows($results ) > 0) {
      while($row = mysqli_fetch_assoc($results )) {
        unlink($row["../admin/doc_path"]);
      }
    }
    //delete document from database
    $sqli = "DELETE FROM documents WHERE doc_id = '$media_id'";
    mysqli_query($link, $sqli);
    header("location: user-doc.php");
  }

echo "media" .$media_id ."deleted";
}else {
  echo "media not deleted";
}

 ?>
 <?php mysqli_close($link) ;?>
