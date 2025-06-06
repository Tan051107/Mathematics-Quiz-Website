-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 08:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `questionstable`
--

CREATE TABLE `questionstable` (
  `questionid` int(11) NOT NULL,
  `quizid` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(50) NOT NULL,
  `option2` varchar(50) NOT NULL,
  `option3` varchar(50) NOT NULL,
  `option4` varchar(50) NOT NULL,
  `answer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questionstable`
--

INSERT INTO `questionstable` (`questionid`, `quizid`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, 1, 'Solve for x: 2x + 5 = 15', 'x = 5', 'x = 7', 'x = 10', 'x = 2', 0),
(2, 1, 'What is (x + 3)(x - 3)?', 'x^2 + 9', 'x^2 - 9', 'x^2 - 6x', 'x^2 + 6x + 9', 1),
(3, 1, 'Simplify: (2x^2 - 3x + 4) + (x^2 + 5x - 2)', '3x^2 + 2x + 2', 'x^2 + 2x + 2', '3x^2 - 8x + 2', '3x^2 - 2x - 6', 0),
(4, 1, 'What is the value of x in 3x - 7 = 11?', 'x = 2', 'x = 4', 'x = 6', 'x = 9', 2),
(5, 1, 'Factorize: x^2 - 7x + 12', '(x - 3)(x - 4)', '(x + 3)(x + 4)', '(x - 6)(x - 2)', '(x - 1)(x - 12)', 0),
(6, 1, 'Find the slope of the line passing through (2,3) and (5,9)', '2', '3', '1', '1.5', 1),
(7, 1, 'If f(x) = 2x + 3, what is f(4)?', '5', '8', '11', '12', 2),
(8, 1, 'Which of the following is a quadratic equation?', 'x + 2 = 5', '2x^2 - 3x + 1 = 0', 'x - 5 = 2x', 'x^3 - 4x = 0', 1),
(9, 1, 'Solve: x^2 - 9 = 0', 'x = 3', 'x = -3', 'x = ±3', 'x = 9', 2),
(10, 1, 'What is the product of (x - 5)(x + 2)?', 'x^2 - 3x - 10', 'x^2 + 7x - 10', 'x^2 - 7x - 10', 'x^2 - 7x + 10', 0),
(11, 2, 'What is the sum of interior angles of a triangle?', '90°', '120°', '180°', '360°', 2),
(12, 2, 'A square has a perimeter of 20 cm. What is its side length?', '4 cm', '5 cm', '6 cm', '10 cm', 1),
(13, 2, 'What is the area of a circle with radius 7 cm? (Use π ≈ 3.14)', '153.86 cm²', '144 cm²', '49 cm²', '21 cm²', 0),
(14, 2, 'Which shape has all sides equal and all angles 90°?', 'Rectangle', 'Rhombus', 'Square', 'Parallelogram', 2),
(15, 2, 'What is the name of a polygon with 8 sides?', 'Pentagon', 'Hexagon', 'Octagon', 'Decagon', 2),
(16, 2, 'Find the length of the hypotenuse of a right triangle with legs 6 cm and 8 cm.', '10 cm', '12 cm', '14 cm', '8 cm', 0),
(17, 2, 'What is the volume of a cube with side length 4 cm?', '16 cm³', '32 cm³', '64 cm³', '128 cm³', 2),
(18, 2, 'If two angles are complementary, what is their sum?', '90°', '180°', '360°', '45°', 0),
(19, 2, 'What type of triangle has two equal sides?', 'Scalene', 'Isosceles', 'Equilateral', 'Right', 1),
(20, 2, 'A parallelogram has adjacent angles of 70° and 110°. What is the sum of its angles?', '180°', '360°', '270°', '90°', 1),
(21, 3, 'What is sin(90°)?', '0', '1', '-1', 'Undefined', 1),
(22, 3, 'If cos(θ) = 0.5, what is θ in degrees?', '30°', '45°', '60°', '90°', 2),
(23, 3, 'Which trigonometric function represents opposite/hypotenuse?', 'sin', 'cos', 'tan', 'cot', 0),
(24, 3, 'What is tan(45°)?', '0', '1', '√2', 'Undefined', 1),
(25, 3, 'What is the hypotenuse of a right triangle with legs 9 cm and 12 cm?', '15 cm', '18 cm', '20 cm', '25 cm', 0),
(26, 3, 'What is sec(θ) equal to?', '1/sin(θ)', '1/cos(θ)', '1/tan(θ)', 'cos(θ)/sin(θ)', 1),
(27, 3, 'Which trigonometric ratio is used to find an angle in a right triangle?', 'Sine rule', 'Cosine rule', 'Pythagorean theorem', 'SOH-CAH-TOA', 3),
(28, 3, 'What is the period of the sine function?', '90°', '180°', '270°', '360°', 3),
(29, 3, 'If sin(30°) = 0.5, what is cos(60°)?', '0.5', '1', '0', '-0.5', 0),
(30, 3, 'Which of the following is an identity in trigonometry?', 'sin²θ + cos²θ = 1', 'sinθ + cosθ = 1', 'tan²θ + 1 = secθ', 'cosθ - sinθ = 0', 0),
(31, 4, 'test1', '1', '2', '3', '4', 1),
(32, 4, 'test2', '1', '2', '3', '4', 0),
(33, 4, 'test3', '1', '2', '3', '4', 2),
(34, 4, 'test 4', '1', '2', '3', '4', 0),
(35, 4, 'test5', '12', '2', '3', '4', 1),
(36, 4, 'test 6', '1', '2', '3', '4', 0),
(37, 4, 'test 7', '1', '2', '3', '3', 2),
(38, 4, 'test 8', '1', '2', '3', '3', 3),
(39, 4, 'test 9', '1', '2', '3', '4', 1),
(40, 4, 'test 10', '1', '2', '3', '4', 2),
(41, 4, 'test 11', '1', '2', '3', '4', 3),
(42, 4, 'test 12', '1', '2', '3', '4', 0),
(43, 4, 'test 13', '1', '2', '3', '4', 1),
(44, 4, 'test 14', '1', '2', '3', '4', 3),
(45, 4, 'test 15', '1', '2', '4', '4', 0),
(46, 4, 'test 16', '2', '1', '2', '3', 2),
(47, 4, 'test 17', '1', '2', '3', '32', 1),
(48, 4, 'test 18', '1', '2', '3', '4', 0),
(49, 4, 'test 19', '1', '2', '3', '4', 1),
(50, 4, 'test 20', '1', '2', '3', '6', 2),
(51, 5, 'test 1', '1', '2', '3', '4', 0),
(52, 5, 'test 2', '1', '2', '3', '4', 0),
(53, 5, 'test 3', '1', '2', '3', '4', 0),
(54, 5, 'test 4', '1', '2', '3', '4', 0),
(55, 5, 'test 5', '1', '2', '3', '4', 0),
(56, 5, 'test 6', '1', '2', '3', '4', 0),
(57, 5, 'test 7', '1', '2', '3', '4', 0),
(58, 5, 'test 8', '1', '2', '3', '4', 0),
(59, 5, 'test 9 ', '1', '2', '3', '4', 0),
(60, 5, 'test 10 ', '1', '2', '3', '4', 0),
(61, 5, 'test 11', '1', '2', '3', '4', 0),
(62, 5, 'test 12', '1', '2', '3', '4', 0),
(63, 5, 'test 13', '1', '2', '3', '4', 0),
(64, 5, 'test 14', '1', '2', '3', '4', 0),
(65, 5, 'test 15', '1', '2', '3', '4', 0),
(66, 5, 'test 16', '1', '2', '3', '4', 0),
(67, 5, 'test 17', '1', '2', '3', '4', 0),
(68, 5, 'test 18', '1', '2', '3', '4', 0),
(69, 5, 'test 19', '1', '2', '3', '4', 0),
(70, 5, 'Solve for y in 19y+38=95.', '78', '65', '45', '90', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiztable`
--

CREATE TABLE `quiztable` (
  `quizid` int(11) NOT NULL,
  `quizname` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `timelimit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiztable`
--

INSERT INTO `quiztable` (`quizid`, `quizname`, `description`, `timelimit`) VALUES
(1, 'Algebra Basics', 'This quiz tests basic algebraic concepts.', 20),
(2, 'Geometry Fundamentals', 'This quiz covers fundamental concepts of geometry.', 25),
(3, 'Trigonometry Essentials', 'This quiz focuses on basic trigonometry principles.', 30),
(4, 'Matrix', '123', 30),
(5, 'Matrix', 'matris test', 45);

-- --------------------------------------------------------

--
-- Table structure for table `results_table`
--

CREATE TABLE `results_table` (
  `attempt_number` int(11) NOT NULL,
  `quizid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_of_correct_ans` int(11) NOT NULL,
  `time_taken` time NOT NULL,
  `date_done` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results_table`
--

INSERT INTO `results_table` (`attempt_number`, `quizid`, `email`, `no_of_correct_ans`, `time_taken`, `date_done`) VALUES
(1, 1, 'honkit@gmail.com', 3, '00:00:13', '2025-02-11'),
(2, 2, 'honkit@gmail.com', 2, '00:00:10', '2025-02-13'),
(3, 2, 'admin@gmail.com', 0, '00:00:25', '2025-02-15'),
(4, 1, 'admin@gmail.com', 2, '00:00:14', '2025-02-15'),
(5, 1, 'admin@gmail.com', 4, '00:00:11', '2025-02-15'),
(6, 1, 'admin@gmail.com', 4, '00:00:09', '2025-02-15'),
(7, 4, 'admin@gmail.com', 5, '00:00:16', '2025-02-18'),
(8, 5, 'admin@gmail.com', 20, '00:00:00', '2025-02-18'),
(9, 5, 'admin@gmail.com', 1, '00:00:18', '2025-02-18'),
(10, 1, 'admin@gmail.com', 0, '00:00:10', '2025-02-18'),
(11, 1, 'admin@gmail.com', 0, '00:00:03', '2025-02-18'),
(12, 5, 'admin@gmail.com', 20, '00:00:19', '2025-02-18'),
(13, 1, 'honkit@gmail.com', 4, '00:01:17', '2025-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `profile_pic` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`email`, `first_name`, `last_name`, `username`, `password`, `phone_number`, `date_of_birth`, `profile_pic`, `role`) VALUES
('admin@gmail.com', 'Sylvester', 'Ng', 'Sylvester', '123', NULL, NULL, 'profile pic.jpg', 'admin'),
('epirt0@foxnews.com', 'bob', 'johnson', 'Bob', '12345678', '0109437156', '2014-07-17', 'black-profile.png', 'user'),
('honkit@gmail.com', 'hon', 'kit', 'honkit', '12345678', NULL, NULL, 'black-profile.png', 'user'),
('sylvester@gmail.com', 'sylvester', 'ng', 'sylvester123', 'Ben123455@', NULL, NULL, 'black-profile.png', 'admin'),
('tp076143@mail.apu.edu.my', 'sylvester', 'ng', 'sylvesterng', 'Ben123455@', NULL, NULL, 'black-profile.png', 'user'),
('yikyang@gmail.com', 'yik', 'yang', 'yikyang', '12345678', NULL, NULL, 'black-profile.png', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questionstable`
--
ALTER TABLE `questionstable`
  ADD PRIMARY KEY (`questionid`),
  ADD KEY `quiz-question_check` (`quizid`);

--
-- Indexes for table `quiztable`
--
ALTER TABLE `quiztable`
  ADD PRIMARY KEY (`quizid`);

--
-- Indexes for table `results_table`
--
ALTER TABLE `results_table`
  ADD PRIMARY KEY (`attempt_number`,`quizid`,`email`),
  ADD KEY `quiz-results_check` (`quizid`),
  ADD KEY `useraccount-results_check` (`email`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questionstable`
--
ALTER TABLE `questionstable`
  MODIFY `questionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `quiztable`
--
ALTER TABLE `quiztable`
  MODIFY `quizid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `results_table`
--
ALTER TABLE `results_table`
  MODIFY `attempt_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questionstable`
--
ALTER TABLE `questionstable`
  ADD CONSTRAINT `quiz-question_check` FOREIGN KEY (`quizid`) REFERENCES `quiztable` (`quizid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results_table`
--
ALTER TABLE `results_table`
  ADD CONSTRAINT `quiz-results_check` FOREIGN KEY (`quizid`) REFERENCES `quiztable` (`quizid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `useraccount-results_check` FOREIGN KEY (`email`) REFERENCES `useraccount` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
