<?php
include 'config.php';
$server = "localhost";
$username = "root";
$password = "";
$dbname = "feedback"; 

$con = mysqli_connect($server, $username, $password, $dbname);

if(!$con) {
    die("Connection to database failed: " . mysqli_connect_error());
}

$survey_id = '';
$survey_questions = [];

// Fetch survey questions if survey_id is provided via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $survey_id = mysqli_real_escape_string($con, $_POST['survey_id']);
    $result = mysqli_query($con, "SELECT * FROM `table_new` WHERE `survey_id` = '$survey_id'");
    if (mysqli_num_rows($result) > 0) {
        $survey_questions = mysqli_fetch_assoc($result);
    } else {
        echo "No survey found with ID: $survey_id";
    }
}

// Insert answers into `answers` table on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_answers'])) {
    $survey_id = mysqli_real_escape_string($con, $_POST['survey_id']);
    $answer1 = mysqli_real_escape_string($con, $_POST['answer_1']);
    $answer2 = mysqli_real_escape_string($con, $_POST['answer_2']);
    $answer3 = mysqli_real_escape_string($con, $_POST['answer_3']);

    if (!empty($survey_id) && !empty($answer1) && !empty($answer2) && !empty($answer3)) {
        $sql = "INSERT INTO `answers` (`survey_id`, `answer1`, `answer2`, `answer3`) 
                VALUES ('$survey_id', '$answer1', '$answer2', '$answer3')";

        if (mysqli_query($con, $sql)) {
            echo "Answers submitted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo "All fields are required.";
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answer Survey</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
        }

        .content {
            background-color: white;
            border: 1px solid #ccc;
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .content form {
            margin-bottom: 20px;
        }

        .content form label {
            display: block;
            margin: 10px 0;
            text-align: left;
        }

        .content form input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .content form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }

        .content form button:hover {
            background-color: #45a049;
        }

        a {
            display: inline-block;
            margin: 20px 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <h1>Answer Survey</h1>
</header>
<div class="content">
    <h2>Survey Questions</h2>
    <form id="answerForm" action="answer_survey.php" method="post">
        <label for="survey_id">Survey ID:</label>
        <input type="text" id="survey_id" name="survey_id" required value="<?php echo htmlspecialchars($survey_id); ?>"><br><br>

        <?php if (!empty($survey_questions)): ?>
            <label for="answer1"><?php echo htmlspecialchars($survey_questions['question1']); ?></label>
            <input type="text" id="answer1" name="answer_1" required><br><br>
            <label for="answer2"><?php echo htmlspecialchars($survey_questions['question2']); ?></label>
            <input type="text" id="answer2" name="answer_2" required><br><br>
            <label for="answer3"><?php echo htmlspecialchars($survey_questions['question3']); ?></label>
            <input type="text" id="answer3" name="answer_3" required><br><br>
            <button type="submit" name="submit_answers">Submit Answers</button>
        <?php else: ?>
            <p>No questions found for the provided Survey ID.</p>
        <?php endif; ?>
    </form>
    <a href="index.php">Create Survey</a>
    <a href="display.php">View Survey Results</a>
    <a href="homepage.php">Home Page</a>
    <a href="display_answers.php">Display Survey Answers</a>

</div>
</body>
</html>
