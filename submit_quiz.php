<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] != "POST" || 
    !isset($_POST["quizname"], $_POST["description"], $_POST["timelimit"])) {
    header("Location: homepage-user.php");
    exit();
}

$quizname = $_POST["quizname"];
$description = $_POST["description"];
$timelimit = $_POST["timelimit"];
    
$query1 = "INSERT INTO quiztable (quizname, description, timelimit) 
            VALUES ('$quizname', '$description', '$timelimit')";

if (mysqli_query($connection, $query1)) {
    $quizid = mysqli_insert_id($connection);

    for ($i = 1; $i <= 20; $i++) {
        
        $question = $_POST["question$i"];
        $option1 = $_POST["option${i}_1"];
        $option2 = $_POST["option${i}_2"];
        $option3 = $_POST["option${i}_3"];
        $option4 = $_POST["option${i}_4"];
        $answer = $_POST["answer$i"];
        

        $query2 = "INSERT INTO questionstable (quizid, question, option1, option2, option3, option4, answer) 
                VALUES ($quizid, '$question', '$option1', '$option2', '$option3','$option4','$answer')";
        if (mysqli_query($connection, $query2)) {
            echo "Question $i saved successfully!<br>";
        } else {
            echo "Error inserting Question $i: " . mysqli_error($connection) . "<br>";
        }
    } 
}else {
    mysqli_close($connection);
    echo "<script>
            alert('Error Inserting Quiz');
            window.location.href = 'homepage-admin.php';
        </script>";
}
mysqli_close($connection);
echo "<script>
        alert('Successfully Inserted Quiz');
        window.location.href = 'homepage-admin.php';
    </script>";

?>