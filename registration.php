<?php
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["email"], $_POST["username"], $_POST["password"], $_POST["fname"], $_POST["lname"])) {
    header("Location: signup.html");
    exit();
}
$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$password = $_POST['password'];

$check_query = "SELECT email FROM useraccount WHERE email = '$email'";
$result = mysqli_query($connection, $check_query);
if (mysqli_num_rows($result) > 0) {
    echo "<script>
            alert('Email is already registered! Please use a different email.');
            window.location.href = 'signup.html';
            </script>";
} else {
    $query = "INSERT INTO useraccount (email, first_name,last_name,username, password, phone_number, date_of_birth, profile_pic, role) 
        VALUES ('$email', '$fname', '$lname', '$username', '$password', NULL, NULL, 'black-profile.png', 'user')";

    if (mysqli_query($connection, $query)) {
        echo "<script>
                alert('Account successfully registered!');
                window.location.href = 'login.html';
            </script>";
        
    } else {
        echo "<script>
                alert('Error, please try again!');
                window.location.href = 'signup.html';
            </script>";
    }
}
mysqli_close($connection);

?>