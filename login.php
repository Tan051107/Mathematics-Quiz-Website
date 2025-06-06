<?php

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['txtEmail']) && isset($_POST['txtPassword'])) {
    echo "Button clicked!";
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    $query = "SELECT * FROM useraccount WHERE email='$email' AND password='$password'";
    $results = mysqli_query($connection, $query);
    if ($row = mysqli_fetch_assoc($results)) {
        echo 'record found';
        session_start();
        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];

        header("Location: homepage-user.php");
        exit();
    } else {
        echo "<script>
                alert('Error, please try again!');
                window.location.href = 'login.html';
              </script>";
    }
    mysqli_close($connection);
} else {
    // Redirect if the form was not submitted properly
    header("Location: login.html");
    exit();
}
?>