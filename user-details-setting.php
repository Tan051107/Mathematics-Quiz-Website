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
 
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $fname = "";
        $lname = "";
        $email = "";
        $phone = "";
        $dob = $_GET["dob"];
        $isValid = true;

        // Validate first name
        if (empty($_GET["fname"])) {
            $isValid = false;
        } else {
            $fname = input_data($_GET["fname"]);
            // To check that User Name only contains alphabets, numbers, and underscores 
            if (!preg_match("/^[a-zA-Z]{1,30}$/", $fname)) {
                $isValid =false;
            }
        }

        // Validate last name 
        if (empty($_GET["lname"])) {
            $isValid = false;
        } else {
            $lname = input_data($_GET["lname"]);
            // To check that User Name only contains alphabets, numbers, and underscores 
            if (!preg_match("/^[a-zA-Z]{1,30}$/", $lname)) {
                $isValid =false;
            }
        }

        // Validating email 
        if (empty($_GET["email"])) {
            $isValid = false;
        } else {
            $email= input_data($_GET["email"]);
            // To check that the e-mail address is well-formed  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $isValid = false;
            }
        }

        // Validating the User Phone Number 
        if (empty($_GET["phone"])) {
            $isValid = false;
        } else {
            $phone= input_data($_GET["phone"]);
            // To check that Phone No is well-formed  
            if (!preg_match("/^01[0-9]{8,9}$/", $phone)) {
                $isValid = false;
            }
        }

        if ($isValid === true){
            $query = "UPDATE useraccount
            SET first_name='$fname', last_name='$lname', email = '$email', phone_number = '$phone' , date_of_birth ='$dob'
            WHERE email='$email'";
            
            if (mysqli_query($connection, $query)) {
                echo ("Profile Updated");
            } else {
                die('Error updating profile! Please try again.'
                    . mysqli_error($connection));
            }
        }

        




    }

    function input_data($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["uploadfile"])) {
        $file = $_FILES["uploadfile"];
        $targetDir = "profilepic/";

        $FileName = $file["name"];
        $targetFile = $targetDir . $FileName;

        $sql = "UPDATE useraccount
                SET profile_pic = '$FileName'
                WHERE email = '$email'";
            
        mysqli_query($connection, $sql);

        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            echo "File uploaded successfully: " . htmlspecialchars($file["name"]);
        } else {
            echo "Error: File upload failed!";
        }
        exit;
    }

    if (isset($_POST['removeButton'])){


        $query = "UPDATE useraccount
        SET profile_pic = 'black-profile.png'
        WHERE email = '$email'";

        if (mysqli_query($connection, $query)) {
        } else {
            die('Error updating profile! Please try again.'
                . mysqli_error($connection));
        }

        header("Location:user-details-setting.php");





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
    <title>User Details Setting</title>
    <link rel="stylesheet" href="setting.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="darkmode1.js" defer></script>
    <script type ="text/javascript" src="log-out-confirmation.js"></script>
     <style>

        .edit-profile-pic-section{
            width:100%;
            padding-left:1%;
            border:solid;
            border-color:var(--input-text-background-color);
        }

        .edit-profile-pic-box{
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            align-items:center;
            width:100%;
            margin-bottom:3%
        }

        .profile-pic{
            width: 100%;    
            border:none;
            background-color:rgba(128, 128, 128, 0.226);
            border-radius:50%;
        }

        .edit-section-font{
            font-size:1.5vw
        }

        .vertical-line{
            border-left:12px;
            border:solid;
            border-color:var(--input-text-background-color);
            display:inline-block;
            border-width:1px;
            height:130px;

        }

        @media(max-width:750px){
            .vertical-line{
            border-left:12px;
            border:solid;
            border-color:rgba(128, 128, 128, 0.315);
            display:inline-block;
            border-width:1px;
            height:80px;
            

        }}

        .upload-remove{
            width:25%;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:space-around;

        }

        .upload-photo-button{
            border-color:#336DFF;
            background-color:white;
            color:#336DFF;
            width:100%;
            padding-top:5%;
            padding-bottom:5%;
            margin-bottom:3%;
            height:100%;
            border:solid;
            font-weight:bold;
            font-size:1.5vw;
        }
        
        .upload-photo-button:hover{
            background-color:#336DFF;
            color:white;
        }

        .remove-font{
            font-size:1.5vw;
            text-align:center;
            color:var(--font-color)
        }


        .requirement-box{
            width:20%;

        }

        .image-requirement{
            margin-top:0;
            margin-bottom:10px;
            font-size:1vw;
        }

        .image-requirement-title{
            margin-top:0;
            margin-bottom:10px;
            font-size:1.2vw;
            font-weight:bold;

        }

        .edit-user-details-section{
            width:100%;
            padding-left:1%;
            border:solid;
            border-color:var(--input-text-background-color);
            margin-top:5%;
         }

         .first-name-input{
            width:40%;
            

        }

        .last-name-input{
            width:40%;
           
        }


        .name-input{
            display:flex;
            width:100%;
            flex:row;
            justify-content:space-between;
        }


        #profile-pic-input{
            display:none;
        }

        #profilePic{
            width: 160px;
            height: 160px; 
            border-radius: 50%; 
            object-fit: cover;
            border: 3px solid #ddd; 
            display: block;
        }


        @media(max-width:850px){
            #profilePic {
                width: 100px;
                height: 100px;
            }

        }

        @media(max-width:450px){
            .save-button{
                width:80px;
                height:30px;
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
            <a href="homepage-user.php"><img class="logo" src="images/horizontal-logo.png" alt=""></a>
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
                            <img src="images/black-profile.png" alt=""class="icon">
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
                            <img src="images/white-profile.png" class="icon"  alt="">
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
                        <a href="user-details-setting.php" class="edit-type current-page">Edit Profile</a>
                    </li>
                    <li>
                        <a href="account-details-setting.php" class="edit-type">Account Settings</a>
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
                <div class="edit-profile-pic-section">
                    <h2 class="edit-section-font">Profile Photo</h2>
                    <div class="edit-profile-pic-box">
                        <div class="profile-pic-container">
                            <?php
                                $email = $_SESSION["email"];
                                $query = "SELECT * FROM useraccount WHERE email='$email'";;
                                $result = mysqli_query($connection, $query);
                                if (mysqli_num_rows($result)==1){
                                    $details = mysqli_fetch_assoc($result);

                            ?>
                            
                            <img id="profilePic" src="./profilepic/<?php echo $details['profile_pic']; ?>" alt="Profile Picture">


                            <?php
                                }
                            ?>
                        </div>
                        <div class="upload-remove">
                            <input type="file" id="profile-pic-input" accept="image/*" name="profile-pic-input">
                            <button class="upload-photo-button" id="upload-profile-pic-button" onclick="document.getElementById('profile-pic-input').click()">Upload Photo</button>
                            <form action="#" method="POST">
                                <input type="Submit" value="Remove" name="removeButton" class="upload-photo-button">
                            </form>
                            <div id="invalid-photo message" class="invalid-message"></div>
                        </div>
                        <div class="vertical-line"></div>
                        <div class="requirement-box">
                            <p class="image-requirement-title">Image Requirements:</p>
                            <p class="image-requirement">1. Min. 400 x 400px</p>
                            <p class="image-requirement">2. Max. 2MB</p>
                            <p class="image-requirement">3. Your preferred photo</p>
                        </div>
                    </div>
                </div>
                <script type ="text/javascript" src="upload-profile-pic.js"></script>
                <div class="edit-user-details-section">
                    <h2 class="edit-section-font">User Details</h2>
                    <?php
                       $email= $_SESSION["email"];
                       $query = "SELECT * FROM useraccount WHERE email='$email'";
                       $result=mysqli_query($connection,$query);
                       if (mysqli_num_rows($result)==1){
                            $details = mysqli_fetch_assoc($result);
                    ?>
                    <form action="#" method="GET" id="user-details-form">
                        <div class="name-input">
                            <div class="first-name-input">
                                <label for="fname">First Name</label>
                                <br>
                                <input type="text" name="fname" id="fname" value=<?php echo $details["first_name"]?>>
                                <div id="fname-error" class="invalid-message"></div>
                            </div>
                            <div class="last-name-input">
                                <label for="lname">Last Name</label>
                                <br>
                                <input type="text" name ="lname" id ="lname" value=<?php echo $details["last_name"]?>>
                                <div id="lname-error" class="invalid-message"></div>
                            </div>
                        </div>
                        <div class="other-details">
                            <label for="email">Email</label>
                            <br>
                            <input type="email" name="email" id="email" value=<?php echo $details["email"]?> readonly>
                            <div id="email-error" class="invalid-message"></div>
                        </div>
                        <div class="other-details">
                            <label for="phone">Phone Number</label>
                            <br>
                            <input type="tel" name="phone" id="phone" value=<?php echo $details["phone_number"]?>>
                            <div id="phone-error" class="invalid-message"></div>
                        </div>
                        <div class="other-details">
                            <label for="dob">Date of Birth</label>
                            <br>
                            <input type="date" name="dob" id="dob" type="text"  value=<?php echo $details["date_of_birth"]?>>
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
            </div>
            <script type ="text/javascript" src="validateUserDetails.js"></script>
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
    <script type ="text/javascript" src="playBackgroundMusic.js"></script>
</body>
</html>