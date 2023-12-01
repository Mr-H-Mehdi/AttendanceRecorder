<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "attendance_recorder";

// Create connection
$conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM user WHERE email='$email' AND password_='$password'";

$result = $conn->query($query);

if ($result->num_rows == 1){
    //success
    $row = $result->fetch_assoc();
    if ($row && $row['role'] == 'student') {
        // The user has a role of 'student'
        header("Location: student.html");
        exit();
    }
    if ($row && $row['role'] == 'teacher') {
        // The user has a role of 'student'
        header("Location: teacher.html");
        exit();
    }
    if ($row && $row['role'] == 'admin') {
        // The user has a role of 'student'
        header("Location: http://localhost/phpmyadmin/index.php");
        exit();
    }
}
else{
    //failure
    header("Location: error.html");
    exit();
}
$conn->close();
}
?>