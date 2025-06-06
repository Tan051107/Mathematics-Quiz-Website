<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["quizid"], $_POST["quizname"], $_POST["description"], $_POST["timelimit"], $_POST["questionType"])) {
    header("Location: homepage-user.php");
    exit(); 
}

$quizid = $_POST["quizid"];
$quizname = $_POST["quizname"];
$description = $_POST["description"];
$timelimit = $_POST["timelimit"];
$questionType = $_POST["questionType"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Details</title>
    <link rel="stylesheet" href="headernew.css">
    <script type="text/javascript" src="darkmode.js" defer></script>
    <style>
        
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
        }



        .mode-font {
            position: relative;
        }

        .mode {
            text-decoration: none;
            color: black;
            font-size: 1rem;
            cursor: pointer;
        }

        .mode-list {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            display: none;
            z-index: 1001;
        }

        .mode-content {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: black;
            cursor: pointer;
        }

        .mode-content:hover {
            background-color: #f0f0f0;
        }

        .mode-font:hover .mode-list {
            display: block;s
        }

        
        .main-content {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 80vh; 
            margin-top: 60px; 
        }

        
        .quiz-container {
            text-align: center; 
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%; 
        }

  
        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

     
        .quiz-data {
            font-size: 1rem;
            margin-bottom: 20px;
        }

      
        h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        h4 {
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }

     
        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            background-color: #78CDD7;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover {
            background-color: #44A1A0;
        }
         body.darkmode, html.darkmode {
            background-color: #0a0e1f;
        }
        .darkmode .quiz-container{
            background-color:#101425;
            
        }


        @media only screen and (max-width: 600px) {
            h2 {
                font-size: 1.5rem;
            }

            h3 {
                font-size: 1.2rem;
            }

            h4 {
                font-size: 0.9rem;
            }

            .quiz-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <audio id="background-music" loop>
        <source src="song.mp3" type="audio/mpeg">
    </audio>
    
    <header class="header">
        <nav class="navibar">
            <a href="homepage-user.php" class="navi-logo">
                <img src="images/horizontal-logo.png" alt="Logo">
            </a> 
            
            <div class="auth-buttons">   
                <button id="theme-switch">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                        <path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                        <path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/>
                    </svg>
                </button>

                <a href="#">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                            <path d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160ZM480-80q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80Z"/>
                        </svg>
                    </button>
                </a>
                <a href="account-details-setting.php">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                            <path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm112-260q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Z"/>
                        </svg>
                    </button>
                </a>
                <a href="user-details-setting.php">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/></svg>
                    </button>
                </a>
            </div>
        </nav>
    </header>
    <hr>

    <div class="main-content">
        <div class="quiz-container">   
            <h2><?php echo htmlspecialchars($quizname); ?></h2>
            <div class="quiz-data">
                <p><strong>Type:</strong> <?php echo htmlspecialchars($questionType); ?></p>
                <p><strong>Description:</strong> <?php echo htmlspecialchars($description); ?></p>
            </div>
            <h3>Instructions for Students:</h3>
            <h4>
                <br>1. <u>Read each question carefully when attempting to answer.</u>
                <br>2. <u>Choose the suitable answer for each question.</u>
                <br>3. <u>Double-check your answers to ensure accuracy.</u>
            </h4>
            <div class="button-container">
                <form action="<?php echo ($questionType == 'Objective') ? 'objectivequestion.php' : 'subjectivequestion.php'; ?>" method="POST">
                    <input type="hidden" name="quizid" value="<?php echo $quizid; ?>">
                    <input type="hidden" name="timelimit" value="<?php echo $timelimit; ?>">

                    <button type="submit" id="startQuizBtn">Start Quiz</button>
                </form>
            </div>
        </div>
    </div>
    <script type ="text/javascript" src="playBackgroundMusic.js"></script>
</body>
</html>