<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbms2";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    // Database selected
    // No need to use mysql_select_db() here since the database is already selected in the connection
}

// Starting session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect based on session
if (isset($_SESSION['login_as']) && $_SESSION['login_as'] === "admin") {
    header('location:admin/admin-profile.php');
} elseif (isset($_SESSION['login_as']) && $_SESSION['login_as'] === "manager") {
    header('location:admin/manager-profile.php');
}

define("ENCRYPTION_KEY", "!@#$%^&*");

function encrypt($pure_string, $encryption_key) {
    return $pure_string;
}

function decrypt($encrypted_string, $encryption_key) {
    return $encrypted_string;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendMail($email, $url) {
    try {
        $message = new Message();
        $message->setSender("no-dues@appspot.gserviceaccount.com");
        $message->addTo($email);
        $message->setSubject("Forgot Password");
        $message->setTextBody('Please visit the following link to reset your password. ' . $url);
        $message->send();
    } catch (InvalidArgumentException $e) {
        // Handle exception
    }
}
?>
