<?php include 'connection.php' ?>

<?php
session_start();

$id = $_SESSION['id'];
$unameDb = $_SESSION['username'];
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
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="dashboard.css" />
  <link rel="stylesheet" href="./upload.css">
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

        <form action=<?php echo"'./editProfile.php?id=$id'"?> method="post" class="upload-form">
          <img <?php echo "src='./profile_pics/$image'" ?> height="100" width="100" id="img" alt="" srcset="">
          <input type="file" name="img-file" accept=".jpg, .jpeg, .png" id="">
          <input type="text" name="fname" placeholder="Full Name" <?php echo "value='$name'" ?> />
          <input type="text" name="uname" placeholder="Create Username" <?php echo "value='$unameDb'" ?> />
          <input type="email" name="email" placeholder="example@mail.com" <?php echo "value='$email'" ?> />
          <input type="text" name="bio" id="" placeholder="Bio">
          <p>Opitional:</p>
          <input type="password" placeholder="Create Password" class="create-password" name="pass" />
          <input type="password" placeholder="Confirm Password" class="confirm-password" name="con-pass" />
          <div class="gender-input">
            <input type="radio" name="gender" value="male" id="male" />
            <label for="gender" value="male">Male</label>
            <input type="radio" name="gender" value="female" id="female" />
            <label for="gender">Female</label>
          </div>
          <div class="dropdown-div">
            <p>You're Role:</p>
            <select id="role-dropdown" name="role">
              <option value="teacher" id="teacher">Teacher</option>
              <option value="student" id="student">Student</option>
            </select>
          </div>
          <input type="text" name="department" placeholder="Department" <?php echo "value='$course'" ?> />
          <input type="submit" id="input-submit" class="buttonClass" value="Save Change" />

        </form>

      </div>
    </div>
  </div>
</body>
<?php
if ($gender == 'male') {

  echo '<script>
    var radio = document.querySelector("#male");
    radio.setAttribute("checked", "true");
    </script>';
} else {
  echo '<script>
    var radio = document.querySelector("#female");
    radio.setAttribute("checked","true");
    </script>';
}
if ($role == 'teacher') {
  echo '<script>
    var select = document.querySelector("#teacher");
    select.setAttribute("selected","true");
    </script>';
} else {
  echo '
    var select = document.querySelector("#student");
    select.setAttribute("selected","true");
    ';
} ?>
<script>
  const formValidate = (e) => {
    e.preventDefault()
    if (document.querySelector(".create-password") != document.querySelector(".confirm-password")) {
      alert("password does not match")
      return false
    }
  }
</script>



</html>