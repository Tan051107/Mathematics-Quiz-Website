<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["quizid"], $_POST["score"], $_POST["time_taken"], $_POST["percentage"], $_POST["email"])) {
    header("Location: homepage-user.php"); 
    exit();
}
$quizid = $_POST["quizid"];

$no_of_correct_ans = $_POST["score"];
$date_done = date("Y-m-d"); 
$time_taken = $_POST["time_taken"];
$percentage = $_POST["percentage"];
$email = $_POST["email"];
    
$query = "INSERT INTO results_table (quizid, email, no_of_correct_ans, time_taken, date_done) 
            VALUES ($quizid, '$email', $no_of_correct_ans, $time_taken, '$date_done')";

if (mysqli_query($connection, $query)) {
    echo "Quiz results saved successfully!"."<br>";
    echo '
    <form id="resultForm" action="Resultpage.php" method="POST">
        <input type="hidden" name="score" id="score" value="' . $no_of_correct_ans . '">
        <input type="hidden" name="time_taken" id="time_taken" value="' . $time_taken . '">
        <input type="hidden" id="percentage" name="percentage" value="' . $percentage . '">
    </form>
    <script>
        document.getElementById("resultForm").submit();
    </script>';


    
} else {
    echo "Error: " . mysqli_error($connection);

}
mysqli_close($connection);
?>
