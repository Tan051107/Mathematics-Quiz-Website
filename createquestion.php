<?php
session_start();

if (!isset($_SESSION["email"], $_SESSION["role"])) {
    header("Location: login.html");
    exit();
}
if ($_SESSION["role"] === "user") {
    header("Location: homepage-user.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["quizname"], $_POST["description"], $_POST["timelimit"])) {
    header("Location: homepage-admin.php");
    exit();
}

$quizname = $_POST["quizname"];
$description = $_POST["description"];
$timelimit = $_POST["timelimit"];

?>
<script>
window.addEventListener("pageshow", function(event) { 
    if (event.persisted) {
        location.reload();
    }
});
</script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    <link rel="stylesheet" href="headernew.css">
    <script type="text/javascript" src="darkmode.js" defer></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column; 
            align-items: center; 
        }
        .header{
            width:98%;
        }
        .wrapper {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .quiz-details-container {
            width: 800px;
            max-width: 80%;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.1);
            background-color: white;
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .quiz-details-container h2 {
            margin-bottom: 15px;
            font-size: 22px;
            color: #007bff;
        }

        .quiz-details-container p {
            margin: 5px 0;
            font-size: 16px;
            color: #333;
            font-weight: 500;
        }

        
        .container{
            width: 800px;
            max-width: 90%;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.1);
            background-color: white;
            height: auto;
            
        }
        .outer-container {
            width: 800px;
            max-width: 80%;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .inner-container {
            width: 100%;
        }
        .question-container {
            width: 100%;
        }
        .question {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        .options-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .option {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100px;
            background-color: #e0e0e0;
            border-radius: 10px;
            font-size: 18px;
            transition: background-color 0.2s ease;
            cursor: pointer;
            position: relative;
        }
        .option-textfield {
            width: 90%;
            padding: 10px;
            font-size: 16px;
            border: none;
            background-color: transparent;
            outline: none;
            margin-left: 5px;
        }
        .option:hover {
            background-color: #78CDD7;
        }
        .controls {
            margin-top: 20px;
            text-align: center;
            width: 800px;
            max-width: 80%;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .controls button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .controls button:hover {
            background-color: #0056b3;
        }
        input[type='radio'] {
            height: 25px;
            width: 25px;
            vertical-align: middle;
        }
        .darkmode .wrapper{
            color: white;
            background-color: #0a0e1f;
        }
        .darkmode .quiz-details-container{
            background-color: #3a435d;
        }
        
        .darkmode .quiz-details-container p{
            color:white; 
        }
        .darkmode .option{
            background-color: #3a435d;
            color: white;
        }
        .darkmode .option input{
            color: white;
        }
        
        .darkmode .option input::placeholder{
            color: lightgrey;
        }
        .darkmode .option:hover {
            background-color: #44A1A0;
        }
        .darkmode .outer-container{
            background-color:rgb(35, 43, 75);
        }
        .darkmode .question-container input{
            background-color:rgb(35, 43, 75);
            color: white;
        }
        .darkmode .question-container input::placeholder{
            color: lightgrey;
        }
        .darkmode .controls{
            background-color: #232B4B;
        }
        


        
        @media only screen and (max-width: 768px) {
            .container,
            .outer-container,
            .controls,
            .quiz-details-container{
                width: 100%;
                max-width: 100%;
                padding: 10px;
            }
            .quiz-details-container {
                text-align: left;
                padding: 15px;
            }
            .quiz-details-container h2 {
                font-size: 20px;
                text-align: center;
            }

            .quiz-details-container p {
                font-size: 14px;
                margin: 5px 0;
            }
            .options-container {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .question {
                font-size: 16px;
                padding: 8px;
            }

            .option-textfield {
                font-size: 14px;
                padding: 8px;
            }

            input[type='radio'] {
                height: 20px;
                width: 20px;
            }

            .controls button {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
        
    </style>
</head>
<body>
    <audio id="background-music" loop>
        <source src="song.mp3" type="audio/mpeg">
    </audio>
    <div class="wrapper">
        <header class="header">
            <nav class="navibar">
                <a href="homepage-admin.php" class="navi-logo">
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

                    
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                            <path d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160ZM480-80q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80Z"/>
                        </svg>
                    </button>

                    
                    <a href="account-details-setting-admin.php">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                                <path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm112-260q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Z"/>
                            </svg>
                        </button>
                    </a>
                    <a href="user-details-setting-admin.php">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                <path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/></svg>
                        </button>
                    </a>

                </div>
            </nav>
        </header>
        <hr>
        <form id="quizForm" action="submit_quiz.php" method="post">
            
            <input type="hidden" name="quizname" value="<?php echo $quizname?>"> 
            <input type="hidden" name="description" value="<?php echo $description?>">
            <input type="hidden" name="timelimit" value= "<?php echo $timelimit?>">
            <div class="quiz-details-container">
                <h2>Quiz Details</h2>
                <p><strong>Quiz Name:</strong> <?php echo $quizname?></p>
                <p><strong>Description:</strong> <?php echo $description?></p>
                <p><strong>Time Limit:</strong> <?php echo $timelimit?></p>
            </div>
            <div id="container">

            </div>  
            <div class="controls">
                <button type="submit">Submit Quiz</button>
            </div>      
        </form>
    </div>
    <script>
        
        function generateQuestions() {
            const container = document.getElementById('container');
            
            for (let i = 1; i <= 20; i++) {
                const questionBox = `
                    <div class="outer-container">
                        <div class="inner-container">
                            <div class="question-container">
                                <input class="question" type="text" name="question${i}" placeholder="Enter Question ${i}" required>
                            </div>
                            <div class="options-container">
                                <div class="option">
                                    <input class="option-textfield" type="text" name="option${i}_1" placeholder="Option 1" required>
                                    <input type="radio" name="answer${i}" value="0" required>
                                </div>
                                <div class="option">
                                    <input class="option-textfield" type="text" name="option${i}_2" placeholder="Option 2" required>
                                    <input type="radio" name="answer${i}" value="1">
                                </div>
                                <div class="option">
                                    <input class="option-textfield" type="text" name="option${i}_3" placeholder="Option 3" required>
                                    <input type="radio" name="answer${i}" value="2">
                                </div>
                                <div class="option">
                                    <input class="option-textfield" type="text" name="option${i}_4" placeholder="Option 4" required>
                                    <input type="radio" name="answer${i}" value="3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    
                `;
                container.insertAdjacentHTML('beforeend', questionBox);
            }
            
        }
        generateQuestions()

    </script>
    <script type ="text/javascript" src="playBackgroundMusic.js"></script>
</body>
</html>
