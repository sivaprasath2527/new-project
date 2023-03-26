<?php include 'connection.php'?>

<?php 

$id = $_GET['id'];
$nameEdited = $_POST['fname'];
$unameEdited = $_POST['uname'];
$emailEdited = $_POST['email'];
$genderEdited = $_POST['gender'];
$roleEdited = $_POST['role'];
$departmentEdited = $_POST['department'];
$bio = $_POST['bio'];
if(isset($_POST['pass'])){
    $passEdited = $_POST['pass'];
    $query = "UPDATE  users SET name='$nameEdited', username='$unameEdited', email='$emailEdited', password ='$passEdited', role='$roleEdited', course='$departmentEdited', gender='$genderEdited', bio='$bio' WHERE id = '$id' ";
}else{
    $query = "UPDATE  users SET name='$nameEdited', username='$unameEdited', email='$emailEdited', role='$roleEdited', course='$departmentEdited', gender='$genderEdited', bio='$bio' WHERE id = '$id' ";
}

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

echo '<script>
    alert("User Details Successfully Updated");
    window.location.href = "account.php";
</script>'


?>