<?php include 'connection.php' ?>

<?php
session_start();

$id = $_SESSION['id'];
$unameDb = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username= '$unameDb' ";
$run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($run_query) > 0) {
  while ($row = mysqli_fetch_array($run_query)) {
    $name = $row['name'];
    $bio = $row['about'];
    $role = $row['role'];
    $email = $row['email'];
    $gender = $row['gender'];
    $course = $row['course'];
    $image = $row['image'];
    $joindate = $row['joindate'];
  }
}
// $page = $_SERVER['PHP_SELF'];
// $sec = "1";
// header("Refresh: $sec; url=$page");

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
  <link rel="stylesheet" href="./profile.css">
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
        <a onclick="navDropdown('notes-dropdown')" <?php if ($role == 'admin') {
                                                      echo 'style="display:none"';
                                                    } ?>>My Notes</a>
        <div class="hidden notes-dropdown">
          <a href="./notes.php">View all notes</a>
          <br>
          <br>
          <a href="./upload.php">Upload Notes</a>
        </div>
        <a onclick="navDropdown('user-dropdown')" id="user-navbar" <?php if ($role != 'admin') {
                                                                      echo 'style="display:none"';
                                                                    } ?>>User</a>
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
        <div class="profile-div">
          <div class="img-profile">

            <img <?php echo "src='./profile_pics/$image'" ?> height="200" width="200" alt="dp" id="img">
          </div>
          <div class="txt-profile">

            <h3><?php echo "$unameDb" ?></h3>

            <div class="details-profile">
              <div class="txt-detail-profile"><span>Department: </span>
                <p><?php echo "$course" ?></p>
              </div>

              <div class="txt-detail-profile">
                <span>Role: </span>
                <p><?php echo "$role" ?></p>
              </div>

              <div class="txt-detail-profile">
                <span>Gender: </span>
                <p><?php echo "$gender" ?></p>
              </div>
              <div class="txt-detail-profile">
                <span>Email: </span>
                <p><?php echo "$email" ?></p>
              </div>

              <div class="txt-detail-profile">
                <span>Join Date: </span>
                <p><?php echo "$joindate" ?></p>

              </div>

              <div class="txt-detail-profile">
                <span>Bio: </span>
                <p><?php echo "$bio" ?></p>
              </div>



            </div>

          </div>



        </div>

      </div>
    </div>
  </div>
</body>

</html>