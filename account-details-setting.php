<?php
    session_start();

    if (!isset($_SESSION["email"], $_SESSION["role"])) {
        header("Location: login.html");
        exit();
    }
    if ($_SESSION["role"] === "admin") {
        header("Location: homepage-admin.php");
        exit();
    }
    
    
    include 'connection.php';

    error_reporting(0);

    $msg = "";
    $email = $_SESSION["email"];
    


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = "";
        $password = "";
        $isValid = true;

        // Validate username
        if (empty($_POST['username-input'])) {
            $isValid = false;
        } else {
            $username = input_data($_POST['username-input']);
            if (!preg_match("/^[a-zA-Z0-9]{3,15}$/", $username)) {
                $isValid =false;
            }
        }

        // Validate password
        if (empty($_POST['password-input'])) {
            $isValid = false;
        } else {
            $password = input_data($_POST['password-input']);
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,12}$/", $password)) {
                $isValid =false;
            }
        }

        if ($isValid === true){
            $query = "UPDATE useraccount
                    SET Password='$password', Username='$username'
                    WHERE Email='$email'";
            if (mysqli_query($connection, $query)) {
                echo ("Profile Updated");
            } else {
                die('Error updating profile! Please try again.'
                    . mysqli_error($connection));
            }
        }

        if($isValid === false){
            echo"Profile Update error";
        }

    }

    function input_data($data)
        {

            $data = trim($data);
            $data = htmlspecialchars($data);
            return $data;
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="setting.css">
    <script type="text/javascript" src="darkmode1.js" defer></script>
    <script type ="text/javascript" src="log-out-confirmation.js"></script>
    <style>
        .edit-profile-section{
            border:solid;
            border-color:var(--input-text-background-color);
            padding-left:3%;
        }


        .checkbox-container {
            display:flex;
            flex-direction:row;
            align-items:center;
            margin-top:2%;
            gap:1%;

        }

        input[type="checkbox"] {
            width: 100%;
        }

        @media(max-width:450px){
            .save-button{
                width:80px;
                height:30px;
            }

            input[type="checkbox"] {
                width: 50%;
            }

        }





        

    </style>
</head>
<body>
    <audio id="background-music" loop>
        <source src="song.mp3" type="audio/mpeg">
    </audio>
    <div class="top">
        <div class="top-left">
            <a href="homepage-admin.php"><img class="logo" src="images/horizontal-logo.png" alt=""></a>
        </div>
        <div class="top-right">
            <div class="icon-box">
                <div class="auth-buttons">                   
                    <button id="theme-switch-button" >
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                            <path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                            <path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/>
                        </svg>
                    </button>
                </div>
                <div class="icon-section" id="theme-switch">
                    <div class="light-mode-icon">
                        <a href="#"><img src="images/black-notification-bell.png" class="icon" alt=""></a>
                        <a href="account-details-setting.php"><img src="images/black-settings.png" class="icon" alt=""></a>
                        <div class="profile-icon-outer-box">
                            <img src="images/black-profile.png" alt="" class="icon">
                            <div class="profile-icon-content-box">
                                <a href="user-details-setting.php" class="profile-icon-content">Profile</a>
                                <a href="#"class="profile-icon-content" onclick="logOutConfirmation()">Log Out</a>
                            </div>
                        </div>
                    </div>
                    <div class="dark-mode-icon">
                        <a href="#"><img src="images/white-notification-bell.png" class="icon" alt=""></a>
                        <a href="account-details-setting.php"><img src="images/white-settings.png" class="icon" alt=""></a>
                        <div class="profile-icon-outer-box">
                            <img src="images/white-profile.png" class="icon" alt="">
                            <div class="profile-icon-content-box">
                                <a href="user-details-setting.php" class="profile-icon-content">Profile</a>
                                <a href="#"class="profile-icon-content" onclick="logOutConfirmation()">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="bottom">
        <h1 class="settings">Settings</h1>
        <div class="edit-section">
            <nav class="edit-type-box">
                <ul class="edit-type-content">
                    <li>
                        <a href="user-details-setting.php" class="edit-type">Edit Profile</a>
                    </li>
                    <li>
                        <a href="account-details-setting.php" class="edit-type current-page">Account Settings</a>
                    </li>
                    <li>
                        <a href="quiz-setting.php" class="edit-type">Quizz Settings</a>
                    </li>
                    <li>
                        <a href="account-history-setting.php" class="edit-type">History</a>
                    </li>
                </ul>
            </nav>
            <div class="edit-profile-section">
                <h2 class="edit-section-font">Account Details</h2>
                <?php
                    $email= $_SESSION["email"];
                    $query = "SELECT * FROM useraccount WHERE Email='$email'";
                    $result=mysqli_query($connection,$query);
                    if (mysqli_num_rows($result)==1){
                        $details = mysqli_fetch_assoc($result);
                ?>
                <form action="#" method="POST" id="account-details-form">
                    <div class="other-details">
                        <label for="username">Username</label>
                        <br>
                        <input id="username-input" name="username-input" type="text" value=<?php echo $details["username"]?>>
                        <div id="username-error" class="invalid-message"></div>
                    </div>
                    <div class="other-details">
                        <label for="password">Password</label>
                        <br>
                        <input name="password-input" type="password" id="accPassword" value=<?php echo $details["password"]?>>
                        <div id="password-error" class="invalid-message"></div>
                    </div>
                    <div class="checkbox-container">
                        <div><label for="">Show Password</label></div>
                        <div><input type="checkbox" onclick="showPassword()"></div>
                    </div>
                    <p style="text-align:end">
                        <input type="Submit" name="saveButton" value="Save" class="save-button">
                    </p>
                </form>
                <?php
                    }
                    mysqli_close($connection);
                ?>
             </div>
             <script type ="text/javascript" src="validateAccDetails.js"></script>
             <div>
                <ul class="footer">
                        <li>
                            <a class=icon-box href="#"><img class="footer-image" src="images/home icon black.png" alt=""><p>Home</p></a>
                        </li>
                        <li>
                            <a class=icon-box href="#"><img class="footer-image" src="images/explore black.png" alt=""><p>Explore</p></a>
                        </li>
                        <li>
                            <a class=icon-box href="#"><img class="footer-image" src="images/inbox black.png" alt=""><p>Inbox</p></a>
                        </li>
                        <li>
                            <a class=icon-box href="#"><img class="footer-image" src="images/black-profile-icon.png" alt=""><p>Profile</p></a>
                        </li>
                </ul>
            </div>
    </div>
    <div id="footer-section">
                <ul class="footer">
                        <li>
                            <a class=footer-icon-box href="#"><img class="footer-image" src="images/home icon black.png" alt=""><p>Home</p></a>
                        </li>
                        <li>
                            <a class=footer-icon-box href="#"><img class="footer-image" src="images/explore black.png" alt=""><p>Explore</p></a>
                        </li>
                        <li>
                            <a class=footer-icon-box href="#"><img class="footer-image" src="images/inbox black.png" alt=""><p>Inbox</p></a>
                        </li>
                        <li>
                            <a class=footer-icon-box href="#"><img class="footer-image" src="images/black-profile-mobile.png" alt=""><p>Profile</p></a>
                        </li>
                </ul>
                <ul class="footer">
                        <li>
                            <a class=footer-icon-box href="#"><img class="footer-image" src="images/home icon white.png" alt=""><p>Home</p></a>
                        </li>
                        <li>
                            <a class=footer-icon-box href="#"><img class="footer-image" src="images/explore white.png" alt=""><p>Explore</p></a>
                        </li>
                        <li>
                            <a class=footer-icon-box href="#"><img class="footer-image" src="images/inbox white.png" alt=""><p>Inbox</p></a>
                        </li>
                        <li>
                            <a class=footer-icon-box href="#"><img class="footer-image" src="images/white-profile-mobile.png" alt=""><p>Profile</p></a>
                        </li>
                </ul>
    </div>
    <script>
                function showPassword(){
                    var password = document.getElementById("accPassword")
                    if (password.type==="password"){
                        password.type = "text";
                    }
                    else{
                        password.type ="password";
                    }
                }
    </script>
    <script type ="text/javascript" src="playBackgroundMusic.js"></script>
    

</body>
</html>