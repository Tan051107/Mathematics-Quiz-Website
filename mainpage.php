<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MathMind - Master SPM Math</title>
    <link rel="stylesheet" href="styles-h.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="darkmode.js" defer></script>
    <style>
        .darkmode .signup-box {
            background: #232738;
            border: 2px white;   
        }
        .darkmode .signup-box input{
            background: #3a435d;  
            color: white;
        }
        .darkmode .signup-box::placeholder{
            color: lightgrey;  
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="navibar">
            <div class="auth-buttonss">
                <button id="theme-switch">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                        <path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q14 0 27.5 1t26.5 3q-41 29-65.5 75.5T444-660q0 90 63 153t153 63q55 0 101-24.5t75-65.5q2 13 3 26.5t1 27.5q0 150-105 255T480-120Z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
                        <path d="M480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480q0 83-58.5 141.5T480-280ZM200-440H40v-80h160v80Zm720 0H760v-80h160v80ZM440-760v-160h80v160h-80Zm0 720v-160h80v160h-80ZM256-650l-101-97 57-59 96 100-52 56Zm492 496-97-101 53-55 101 97-57 59Zm-98-550 97-101 59 57-100 96-56-52ZM154-212l101-97 55 53-97 101-59-57Z"/>
                    </svg>
                </button>
            </div>

            <a class="navi-logo">
            <img src="images/Logo.png" width="70" height="70">
            </a>            
            
            <div class="auth-buttons">
                <a href="signup.html"><button class="btn">Sign Up</button></a>
                <a href="login.html"><button class="btn">Log In</button></a>
            </div>
        </nav>
    </header>
    <hr>
    <content class="Content">
        <section class="hero">
            <div class="inhero">
                <h1>Master SPM Math & Ace Your Exam!</h1>
                <p>Unlock your SPM Math potential! MATHMIND offers comprehensive resources, practice questions, and expert tips to help you master the subject and achieve exam success.  Boost your confidence and conquer challenging concepts with our targeted learning materials.</p>
                <div class="hero-buttons">
                    <button class="btn primary">Choose Quiz Now</button>
                    <button class="btn secondary">Learn More</button>
                </div>
            </div>
        </section>
        <hr>
        <section class="features">
            <div class="image-container">
                <img class ="imgquiz" src="images/General_knowledge_quiz.png" alt="Feature Illustration">
            </div>
            <div class="features-grid">
                <div class="feature">
                    <a class ="f-icon" href="#"><i class='bx bxl-stack-overflow' ></i></a>
                    <h3>Engaging Quizzes</h3>
                    <p>Interactive questions to strengthen your fundamentals.</p>
                </div>
                <div class="feature">
                    <a class ="f-icon" href="#"><i class='bx bx-data'></i></a>
                    <h3>SPM-Centric Topics</h3>
                    <p>Focused content covering Form 1 to Form 5 chapters.</p>
                </div>
                <div class="feature">
                    <a class ="f-icon" href="#"><i class='bx bx-line-chart'></i></a>
                    <h3>Real-Time Feedback</h3>
                    <p>Get instant solutions and<br>explanations.</p>
                </div>
                <div class="feature">
                    <a class ="f-icon" href="#"><i class='bx bx-list-check'></i></a>
                    <h3>Progress Tracking</h3>
                    <p>Monitor your growth and areas for improvement.</p>
                </div>
            </div>
        </section>
        <hr>
    
        <section class="test">
            <h2>Testimonials Section</h2>
            <p>Real Success Stories from SPM Math Achievers</p>
            <div class="testimonial-container">
                <button class="leri" id="prevBtn">&#10094;</button>
                <div class="testimonial">
                    <p id="quote">"I'm a visual learner, and I really appreciate the way MATHMIND uses animations and interactive elements to explain math concepts. It makes learning so much more engaging and easier to grasp."</p>
                    <h3 id="name">Cindy Chong</h3>
                </div>
                <button class="leri" id="nextBtn">&#10095;</button>
            </div>
            <script src="hp.js"></script>
        </section>
    
        <footer class="footer">
        <div class="logo">
            <img src="images/horizontal-logo.png" alt="MathMind Logo">
            <p>MATHWIND@2024. All rights reserved</p>
        </div>
        <div class="social">
            <a href="AboutUsPage.php"><h3>Join Us</h3></a>
            <div class="icons">
                <a href="https://www.youtube.com/"><i class='bx bxl-youtube' ></i></a>
                <a href="https://www.facebook.com/"><i class='bx bxl-facebook' ></i></a>
                <a href="https://x.com/"><i class='bx bxl-twitter'></i></a>
                <a href="https://www.instagram.com/"><i class='bx bxl-instagram' ></i></a>
            </div>
        </div>
    </footer>
        
    </body>
    </html>    
    </content>
    