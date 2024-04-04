<?php
//session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "kisan";
$table = "repo";

$msg = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $u = $_POST['un'];
  $r = $_POST['rp'];

  $h = password_hash($u, PASSWORD_BCRYPT);

  if (!empty($u) && !empty($r)) {

    $sql = "INSERT INTO repo(username,report) VALUES ('$h','$r')";

    if ($conn->query($sql) === TRUE) {
      $msg = "Your report has been recorded. Thank you for your response :)";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
} else {
  $msg = "Please enter username and report message";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Form</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      height: 100%;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-image: url('repoimage.jpg');
      /* Change to your background image file */
      background-size: cover;
      background-repeat: no-repeat;
    }

    .container {
      max-width: 600px;
      width: 30%;
      margin: 50px auto;
      margin-top: 200px;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #4CAF50;
      font-size: 40px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    nav {
      display: flex;
      justify-content: space-between;
      /* Changed to space-between */
      align-items: center;
      height: 90px;
      width: 100%;
      background-color: rgb(56, 225, 53);
      position: fixed;
      /* Added position: fixed */
      top: 0;
      /* Added top: 0 */
      left: 0;
      /* Added left: 0 */
      right: 0;
      /* Added right: 0 */
      z-index: 1000;
      /* Added z-index to make sure it's above other content */
    }

    nav ul {
      display: flex;
      justify-content: center;
      margin-right: 20px;
      /* Adjusted margin-right */
    }

    nav ul li {
      list-style: none;
      margin: 0 23px;
    }

    nav ul li a {
      text-decoration: none;
      color: rgb(7, 90, 14);
    }

    main hr {
      border: 0;
      background: #97f19a;
      height: 1.2px;
      margin: 60px 84px;

    }
  </style>
</head>
<nav>
  <div class="left" style="margin-left: 200px;">Kisanmadad</div>
  <div class="right">
    <ul>
      <li><a href="index.html">Home</a></li>
      <li><a href="../main/main.php">Login</a></li>
      <li><a href="contact.html">Contact us</a></li>
      <li><a href="error.php">Feedback</a></li>
      <li><a href="repo.php">Report</a></li>
    </ul>
  </div>
</nav>

<body>
  <div class="container">
    <h1>Report an Issue</h1>
    <span>
      <?php echo $msg; ?>
    </span>
    <form action="#" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="un" required>
      </div>
      <div class="form-group">
        <label for="report">Report:</label>
        <textarea id="report" name="rp" rows="5" required></textarea>
      </div>
      <input type="submit" value="Submit">
    </form>
  </div>
</body>

</html>