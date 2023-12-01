<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
$flagFile = 'script_executed.flag';

// Check if the script has already run
if (file_exists($flagFile)) {
    echo "Data already populated";
    exit;
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Attendance_Recorder";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dummy data for user insertion
$usersData = array(
    // Teachers
    array(1,"John Teacher", "john.teacher@example.com", "asdf", "class1", "teacher"),
    array(2, "Jane Teacher", "jane.teacher@example.com", "asdf", "class2", "teacher"),
    array(3, "Alice Teacher", "alice.teacher@example.com", "asdf", "class3", "teacher"),
    array(4, "Bob Teacher", "bob.teacher@example.com", "asdf", "class4", "teacher"),
    array(5, "Charlie Teacher", "charlie.teacher@example.com", "asdf", "class5", "teacher"),
    // Students
    array(6, "Anna Student", "anna.student@example.com", "asdf", "class1", "student"),
    array(7, "Ben Student", "ben.student@example.com", "asdf", "class2", "student"),
    array(8, "Cathy Student", "cathy.student@example.com", "asdf", "class3", "student"),
    array(9, "David Student", "david.student@example.com", "asdf", "class4", "student"),
    array(10, "Eva Student", "eva.student@example.com", "asdf", "class5", "student"),
    array(11, "Frank Student", "frank.student@example.com", "asdf", "class1", "student"),
    array(12, "Grace Student", "grace.student@example.com", "asdf", "class2", "student"),
    array(13, "Henry Student", "henry.student@example.com", "asdf", "class3", "student"),
    array(14, "Ivy Student", "ivy.student@example.com", "asdf", "class4", "student"),
    array(15, "Jack Student", "jack.student@example.com", "asdf", "class5", "student"),
    array(16, "Kate Student", "kate.student@example.com", "asdf", "class1", "student"),
    array(17, "Leo Student", "leo.student@example.com", "asdf", "class2", "student"),
    array(18, "Mia Student", "mia.student@example.com", "asdf", "class3", "student"),
    array(19, "Nathan Student", "nathan.student@example.com", "asdf", "class4", "student"),
    array(20, "Olivia Student", "olivia.student@example.com", "asdf", "class5", "student"),
    array(21, "Peter Student", "peter.student@example.com", "asdf", "class1", "student"),
    array(22, "Quinn Student", "quinn.student@example.com", "asdf", "class2", "student"),
    array(23, "Rachel Student", "rachel.student@example.com", "asdf", "class3", "student"),
    array(24, "Sam Student", "sam.student@example.com", "asdf", "class4", "student"),
    array(25, "Tina Student", "tina.student@example.com", "asdf", "class5", "student"),
);
// Dummy data for class insertion
$classData = array(
        array(1, 1, "08:00:00", "09:00:00", 3),
        array(2, 4, "09:00:00", "10:00:00", 3),
        array(3, 2, "10:30:00", "12:30:00", 4),
        array(4, 3, "12:30:00", "13:30:00", 2),
        array(5, 5, "13:30:00", "14:00:00", 1),
        array(6, 1, "14:00:00", "15:30:00", 3),
        array(7, 3, "15:30:00", "16:00:00", 1),
        array(8, 5, "16:30:00", "17:30:00", 2),
        array(9, 2, "17:30:00", "18:30:00", 2),
        array(10, 4, "18:30:00", "19:00:00", 1),
);

// Dummy data for attendance insertion
$attendanceData = array(
    array(1, 6, 1, "Present"),
    array(1, 7, 1, "Present"),
    array(1, 8, 1, "Present"),
    array(1, 9, 1, "Present"),
    array(1, 10, 1, "Present"),
    array(1, 11, 1, "Present"),
    array(1, 12, 1, "Present"),
    array(1, 13, 1, "Present"),
    array(1, 14, 1, "Present"),
    array(1, 15, 1, "Present"),
    array(1, 16, 1, "Present"),
    array(1, 17, 1, "Present"),
    array(1, 18, 1, "Present"),
    array(1, 19, 1, "Present"),
    array(1, 20, 1, "Present"),
    array(1, 21, 1, "Present"),
    array(1, 22, 0, "Absent"),
    array(1, 23, 1, "Present"),
    array(1, 24, 1, "Present"),
    array(1, 25, 1, "Present"),
    array(2, 6, 0, "Absent"),
    array(2, 7, 0, "Absent"),
    array(2, 8, 1, "Present"),
    array(2, 9, 1, "Present"),
    array(2, 10, 1, "Present"),
    array(2, 11, 1, "Present"),
    array(2, 12, 1, "Present"),
    array(2, 13, 1, "Present"),
    array(2, 14, 1, "Present"),
    array(2, 15, 0, "Absent"),
    array(2, 16, 1, "Present"),
    array(2, 17, 1, "Present"),
    array(2, 18, 1, "Present"),
    array(2, 19, 1, "Present"),
    array(2, 20, 1, "Present"),
    array(2, 21, 1, "Present"),
    array(2, 22, 1, "Present"),
    array(2, 23, 1, "Present"),
    array(2, 24, 1, "Present"),
    array(2, 25, 1, "Present"),
    array(3, 6, 1, "Present"),
    array(3, 7, 1, "Present"),
    array(3, 8, 1, "Present"),
    array(3, 9, 1, "Present"),
    array(3, 10, 1, "Present"),
    array(3, 11, 1, "Present"),
    array(3, 12, 1, "Present"),
    array(3, 13, 1, "Present"),
    array(3, 14, 1, "Present"),
    array(3, 15, 1, "Present"),
    array(3, 16, 1, "Present"),
    array(3, 17, 1, "Present"),
    array(3, 18, 1, "Present"),
    array(3, 19, 1, "Present"),
    array(3, 20, 1, "Present"),
    array(3, 21, 1, "Present"),
    array(3, 22, 0, "Absent"),
    array(3, 23, 1, "Present"),
    array(3, 24, 1, "Present"),
    array(3, 25, 1, "Present"),
    array(4, 6, 1, "Present"),
    array(4, 7, 1, "Present"),
    array(4, 8, 1, "Present"),
    array(4, 9, 1, "Present"),
    array(4, 10, 0, "Absent"),
    array(4, 11, 1, "Present"),
    array(4, 12, 1, "Present"),
    array(4, 13, 1, "Present"),
    array(4, 14, 1, "Present"),
    array(4, 15, 1, "Present"),
    array(4, 16, 0, "Absent"),
    array(4, 17, 1, "Present"),
    array(4, 18, 1, "Present"),
    array(4, 19, 1, "Present"),
    array(4, 20, 1, "Present"),
    array(4, 21, 1, "Present"),
    array(4, 22, 1, "Present"),
    array(4, 23, 1, "Present"),
    array(4, 24, 1, "Present"),
    array(4, 25, 1, "Present"),
    array(5, 6, 1, "Present"),
    array(5, 7, 1, "Present"),
    array(5, 8, 1, "Present"),
    array(5, 9, 1, "Present"),
    array(5, 10, 1, "Present"),
    array(5, 11, 1, "Present"),
    array(5, 12, 1, "Present"),
    array(5, 13, 1, "Present"),
    array(5, 14, 1, "Present"),
    array(5, 15, 1, "Present"),
    array(5, 16, 1, "Present"),
    array(5, 17, 1, "Present"),
    array(5, 18, 1, "Present"),
    array(5, 19, 1, "Present"),
    array(5, 20, 0, "Absent"),
    array(5, 21, 1, "Present"),
    array(5, 22, 1, "Present"),
    array(5, 23, 1, "Present"),
    array(5, 24, 1, "Present"),
    array(5, 25, 1, "Present"),
    );

// Insert users into the 'user' table
foreach ($usersData as $userData) {
    $query = "INSERT INTO `user` (id, fullname, email, password_, class, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $userData[0], $userData[1], $userData[2], $userData[3], $userData[4], $userData[5]);
    $stmt->execute();
}

// Insert classes into the 'class' table
foreach ($classData as $classDatum) {
    $query = "INSERT INTO `class` (id, teacherid, starttime, endtime, credit_hours) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iisss", $classDatum[0], $classDatum[1], $classDatum[2], $classDatum[3], $classDatum[4]);
    $stmt->execute();
}

// Insert attendance into the 'attendance' table
foreach ($attendanceData as $attendanceDatum) {
    $query = "INSERT INTO `attendance` (classid, studentid, isPresent, comments) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiis", $attendanceDatum[0], $attendanceDatum[1], $attendanceDatum[2], $attendanceDatum[3]);
    $stmt->execute();
}

// Create the flag file to mark that the script has been executed
file_put_contents($flagFile, '');

// Close the database connection
$conn->close();

echo "Data insertion completed successfully!";
?>




<?php
$servername = "localhost";
$username = "root";

// Create connection
$conn = new mysqli($servername, $username);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database
$sql_create_db = "CREATE DATABASE IF NOT EXISTS Attendance_Recorder";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Connect to the created database
$conn->select_db("Attendance_Recorder");

// SQL to create 'attendance' table
$sql_attendance = "CREATE TABLE IF NOT EXISTS attendance (
    classid int(50) NOT NULL,
    studentid int(50) NOT NULL,
    isPresent tinyint(1) NOT NULL,
    comments varchar(200) NOT NULL,
    PRIMARY KEY (classid, studentid)
)";

// SQL to create 'class' table
$sql_class = "CREATE TABLE IF NOT EXISTS class (
    id int(50) NOT NULL,
    teacherid int(50) NOT NULL,
    starttime time NOT NULL,
    endtime time NOT NULL,
    credit_hours int(11) NOT NULL,
    PRIMARY KEY (id)
)";

// SQL to create 'user' table
$sql_user = "CREATE TABLE IF NOT EXISTS user (
    id int(50) NOT NULL AUTO_INCREMENT,
    fullname varchar(200) NOT NULL,
    email varchar(200) NOT NULL,
    password_ varchar(100) NOT NULL,
    class varchar(10) NOT NULL,
    role enum('teacher','student','admin') NOT NULL,
    PRIMARY KEY (id)
)";

// Execute queries
if ($conn->query($sql_attendance) === TRUE) {
    echo "Table 'attendance' created successfully<br>";
} else {
    echo "Error creating table 'attendance': " . $conn->error . "<br>";
}

if ($conn->query($sql_class) === TRUE) {
    echo "Table 'class' created successfully<br>";
} else {
    echo "Error creating table 'class': " . $conn->error . "<br>";
}

if ($conn->query($sql_user) === TRUE) {
    echo "Table 'user' created successfully<br>";
} else {
    echo "Error creating table 'user': " . $conn->error . "<br>";
}

// Close connection
$conn->close();
?>

</body>
</html>
