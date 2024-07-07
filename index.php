<?php
include 'config.php';
$server = "localhost";
$username = "root";
$password = "";
$dbname = "feedback"; 

$con = mysqli_connect($server, $username, $password, $dbname);

if(!$con) {
    die("Connection to this database failed due to " . mysqli_connect_error());
}
echo "Successfully connected to the database";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $survey_id = mysqli_real_escape_string($con, $_POST['survey_id']);
    $question1 = mysqli_real_escape_string($con, $_POST['question_1']);
    $question2 = mysqli_real_escape_string($con, $_POST['question_2']);
    $question3 = mysqli_real_escape_string($con, $_POST['question_3']);

    if (!empty($survey_id) && !empty($question1) && !empty($question2) && !empty($question3)) {
        $sql = "INSERT INTO `table_new` (`survey_id`, `question1`, `question2`, `question3`) VALUES ('$survey_id', '$question1', '$question2', '$question3')";

        if (mysqli_query($con, $sql)) {
            echo "New record created successfully";
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
    <title>Survey Form</title>
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

        form {
            background-color: white;
            border: 1px solid #ccc;
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            text-align: left;
        }

        form input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }

        form button:hover {
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
    <h1>Create Survey</h1>
</header>
<form id="feedbackForm" action="index.php" method="post">
    <label for="survey_id">Survey ID:</label>
    <input type="text" id="survey_id" name="survey_id" required><br><br>
    <label for="question1">Question 1:</label>
    <input type="text" id="question_1" name="question_1" required><br><br>
    <label for="question2">Question 2:</label>
    <input type="text" id="question_2" name="question_2" required><br><br>
    <label for="question3">Question 3:</label>
    <input type="text" id="question_3" name="question_3" required><br><br>
    <button type="submit">Submit</button>
</form>
<br>
<a href="display.php">View Survey Results</a>
<a href="answer_survey.php">Answer Survey</a>
<a href="homepage.php">Home Page</a>
<a href="display_answers.php">Display Survey Answers</a>

</body>
</html>
