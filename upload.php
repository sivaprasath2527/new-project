<?php
session_start();

$id = $_SESSION['id'];
$unameDb = $_SESSION['username'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$course = $_SESSION['course'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"
    />
    <link rel="stylesheet" href="dashboard.css" />
    <link rel="stylesheet" href="default.css" />
    <link rel="stylesheet" href="upload.css" />
    <script src="script.js"></script>
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
            <h4 id="title-dashboard-content">Upload Notes</h4>
          </div>
          <form action="uploadNotes.php" method="post" class="upload-form" enctype="multipart/form-data">
            <h4>Note Title</h4>
            <input type="text" name="title" placeholder="Eg: Php Notes Project" />
            <h4>Short Description</h4>
            <input
              type="text"
              name="description"
              placeholder="Eg: This Prject helps to share notes among department"
            />
            <h4>
              Select File
              <p>
                (allowed file type: 'pdf','doc','ppt','txt','zip' | allowed
                maximum size: 30 mb)
              </p>
            </h4>
            <input
              type="file"
              name="files"
              id=""
              accept=".pdf,.doc,.ppt,.txt,.zip"
            />
            <input type="submit" value="Upload Note" class="buttonClass" />
          </form>
        </div>
      </div>
    </div>
  </body>
  <script>
    const navDropdown = (p) => {
      var userTag = document.querySelector("#user-navbar");
      var dropdownTag = document.querySelector(`.${p}`);
      dropdownTag.classList.toggle("hidden");
    };
    function dropdown(p) {
      var btn = document.querySelector(".btn-profile");
      var dropdownDiv = document.querySelector(".profile-dropdown");
      switch (p) {
        case true:
          dropdownDiv.style.position = "absolute";
          dropdownDiv.style.top = `${btn.offsetTop + 30}px`;
          dropdownDiv.style.left = `${btn.offsetLeft}px`;
          dropdownDiv.classList.remove("hidden");
          break;
        case false:
          dropdownDiv.classList.add("hidden");
          break;
      }
    }
  </script>
</html>
