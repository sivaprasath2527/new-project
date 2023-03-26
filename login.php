<?php
include 'connection.php';
?>
<?php
session_start();

$unameSite = $_POST['uname'];
$passSite = $_POST['pass'];

$query = "SELECT * FROM users WHERE username = '$unameSite'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $unameDb = $row['username'];
        $passDb = $row['password'];
        $name = $row['name'];
        $email = $row['email'];
        $role = $row['role'];
        $course = $row['course'];
        $gender = $row['gender'];
        if (password_verify($passSite, $passDb)) {
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $unameDb;
            $_SESSION['name'] = $name;
            $_SESSION['email']  = $email;
            $_SESSION['role'] = $role;
            $_SESSION['course'] = $course;
            $_SESSION['gender'] = $gender;
            header('location: dashboard.php');
        } else {
            echo "<script>alert('invalid username/password');
      window.location.href= 'index.html';</script>";
        }
    }
} else {
    echo "<script>alert('invalid username/password');
      window.location.href= 'index.html';</script>";
}




?>