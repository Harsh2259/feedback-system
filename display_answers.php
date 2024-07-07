<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Survey Answers</title>
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
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .btn-container {
            margin-top: 20px;
        }

        .btn-container a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border-radius: 5px;
            transition: background-color 0.3s;
            border: 1px solid #388E3C; /* Added border for button */
        }

        .btn-container a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <h1>Survey Answers</h1>
</header>
<div class="content">
    <h2>Answers Overview</h2>
    <table>
        <tr>
            <th>Survey ID</th>
            <th>Answer 1</th>
            <th>Answer 2</th>
            <th>Answer 3</th>
            <th>Submitted At</th>
        </tr>
        <?php
        include 'config.php';
        // Assuming you have established a database connection earlier in your code
        $server = "localhost";
        $username = "root";
        $password = "";
        $dbname = "feedback";

        $con = mysqli_connect($server, $username, $password, $dbname);
        if (!$con) {
            die("Connection to database failed: " . mysqli_connect_error());
        }

        // Fetch answers from `answers` table
        $sql = "SELECT * FROM `answers`";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['survey_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['answer1']) . "</td>";
                echo "<td>" . htmlspecialchars($row['answer2']) . "</td>";
                echo "<td>" . htmlspecialchars($row['answer3']) . "</td>";
                echo "<td>" . (isset($row['created_at']) ? htmlspecialchars($row['created_at']) : 'N/A') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No answers found.</td></tr>";
        }

        mysqli_close($con);
        ?>
    </table>

    <div class="btn-container">
        <a href="index.php">Create Survey</a>
        <a href="answer_survey.php">Answer Survey</a>
        <a href="homepage.php">Home Page</a>
    </div>
</div>

<!-- Debugging Output -->
<?php
// Debugging: Uncomment the following lines to see detailed output
/*
echo "<pre>";
var_dump($result);
echo "</pre>";
*/
?>
</body>
</html>
