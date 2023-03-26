<?php include 'connection.php' ?>

<?php
session_start();

$id = $_SESSION['id'];
$unameDb = $_SESSION['username'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$course = $_SESSION['course'];

$query = "SELECT * FROM users ORDER BY id DESC";
$q_result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if (isset($_GET['id'])) {
  $idFromUrl = $_GET['id'];
  $view_query = "SELECT * FROM users WHERE id = $idFromUrl";
  $view_result =  mysqli_query($conn, $view_query);
  if (mysqli_num_rows($view_result) > 0) {
    $deleteQuery = "DELETE FROM users WHERE id = '$idFromUrl'";
    $delectResult = mysqli_query($conn, $deleteQuery);
    echo "<script> window.location.href = './users.php';</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="dashboard.css" />
  <link rel="stylesheet" href="default.css" />
  <script src="script.js" defer></script>
  <title>Dashboard <?php echo "- $role"; ?></title>
</head>

<body>
  <div class="dashboard-bg-div">
    <div class="header">
      <h4 id="title-header">Online Notes Sharing</h4>
      <button class="btn-profile" onmouseover="dropdown(true)">
        <?php echo"$role"?>
        <span class="material-symbols-outlined"> arrow_drop_down </span>
      </button>
    </div>
    <div class="profile-dropdown hidden" onmouseleave="dropdown(false)">
    <a href="./account.php"> Account </a>
      <br>
      <a href="./logout.php">Log Out</a>
    </div>
    <div class="dashboard-div">
      <div class="dashboard-navbar">
        <a href="./dashboard.php">Dashboard</a>
        <a onclick="navDropdown('notes-dropdown')" <?php if($role == 'admin'){echo 'style="display:none"'; } ?> >My Notes</a>
        <div class="hidden notes-dropdown">
          <a href="./notes.php">View all notes</a>
          <br>
          <br>
          <a href="./upload.php">Upload Notes</a>
        </div>
        <a onclick="navDropdown('user-dropdown')" id="user-navbar"  <?php if($role != 'admin'){echo 'style="display:none"'; } ?> >User</a>
        <div class="hidden user-dropdown">
          <a href="./users.php"> View all users</a>
        </div>

        <a onclick="navDropdown('account-dropdown')">My Account</a>
        <div class="hidden account-dropdown">
          <a href="./profile.php">View Profile</a>
          <br />
          <br />
          <a href="./account.php">Edit Profile</a>
        </div>
      </div>
      <div class="dashboard-content">
        <div class="title-div-dashboard-content">
          <h4 id="title-dashboard-content">Welcome Admin</h4>
        </div>
        <table class="all-users-table">
          <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Course</th>
            <th>Delete</th>
          </tr>
          </tr>
          <?php
          if (mysqli_num_rows($q_result) > 0) {
            while ($row =  mysqli_fetch_array($q_result)) {
              $users_id = $row['id'];
              $users_uname = $row['username'];
              $users_name = $row['name'];
              $users_email = $row['email'];
              $users_role = $row['role'];
              $users_course = $row['course'];
              echo "
          <tr>
            <td>$users_id</td>
            <td>$users_uname</td>
            <td>$users_name</td>
            <td>$users_email</td>
            <td>$users_role</td>
            <td>$users_course</td>
            <td><a href='./users.php?id=$users_id'>Delete</a></td>
          </tr>
        ";
            }
          } ?>
        </table>
      </div>
    </div>
  </div>
</body>

</html>