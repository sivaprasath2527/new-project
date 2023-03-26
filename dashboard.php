<?php include 'connection.php' ?>

<?php
session_start();

$id = $_SESSION['id'];
$unameDb = $_SESSION['username'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$course = $_SESSION['course'];

$query = "SELECT * FROM uploads ORDER BY file_uploaded_on DESC";
$q_result = mysqli_query($conn, $query) or die(mysqli_error($conn));
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
        <?php echo "$role";?>
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
          <h4 id="title-dashboard-content">Welcome <?php echo $name ?></h4>
        </div>
        <?php if ($role == 'admin') {
          echo '
        <!-- admin table -->
        <table class="dashboard-admin-table">
          <th colspan="9" id="title-dashboard-table">
            Notes shared my various users
          </th>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Type</th>
            <th>Uploaded On</th>
            <th>Uploaded By</th>
            <th>Status</th>
            <th>View</th>
            <th>Approve</th>
            <th>Delete</th>
          </tr>
          <tr>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
          </tr>
          <tr>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
            <td>dummy data</td>
          </tr>
        </table>';
        } else {
          echo '

        <!-- user table  -->

        <table class="dashboard-user-table">
          <th colspan="9" id="title-dashboard-table">
            Notes shared by various users
          </th>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Type</th>
            <th>Uploaded On</th>
            <th>Uploaded By</th>
            <th>Status</th>
            <th>Download</th>
          </tr>';
          if (mysqli_num_rows($q_result) > 0) {
            while ($row =  mysqli_fetch_array($q_result)) {
              $file_id = $row['file_id'];
              $file_name = $row['file_name'];
              $file_description = $row['file_description'];
              $file_type = $row['file_type'];
              $file_date = $row['file_uploaded_on'];
              $file_uploader = $row['file_uploader'];
              $file_status = $row['status'];
              $file = $row['file'];
              echo "
          <tr>
            <td>$file_name</td>
            <td>$file_description</td>
            <td>$file_type</td>
            <td>$file_date</td>
            <td>$file_uploader</td>
            <td>$file_status</td>
            <td><a href='./uploaded_files/$file'>Download</a></td>
          </tr>
        ";
            }
          }
         echo '</table>';
        } ?>
      </div>
    </div>
  </div>
</body>

</html>