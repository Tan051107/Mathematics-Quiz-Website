<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header("Location: login.html");
    exit();
}

$email = $_SESSION['email'];
$role = $_SESSION['role'];

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["quizid"], $_POST["timelimit"])) {
    header("Location: homepage-user.php");
    exit(); 
}

$quizid = (int)$_POST["quizid"];
$timelimit =(int)($_POST["timelimit"]*60);
include 'connection.php';

$query = "SELECT questionid, question, option1, option2, option3, option4, answer FROM questionstable where quizid = $quizid" ;
$results = mysqli_query($connection,$query);
$questions = [];

while ($row = mysqli_fetch_assoc($results)) {
    $questions[] = [
        "id" => $row["questionid"],
        "question" => $row["question"],
        "options" => [$row["option1"], $row["option2"], $row["option3"], $row["option4"]],
        "answer" => (int)$row["answer"]
    ];
}
$questions_json = json_encode($questions);
mysqli_close($connection);
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
    <title>MathMind - Quiz</title>
    <link rel="stylesheet" href="headernew.css">
    <script type="text/javascript" src="darkmode.js" defer></script>
    
    <style>
        .edit-profile-section{
            border:solid;
            border-color:rgba(128, 128, 128, 0.429);
            padding-left:3%;
        }
        .quiz-container {
            margin: 50px auto;
            width: 90%; 
            max-width: 600px; 
        }
        .question {
            font-size: 24px;
            margin-bottom: 30px;
            text-align: center;
        }

        .progress-bar-container { width: 100%; height: 10px; background: #ddd; border-radius: 5px; margin-bottom: 20px; }
        .progress-bar { height: 100%; width: 0%; background: #78CDD7; border-radius: 5px; transition: width 0.3s; }

        .options-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            justify-content: center;
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
            cursor: pointer;
            transition: background-color 0.2s ease;

        }

        .option:hover {
            background-color: #44A1A0;
        }

        .selected { 
            background-color: #78CDD7; 
            color: white; 
        }

        .button-container { 
            display: flex; 
            justify-content: space-between; 
            margin-top: 20px; 
        }
        .btn { 
            padding: 10px 20px; 
            font-size: 16px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }

        .next-btn {
            background-color: #78CDD7; 
            color: white;
            display: none;
            transition: background-color 0.2s ease;
        }
        .next-btn:hover{
            background-color: #44A1A0;
        }

        .back-btn { 
            background-color: #6c757d; 
            color: white; 
            display: none; 
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #44A1A0;
        }
        .submit-btn{
            background-color:rgb(28, 214, 152); 
            color: white;
            display: none;
            transition: background-color 0.2s ease;
        }
        .submit-btn:hover {
            background-color: #44A1A0;
        }
        .quiz-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 20px;
            margin: 10px 0;
        }
        .quiz-header h2{
            margin: 10px 0;
        }
        #timer {
            font-size: 18px;
            font-weight: bold;
            color: red;
            background-color:lightgrey;
            padding:5px;
            border-radius:5px;
        }
        .darkmode .option{
            background-color: #3a435d;
        }
        .darkmode .option:hover {
            background-color: #44A1A0;
        }

        .darkmode .selected { 
            background-color: #78CDD7; 
            color: white; 
        }

        @media only screen and (max-width: 768px) {
            .quiz-container {
                width: 95%; 
            }

            .question {
                font-size: 20px; 
            }

            .options-container {
                grid-template-columns: 1fr; 
                gap: 10px; 
            }

            .option {
                height: 80px; 
                font-size: 16px; 
            }
            .button-container {
                flex-direction: column; 
                gap: 10px; 
            }

            .btn {
                width: 100%;
            }

            .quiz-header {
                flex-direction: column; 
                align-items: flex-start;
                padding: 10px;
            }

            #timer {
                margin-top: 10px; 
            }
        }
    </style>
</head>
<body>
    <script>
        const startTime = new Date().getTime(); 
    </script>
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
    
    <div class="quiz-header">
        <h2>Quiz</h2>
        <div id="timer">Time Left: <span id="time-left"></span></div>
    </div>
    <div class="quiz-container">
        <div class="progress-bar-container">
            <div class="progress-bar" id="progress-bar"></div>
        <br>
        <br>
        <br>

        <div class="question" id="question">Loading...</div>
        <br>
        <br>
        <div class="options-container">
            <div class="option" onclick="selectAnswer(0)" id="option1">Option 1</div>
            <div class="option" onclick="selectAnswer(1)" id="option2">Option 2</div>
            <div class="option" onclick="selectAnswer(2)" id="option3">Option 3</div>
            <div class="option" onclick="selectAnswer(3)" id="option4">Option 4</div>
        </div>
        <div class="button-container">
            <button class="btn back-btn" onclick="prevQuestion()" id="back-btn">Back</button>
            <button class="btn next-btn" onclick="nextQuestion()" id="next-btn">Next</button>
            <button class="btn submit-btn" onclick="submitQuiz()" id="submit-btn" style="display: none;">Submit</button>
        </div>
    </div>
    <form id="quizForm" action="save_results.php" method="POST" style="display: none;">
        <input type="hidden" name="quizid" id="quizid">
        <input type="hidden" name="email" id="email">
        <input type="hidden" name="score" id="score">
        <input type="hidden" name="time_taken" id="time_taken">
        <input type="hidden" id="percentage" name="percentage">
        
    </form>    
    <script>
        const questions = <?php echo $questions_json; ?>

        let currentQuestionIndex = 0;
        let userAnswers = [];

        function loadQuestion() {
            if (currentQuestionIndex >= questions.length) {
                submitQuiz();
                return;
            }
            
            const currentQuestion = questions[currentQuestionIndex];
            document.getElementById("question").textContent = currentQuestion.question;
            document.getElementById("option1").textContent = currentQuestion.options[0];
            document.getElementById("option2").textContent = currentQuestion.options[1];
            document.getElementById("option3").textContent = currentQuestion.options[2];
            document.getElementById("option4").textContent = currentQuestion.options[3];

            document.getElementById("next-btn").style.display = userAnswers[currentQuestionIndex] !== undefined ? "block" : "none";
            document.getElementById("back-btn").style.display = currentQuestionIndex > 0 ? "block" : "none";
            
            updateProgressBar();
            highlightSelectedAnswer();
        }

        function selectAnswer(selectedIndex) {
            userAnswers[currentQuestionIndex] = selectedIndex;
            if (currentQuestionIndex === questions.length - 1) {
                document.getElementById("next-btn").style.display = "none";
                document.getElementById("submit-btn").style.display = "block";
            } else {
                document.getElementById("next-btn").style.display = "block";
                document.getElementById("submit-btn").style.display = "none";
            } 
            highlightSelectedAnswer();
        }

        function nextQuestion() {
            currentQuestionIndex++;
            loadQuestion();
        }

        function prevQuestion() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                loadQuestion();
            }
        }

        function highlightSelectedAnswer() {
            document.querySelectorAll(".option").forEach((option, index) => {
                option.classList.toggle("selected", userAnswers[currentQuestionIndex] === index);
            });
        }

        function updateProgressBar() {
            const progress = ((currentQuestionIndex + 1) / questions.length) * 100;
            document.getElementById("progress-bar").style.width = progress + "%";
        }

        function submitQuiz() {
            let correctCount = 0;
            questions.forEach((q, index) => {
                if (userAnswers[index] === q.answer) correctCount++;
            });
            const endTime = new Date().getTime(); 
            const timetaken = Math.floor((endTime - startTime) / 1000); 
            let percentage = Math.round((correctCount / questions.length) * 100);

            
            
            
            document.getElementById("quizid").value = <?php echo $quizid; ?>;
            document.getElementById("email").value = "<?php echo "$email"; ?>";
            document.getElementById("score").value = correctCount;
            document.getElementById("time_taken").value = timetaken;
            document.getElementById("percentage").value = percentage;

            document.getElementById("quizForm").submit();
            
        }

        let timeLeft = <?php echo $timelimit; ?>;
        const timerDisplay = document.getElementById("time-left");

        const timerInterval = setInterval(() => {
            timeLeft--;
            timerDisplay.textContent = `${Math.floor(timeLeft / 60)}:${timeLeft % 60 < 10 ? "0" : ""}${timeLeft % 60}`;
            sessionStorage.setItem("quizTime", timeLeft);
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                submitQuiz();
            }
        }, 1000);
        
        
        loadQuestion();
    </script>
    <script type ="text/javascript" src="playBackgroundMusic.js"></script>
</body>
</html>