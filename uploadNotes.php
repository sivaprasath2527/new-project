<?php include 'connection.php' ?>

<?php

session_start();

$id = $_SESSION['id'];
$unameDb = $_SESSION['username'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$course = $_SESSION['course'];
$file_name = $_POST['title'];
$file_description =  $_POST['description'];
$file = $_FILES['files']['name'];
$file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));

$file_name_uniqe = rand(1000, 100000) . "." . $file_type;
$folder = "uploaded_files/";
move_uploaded_file($_FILES['files']['tmp_name'], $folder.$file_type);
$note_file = $file_name_uniqe;



$query = "INSERT INTO uploads (file_name, file_description, file_type, file_uploader, file_uploaded_to, file) VALUES ('$file_name', '$file_description', '$file_type', '$unameDb', '$course', '$note_file')";
$q_result = mysqli_query($conn, $query) or die(mysqli_error($conn));

echo '<script>
    alert("Notes Successfully Updated");
    window.location.href = "notes.php";
</script>'
?>