<?php
include('db_connection.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['submit'])) {
    $roll = mysqli_real_escape_string($connection, $_POST['roll']);
    $password = $_POST['password'];
    // No encryption for password
    $query = mysqli_query($connection, "SELECT * FROM student WHERE roll='$roll' AND password='$password'");

    if (mysqli_num_rows($query) == 1) {
        $query1 = mysqli_query($connection, "SELECT * FROM email WHERE roll='$roll'");
        $row1 = mysqli_fetch_assoc($query1);
        $row = mysqli_fetch_assoc($query);
        $_SESSION['login_as'] = "student";
        $_SESSION['roll'] = $roll;
        $_SESSION['email'] = $row1['email'];
        $_SESSION['password'] = $password;
        $_SESSION['name'] = $row['name'];
        $_SESSION['hostel'] = $row['hostel'];
        header('location:student-profile.php');
    } else {
        header('location:index.php?error=credential');
    }
} else {
    header('location:index.php');
}
?>
