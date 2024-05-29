<?php
  session_start();
  include "db_conn.php";
  
  if(!isset($_SESSION['user_id'])){
    header("Location: Auth/index.php");
    exit();
  }
  if(isset($_GET['search_submit'])) {
        if(isset($_GET['search_key']) && !empty($_GET['search_key'])) {
            $search_key = $_GET['search_key'];

            header("Location: search.php?search_key=$search_key");
            exit();
        } else {
            header("Location: home.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP CRUD Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <li><a class="dropdown-item" href="edit.php?Id=<?php echo $id ?>">Change Profile</a></li>
            <li><a class="dropdown-item" href="Auth/logout.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <a href="add-new.php" class="btn btn-dark mb-3 mt-2">Add New</a>
    </div>
    <div class="col-md-6">
      <form class="d-flex mt-2">
        <input class="form-control me-2" type="text" name="search_key" value="<?php echo $_GET['search_key'] ?>" placeholder="Search by 'name' or 'email'" aria-label="Search">
        <button class="btn btn-outline-success" name="search_submit" type="submit">Search</button>
    </form>
    </div>
  </div>
  <table class="table table-hover text-center">
    <thead class="table-dark">
      <tr>
        <th scope="col">STUDENT ID</th>
        <th scope="col">Full Name</th>
        <th scope="col">NIC</th>
        <th scope="col">Address</th>
        <th scope="col">Telephone</th>
        <th scope="col">Gender</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $search_key = mysqli_real_escape_string($conn, $_GET['search_key']);
        $sql = "SELECT * FROM `students` WHERE full_name LIKE '%$search_key%' OR email LIKE '%$search_key%'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
      <tr>
        <td>#<?php echo $row["id"] ?></td>
        <td><?php echo $row["full_name"] ?></td>
        <td><?php echo $row["nic"] ?></td>
        <td><?php echo $row["address"] ?></td>
        <td><?php echo $row["telephone"] ?></td>
        <td><?php echo $row["gender"] ?></td>
        <td><?php echo $row["email"] ?></td>
        <td>
          <a href="edit.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
          <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
