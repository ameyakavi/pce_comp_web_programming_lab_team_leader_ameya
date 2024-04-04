<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kisanmadad</title>
    <link rel="stylesheet" href="neo.css" />
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

    nav {
        display: flex;
        justify-content: space-between; /* Changed to space-between */
        align-items: center;
        height: 90px;
        width:100%;
        background-color: rgb(56, 225, 53);
        position: fixed; /* Added position: fixed */
        top: 0; /* Added top: 0 */
        left: 0; /* Added left: 0 */
        right: 0; /* Added right: 0 */
        z-index: 1000; /* Added z-index to make sure it's above other content */
    }

    nav ul {
        display: flex;
        justify-content: center;
        margin-right: 20px; /* Adjusted margin-right */
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
            <li><a href="../home_page/menu.html">Home</a></li>
            <li><a href="../main/main.php">Login</a></li>
            <li><a href="../home_page/contact.html">Contact us</a></li>
            <li><a href="../home_page/error.php">Feedback</a></li>
            <li><a href="../home_page/repo.php">Report</a></li>
        </ul>
    </div>
</nav>
<body>


<?php
// Step 1: Connect to your database
try
{

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cd WHERE type = 'FT'";
$result = $conn->query($sql);

// Step 3 & 4: Loop through fetched data and generate HTML cards
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
    {
        //echo '<div class="card">';
        //echo '<img src="data:image/jpg;charset=utf8;base64,'. base64_encode($row['img']).'">';
        $postimg=$row['img'];
        echo '<div class="card">';
        // echo '<img src="data:image/jpg;charset=utf8;base64,'. base64_encode($row['img']).'">';
        echo "<img src='./images/$postimg' alt='image'>";
        echo '<div>';
        echo '<h2>' . $row['name'] . '</h2>';
        echo '<h3>' . $row['intro'] . '</h3>'; 
        echo '<p>' . $row['des'] . '</p>';
        echo '<a href="details.php?name='.urlencode($row['name']).'">Learn More</a>';
        echo '</div>';
        echo '</div>';
    }
}



else
{
   throw new Exception("Zero Data entries about Fertilizers found...");
}
}


catch(Exception $e)
{
    echo "Oops! " . $e->getMessage();
}

$conn->close();
?>
    
</body>
</html>







