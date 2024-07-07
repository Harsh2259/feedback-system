<?php
include 'config.php';
$server = "localhost";
$username = "root";
$password = "";
$dbname = "feedback"; 


$con = new mysqli($server, $username, $password, $dbname);


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$survey_id = isset($_POST['survey_id']) ? $_POST['survey_id'] : null;


$sql_questions = "SELECT question1, question2, question3 FROM `table_new` WHERE survey_id = ?";
$stmt_questions = $con->prepare($sql_questions);
$stmt_questions->bind_param("i", $survey_id);
$stmt_questions->execute();
$stmt_questions->bind_result($question1, $question2, $question3);
$stmt_questions->fetch();
$stmt_questions->close();

$sql_answers = "SELECT question1_answer, question2_answer, question3_answer FROM `process_answers_table` WHERE survey_id = ?";
$stmt_answers = $con->prepare($sql_answers);
$stmt_answers->bind_param("i", $survey_id);
$stmt_answers->execute();
$stmt_answers->bind_result($answer1, $answer2, $answer3);
$stmt_answers->fetch();
$stmt_answers->close();


$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Answers and Response</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .survey-question {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .question-text {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .answer-text {
            margin-bottom: 15px;
        }
        .user-response {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .user-response label {
            display: block;
            margin-bottom: 10px;
        }
        .user-response input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .user-response button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .user-response button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <h1>Survey Answers and Response</h1>
</header>

<div class="survey-question">
    <p class="question-text">Question 1:</p>
    <p class="answer-text"><?php echo htmlspecialchars($question1); ?></p>
    <p class="question-text">Answer 1:</p>
    <p class="answer-text"><?php echo htmlspecialchars($answer1); ?></p>
</div>

<div class="survey-question">
    <p class="question-text">Question 2:</p>
    <p class="answer-text"><?php echo htmlspecialchars($question2); ?></p>
    <p class="question-text">Answer 2:</p>
    <p class="answer-text"><?php echo htmlspecialchars($answer2); ?></p>
</div>

<div class="survey-question">
    <p class="question-text">Question 3:</p>
    <p class="answer-text"><?php echo htmlspecialchars($question3); ?></p>
    <p class="question-text">Answer 3:</p>
    <p class="answer-text"><?php echo htmlspecialchars($answer3); ?></p>
</div>

<div class="user-response">
    <h2>Respond to Questions</h2>
    <form action="process_user_response.php" method="post">
        <input type="hidden" name="survey_id" value="<?php echo htmlspecialchars($survey_id); ?>">
        
        <label for="response1">Response to Question 1:</label>
        <input type="text" id="response1" name="response1" required><br><br>
        
        <label for="response2">Response to Question 2:</label>
        <input type="text" id="response2" name="response2" required><br><br>
        
        <label for="response3">Response to Question 3:</label>
        <input type="text" id="response3" name="response3" required><br><br>
        
        <button type="submit">Submit Responses</button>
    </form>
</div>

</body>
</html>
