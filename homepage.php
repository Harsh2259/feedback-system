<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
    <h1>Welcome to the Survey Application</h1>
</header>
<div class="content">
    <h2>Navigation</h2>
    <a href="index.php">Create Survey</a>
    <a href="display.php">View Survey Results</a>
    <a href="answer_survey.php">Answer Survey</a>
    <a href="display_answers.php">Display Survey Answers</a>

</div>
</body>
</html>
