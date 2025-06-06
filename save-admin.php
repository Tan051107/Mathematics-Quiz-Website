<?php
session_start();
include 'connection.php';

if (!isset($_SESSION["email"], $_SESSION["role"])) {
    header("Location: login.html");
    exit();
}
if ($_SESSION["role"] === "user") {
    header("Location: homepage-user.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["email"], $_POST["username"], $_POST["password"], $_POST["fname"], $_POST["lname"])) {
    header("Location: homepage-user.php");
    exit();
}

$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
    
$check_query = "SELECT email FROM useraccount WHERE email = '$email'";
$result = mysqli_query($connection, $check_query);
if (mysqli_num_rows($result) > 0) {
    echo "<script>
            alert('Email is already registered! Please use a different email.');
            window.location.href = 'account-addadmin-setting.php';
            </script>";
} else {
    $query = "INSERT INTO useraccount (email, first_name, last_name, username, password, phone_number, date_of_birth, profile_pic, role) 
            VALUES ('$email', '$fname', '$lname', '$username', '$password', NULL, NULL, 'black-profile.png', 'admin')";

    if (mysqli_query($connection, $query)) {
            echo "<script>
                    alert('Admin successfully registered!');
                    window.location.href = 'account-addadmin-setting.php';
                </script>";
            
    } else {
        echo "<script>
                alert('Error, please try again!');
                window.location.href = 'account-addadmin-setting.php';
            </script>";
    }
}
mysqli_close($connection);

    
?>
