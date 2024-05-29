<?php
session_start();
include "db_conn.php";

if(!isset($_SESSION['user_id'])){
  header("Location: Auth/index.php");
  exit();
}

if (isset($_POST["submit"])) {
  $id = $_GET['id'];
  $full_name = $_POST['full_name'];
  $nic = $_POST['nic'];
  $address = $_POST['address'];
  $telephone = $_POST['telephone'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];

  $sql = "UPDATE `students` SET `full_name`='$full_name',`nic`='$nic',`address`='$address',`telephone`='$telephone',`gender`='$gender',`email`='$email' WHERE id = $id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: home.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Edit Student</title>
</head>

<body>
<?php 
  $id = $_SESSION['user_id'];
  $query = mysqli_query($conn,"SELECT*FROM users WHERE id=$id");

  if ($query) {
    while($result = mysqli_fetch_assoc($query)){
        $user_name = $result['user_name'];
        $res_Email = $result['email'];
    }
  }else{
      echo "Query execution failed: " . mysqli_error($conn);
  }
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="home.php">
      Student Management System
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://static.vecteezy.com/system/resources/previews/002/205/989/non_2x/user-profile-icon-free-vector.jpg" class="avatar rounded-circle" alt="Avatar" style="width: 30px; height: 30px;">
            <?php echo $user_name ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="Auth/edit.php?Id=<?php echo $id ?>">Change Profile</a></li>
            <li><a class="dropdown-item" href="Auth/logout.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <div class="container">
    <div class="text-center mb-4 mt-2">
      <h3>Edit Student Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $student_id = $_GET['id'];
    $sql = "SELECT * FROM `students` WHERE id = $student_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
        <div class="row mb-3">
               <div class="col-md-12">
                  <label class="form-label">Full Name:</label>
                  <input type="text" class="form-control" name="full_name" value="<?php echo $row['full_name'] ?>" required>
               </div>

               <div class="col-md-6">
                  <label class="form-label">NIC:</label>
                  <input type="text" class="form-control" name="nic" value="<?php echo $row['nic'] ?>" required>
               </div>
               <div class="col-6">
                  <label class="form-label">Address:</label>
                  <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>" required>
               </div>
               <div class="col-6">
                  <label class="form-label">Telephone No:</label>
                  <input type="text" class="form-control" name="telephone" value="<?php echo $row['telephone'] ?>" required>
               </div>
               <div class="col-md-12">
                 <label class="form-label">Email:</label>
                 <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" required>
                </div>
              </div>
              <div class="form-group mb-3">
              <label>Gender:</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php echo ($row["gender"] == 'male') ? "checked" : ""; ?>>
               <label for="male" class="form-input-label">Male</label>
               &nbsp;
               <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php echo ($row["gender"] == 'female') ? "checked" : ""; ?>>
               <label for="female" class="form-input-label">Female</label>
              </div>
        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="home.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>