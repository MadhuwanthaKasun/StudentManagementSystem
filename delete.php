<?php
include "db_conn.php";
$id = $_GET["id"];
$sql = "DELETE FROM `students` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: home.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
