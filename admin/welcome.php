<?php
// Include config file
require_once "config.php";
$sql = "SELECT users.user_id, users.email, user_registration.category FROM users INNER JOIN user_registration ON users.email = user_registration.email ";
                            $results = mysqli_query($link, $sql);

                            if (mysqli_num_rows($results) > 0) {
                                // output data of the specific row
                                while($row = mysqli_fetch_assoc($results)) {
                                  if ($row["category"] = "admin") {
                                    header("location: admin.php");

                                  } elseif ($row["category"] = "x_user") {
                                    header("location: ../x-user/x-user.php");
                                  } elseif ($row["category"] = "user") {
                                    header("location: ../user/user.php");
                                  }

                                }
                              } else {
                                echo "0 results";
                              }
 ?>
