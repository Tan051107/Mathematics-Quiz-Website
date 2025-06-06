<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$email = $_SESSION['email'];
$role = $_SESSION['role'];

$servername = "localhost";
$username = "root";
$password = "";
$database = "assignment";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Management</title>
    <style>
        body, html {
            overflow-x: hidden;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }
        
        .quiz-container {
            text-align: center;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .button-container {
            margin-top: 20px;
        }
        .button-container button {
            width: 100%;
            padding: 10px;
            background-color: #78CDD7;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .button-container button:hover {
            background-color: #44A1A0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        @media only screen and (max-width: 768px) {
            .container {
                width: 90%;
                max-width: 100%;
                margin: 0 auto;
                padding: 15px;
            }
            .container h1 {
                font-size: 20px;
            }
            .form-container {
                padding: 15px;
            }
            .form-group label {
                font-size: 14px;
            }
            .form-group input,
            .form-group select {
                font-size: 14px;
                height: 40px;
                width: 100%;
            }
            .button-container button {
                font-size: 14px;
                padding: 8px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <audio id="background-music" loop>
        <source src="song.mp3" type="audio/mpeg">
    </audio>
    <div class="quiz-container">
        <!-- Dropdown to Select Quiz -->
        <div class="container">
            <h1>Select A Quiz</h1>
            <form id="quizForm" action="QuizzDetails.php" method="POST">
                <!-- Quiz Selection Dropdown -->
                <div class="form-group">
                    <label for="quizDropdown">TOPIC</label>
                    <select id="quizDropdown" name="quizid" required>
                        <?php
                        $sql = "SELECT quizid, quizname, description, timelimit FROM quiztable";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["quizid"] . "' 
                                        data-timelimit='" . $row["timelimit"] . "' 
                                        data-description='" . htmlspecialchars($row["description"], ENT_QUOTES) . "' 
                                        data-quizname='" . htmlspecialchars($row["quizname"], ENT_QUOTES) . "'>
                                        " . $row["quizname"] . "
                                    </option>";
                            }
                        } else {
                            echo "<option value=''>No quizzes available</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="questionTypeDropdown">QUESTION TYPE</label>
                    <select id="questionTypeDropdown" name="questionType" required>
                        <option value="Objective">Multiple Choice</option>
                        <option value="Subjective">Subjective</option>

                    </select>
                </div>
                <input type="hidden" id = "quizname" name="quizname" value= ""> 
                <input type="hidden" id = "timelimit" name="timelimit" value= "">  
                <input type="hidden" id = "description" name="description" value= "">            
                <!-- Submit Button -->
                <div class="button-container">
                    <button type="submit">Next</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function updateHiddenFields() {
            var quizDropdown = document.getElementById("quizDropdown");
            var selectedOption = quizDropdown.options[quizDropdown.selectedIndex];
            document.getElementById("timelimit").value = selectedOption.getAttribute("data-timelimit"); 
            document.getElementById("description").value = selectedOption.getAttribute("data-description");
            document.getElementById("quizname").value = selectedOption.getAttribute("data-quizname");
        }
        document.getElementById("quizDropdown").addEventListener("change", updateHiddenFields);
        updateHiddenFields();
    </script>
    <script type ="text/javascript" src="playBackgroundMusic.js"></script>

</body>
</html>

