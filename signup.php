<?php include 'connection.php'?>


<?php 

$username = $_POST['uname'];
$fname = $_POST['fname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$hash = password_hash("$pass", PASSWORD_DEFAULT);
$gender = $_POST['gender'];
$role = $_POST['role'];
$department = $_POST['department'];
$date = date("F j, Y");

$query = "INSERT INTO  users (username, name, role, email, gender, password, course, joindate) VALUES ('$username', '$fname', '$role', '$email', '$gender', '$hash', '$department' , '$date')";
mysqli_query($conn, $query) or die(mysqli_error($conn));

if (mysqli_affected_rows($conn) > 0) { 
    echo "<script>alert('SUCCESSFULLY REGISTERED');
    window.location.href='./index.html';</script>";
}
else {
echo "<script>alert('Error Occured');</script>";
};

?>