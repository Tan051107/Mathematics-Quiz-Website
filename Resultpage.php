<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["score"], $_POST["time_taken"], $_POST["percentage"])) {
    header("Location: homepage-user.php");
    exit(); 
}


$no_of_correct_ans = $_POST["score"];
$time_taken = $_POST["time_taken"];
$percentage = $_POST["percentage"]; 


$minutes = floor($time_taken / 60);
$seconds = $time_taken % 60;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link rel="stylesheet" href="result.css">
    <link rel="stylesheet" href="headernew.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="darkmode.js" defer></script>
    <style>
        .pie-chart,
        .progress-circle {
            width: 300px;
            height: 300px;
            margin: 0 auto;
            border-radius: 50%;
            background: conic-gradient(#6c757d <?php echo $percentage."%"; ?>, #adb5bd <?php echo $percentage."%"; ?>);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: bold;
            color: #333;
        }
        
        @media (max-width: 768px) {
            .charts-container {
                flex-direction: column;
                align-items: center;
            }

            .chart {
                width: 80%;
            }

            .pie-chart, .progress-circle {
                width: 220px;
                height: 220px;
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
                
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                        <path d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160ZM480-80q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80Z"/>
                    </svg>
                </button>
                
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
    <div class="badge">
        <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Badge">
    </div>
    <div class="title">Great Job!</div>
    <div class="time">Time Taken: <?php echo $minutes." Minutes ".$seconds." Seconds" ;?></div>
    <hr>
    <div class="charts-container">
        <div class="chart">
            <h3>Question <br> Analysis</h3>
            <div class="legend">
                <div class="legend-item">
                  <div class="legend-dot correct"></div>
                  <span>Correct</span>
                </div>
                <div class="legend-item">
                  <div class="legend-dot wrong"></div>
                  <span>Wrong</span>
                </div>
            </div>
            <div class="pie-chart"><?php echo $no_of_correct_ans."/20"; ?></div>
        </div>
        <div class="chart">
            <h3>Total <br> Marks</h3>
            <div class="legend">
                <div class="legend-item">
                  <div class="legend-dot correct"></div>
                  <span>Correct</span>
                </div>
                <div class="legend-item">
                  <div class="legend-dot wrong"></div>
                  <span>Wrong</span>
                </div>
            </div>
            <div class="progress-circle"><?php echo $percentage."%"; ?></div>
        </div>
    </div>
    <hr>
    <div class="containers">
        <h2>Your Quiz Results are In!</h2>
        <p>Congratulations! You've completed the quiz. Now, it's time to analyze your performance and unlock your full potential. <br>
            This page provides a detailed breakdown of your quiz results, highlighting your strengths and areas for improvement. <br><br>
            Try a New Quiz: Feeling confident? Challenge yourself with a different topic! Choose "Try a New Quiz" to explore new concepts, expand your knowledge, and continue your learning journey. <br><br>
            Don't be discouraged by any incorrect answers. Every attempt is an opportunity to learn and grow. Use this feedback to identify areas for improvement and continue to strive for excellence. <br>
            I hope this expanded description is helpful.</p>
        <div class="buttons">
            <a href="QuizzDropDown.php"><button class="btn">Retake Quiz</button></a>
            <a href="QuizzDropDown.php"><button class="btn">Try a New Quiz</button></a>
        </div>
    </div><br>
    <footer class="footer">
        <div class="logo">
                <img src="images/horizontal-logo.png" alt="MathMind Logo">
                <p>MATHWIND@2024. All rights reserved</p>
        </div>
        
        
        <div class="social">
            <h3>Join Us</h3>
            <div class="icons">
                <a href="https://www.youtube.com/"><i class='bx bxl-youtube' ></i></a>
                <a href="https://www.facebook.com/"><i class='bx bxl-facebook' ></i></a>
                <a href="https://x.com/"><i class='bx bxl-twitter'></i></a>
                <a href="https://www.instagram.com/"><i class='bx bxl-instagram' ></i></a>
            </div>
        </div>
    </footer>
    <script type ="text/javascript" src="playBackgroundMusic.js"></script>
</body>
</html>