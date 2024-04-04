<?php
$pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
$isFormSubmitted = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "kisan";

$done = "";
$emptyErr = "";
$emailErr = "";
$error = "";
try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $hashedemail = password_hash($email, PASSWORD_DEFAULT);
        $Feedback = $_POST["Feedback"];

        if (empty($username) || empty($email) || empty($Feedback)) {
            $emptyErr = "Please Fill the Spaces Which are empty!!";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Please Fill a valid email address!!!";
        }
        if (empty($emptyErr) && empty($emailErr)) {
            $isFormSubmitted = true;
            $sql = $conn->prepare("INSERT INTO feedback (username, email, Feed) VALUES (?, ?, ?)");

            $sql->bind_param("sss", $username, $hashedemail, $Feedback);

            if ($sql->execute()) {
                $done = "Form has been submitted successfully!!!";
            } else {
                throw new Exception("Error executing SQL query: " . $sql->error);
            }
        }
    }
} catch (Exception $e) {
    $error = 'Server under maintainence: ';
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="form1.css">
    <!-- <script defer src="form1.js"></script> -->
</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-image: url(natureimage1.jpg);
        background-size: cover;
        background-repeat: no-repeat;

    }

    #form {
        width: 300px;
        margin: 20vh auto 0 auto;
        padding: 20px;
        background-color: whitesmoke;
        border-radius: 4px;
        font-size: 12px;
    }

    #form h1 {
        text-align: center;
    }

    #form button {
        padding: 10px;
        margin-top: 10px;
        width: 100%;
        color: white;
        background-color: rgb(41, 57, 194);
        border: none;
        border-radius: 4px;
    }

    .input-control {
        display: flex;
        flex-direction: column;
    }

    .input-control input {
        border: 2px solid #f0f0f0;
        border-radius: 4px;
        display: block;
        font-size: 12px;
        padding: 10px;
        width: 100%;
    }

    .input-control input:focus {
        outline: 0;
    }

    .input-control.success input {
        border-color: #09c372;
    }

    .input-control.error input {
        border-color: #ff3860;
    }

    .input-control .error {
        color: #ff3860;
        font-size: 9px;
        height: 13px;
    }

    .err {
        color: red;
    }
    .go-to-home-button {
      position: fixed;
      top: 20px;
      left: 20px;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      text-decoration: none;
      border: none;
      border-radius: 5px;
    }

    .go-to-home-button:hover {
      background-color: #555;
    }
</style>

<body>
<a href="index.html" class="go-to-home-button">Go to Home</a>
    <div class="container">
        <form id="form" method="post" action=" ">
            <h1>Feedback</h1>
            <?php
            echo "<p class= 'err'> $emptyErr </p>";
            ?>
            <?php
            echo "<p class= 'err'> $emailErr </p>";
            ?>
            <?php
            echo "<p> $done </p>";
            ?>
            <?php
            echo "<p> $error </p>";
            ?>
            <div class="input-control">
                <label for="username">Username</label>
                <input id="username" name="username" type="text">
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="text">
                <div class="error"></div>
            </div>
            <textarea id="message" rows="10" cols="30" name="Feedback"
                placeholder=" How was your Experience? "></textarea>
            <br>
            <button type="submit" name="submit">submit</button>
        </form>
    </div>

</body>

</html>