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
    <title>Account Details Setting</title>
    <link rel="stylesheet" href="headernew.css">
    <link rel="stylesheet" href="headernew.css">
    <script type="text/javascript" src="darkmode.js" defer></script>
    <style>
        .form-container {
            display:flex;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            justify-content:center;
        }

        .form-group {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            justify-content:space-between;
        }

        .form-group input{
            width: 48%;
        }
        .form-container input {
            width: 92%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            margin:5px;
            
        }

        .register-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .register-btn:hover {
            background-color: #0056b3;
        }
        .add-admin-section{
            flex-grow: 1;
            padding: 20px;
            text-align: center;
            
        }
        .add-admin-section h2{
            font-size: 2rem;
            margin-bottom: 20px;
            margin-top:20px
        }

        .bottom{
            width:100%;
        }

        .settings{
            font-size:4vw;
            padding-left:3%;

        }

        .edit-section{
            display:flex;
            flex-direction:row;
            justify-content:left;
            padding-left:3%;
        }

        .edit-type-box{
            border:solid;
            border-color:rgba(128, 128, 128, 0.429);
            width:20%;
            height:30%;
            border-width: 2px;
            display:flex;
            flex-direction: column;
            justify-content:space-between;
        }


        .edit-type{
            font-weight:bold;
            padding-left:8px;
            font-size:1.5vw;
            text-decoration:none;
            color:black;
            font-family:Roboto;
        }


        li a:hover:not(.current-page){
            background-color: rgba(128, 128, 128, 0.429);
        }

        .edit-profile-section{
            width:65%;
            margin-left:8%;
            
        }

        .edit-section-font{
            font-size:1.5vw
        }

        label{
            font-family: arial;
            font-size:1.5vw;
        }
        ul{
            list-style-type: none;
            margin:0;
            padding:0;
        }

        li{
            list-style-type:none;
        }

        li a{
            display:block;
            padding:5%
        }
        .current-page{
            background-color:#78CDD7
        }
        
        .darkmode .edit-type{
            color:white;
            
        }
        .darkmode .form-container{
            background-color: #232738;
        }
        .darkmode .form-container input{
            background-color: #3a435d;
            color:white;
        }
        .darkmode .form-container input::placeholder {
            color: #bbb;
        }
        




        @media only screen and (max-width: 768px) {
            .edit-section{
                flex-direction: column;
                padding:2%;
                height:auto;
                
            }
            .edit-type-box,
            .history-section {
                width: 100%;   
            }
            .history-container{
                padding:2%;
                margin-right: 20px;
            }
            .edit-type{
                font-weight:bold;
                font-size:3.5vw;
                text-decoration:none;
                color:black;
                font-family:Roboto;
                
            }
            li{
                list-style-type:none;
                text-align:center;
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
    <br>

    <div class="bottom">
        <h1 class="settings">Settings</h1>
        <div class="edit-section">
            <nav class="edit-type-box">
                <ul>
                    <li>
                        <a href="user-details-setting-admin.php" class="edit-type">Edit Profile</a>
                    </li>
                    <li>
                        <a href="account-details-setting-admin.php" class="edit-type">Account Settings</a>
                    </li>
                    <li>
                        <a href="quiz-setting-admin.php" class="edit-type">Quizz Settings</a>
                    </li>
                    <li>
                        <a href="account-history-setting-admin.php" class="edit-type">History</a>
                    </li>
                    <li>
                        <a href="account-addAdmin-setting.php" class="edit-type current-page">Add Admin</a>
                    </li>
                </ul>
            </nav>

            <div class="add-admin-section">
                <h2 class="add-admin-section-font">New Admin Registration</h2>
                <div class="form-container">
                    <form id="add-admin-form" action="save-admin.php"method="POST" onsubmit="return validateForm()">
                        <div class="form-group">
                            <input type="text" id="fname" name="fname" placeholder="First Name" required>
                            <input type="text" id="lname" name="lname" placeholder="Last Name" required>
                        </div>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                        <input type="text" id="username" name="username" placeholder="Username" required>
                        <br>
                        <input type="text" id="password" name="password" placeholder="Password" required>
                        <button type="submit" class="register-btn">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            const firstName = document.getElementById("fname").value.trim();
            const lastName = document.getElementById("lname").value.trim();
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();

            //firstname
            if (!firstName.match(/^[a-zA-Z]{1,30}$/)) {
                alert("Invalid First Name. It should only contain letters and be 1-30 characters long.");
                return false;
            }       

            //last name
            if (!lastName.match(/^[a-zA-Z]{1,30}$/)) {
                alert("Invalid Last Name. It should only contain letters and be 1-30 characters long.");
                return false;
            }

            //email
            if (!email.match(/^[^@\s]+@[^@\s]+\.[^@\s]+$/)) {
                alert("Invalid Email Format.");
                return false;
            }

            //username
            if (!username.match(/^[a-zA-Z0-9]{3,15}$/)) {
                alert("Invalid Username. It should be 3-15 characters long and contain only letters and numbers.");
                return false;
            }

            //password
            if (!password.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,12}$/)) {
                alert("Invalid Password. It must be 8-12 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character (@$!%?&).");
                return false;
            }

            return true;
        }
    </script>
    <script type ="text/javascript" src="playBackgroundMusic.js"></script>
</body>
</html>