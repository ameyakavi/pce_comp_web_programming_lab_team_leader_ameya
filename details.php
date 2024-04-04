<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vegetable Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('crop image.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }


        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card img {
            max-width: 100%;
            border-radius: 10px;
        }

        .card h2 {
            font-size: 28px;
            color: #333;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 22px;
            color: #666;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 18px;
            color: #555;
            margin-bottom: 15px;
        }

        .attribute-box {
            border: 2px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .attribute {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
        }

        .attribute strong {
            font-size: 20px;
            color: #333;
            margin-right: 10px;
        }

        .card a {
            display: inline-block;
            background-color: #6939ff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .card a:hover {
            background-color: #4a22a8;
        }
    </style>
</head>

<body>

    <?php
    //  Connect to your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kisan";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //  Retrieve data for the selected vegetable
    if (isset($_GET['name'])) {
        $name = urldecode($_GET['name']);

        $sql = "SELECT * FROM cd WHERE name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display vegetable details
            echo '<div class="container">';
            echo '<div class="card">';
            echo '<img src="./images/' . $row['img'] . '" alt="image">';
            echo '<div class="attribute-box">';
            echo '<div class="attribute"><strong>Type:</strong> ' . $row['type'] . '</div>';
            echo '</div>';
            echo '<div class="attribute-box">';
            echo '<div class="attribute"><strong>Name:</strong> ' . $row['name'] . '</div>';
            echo '</div>';
            echo '<div class="attribute-box">';
            echo '<div class="attribute"><strong>Intro:</strong> ' . $row['intro'] . '</div>';
            echo '</div>';
            echo '<div class="attribute-box">';
            echo '<div class="attribute"><strong>Des:</strong> ' . $row['des'] . '</div>';
            echo '</div>';
            // Display other attributes like rainfall, climate, soil, fert
            echo '<div class="attribute-box">';
            echo '<div class="attribute"><strong>Rainfall:</strong> ' . $row['rainfall'] . ' mm</div>';
            echo '</div>';
            echo '<div class="attribute-box">';
            echo '<div class="attribute"><strong>Climate:</strong> ' . $row['climate'] . '</div>';
            echo '</div>';
            echo '<div class="attribute-box">';
            echo '<div class="attribute"><strong>Soil:</strong> ' . $row['soil'] . '</div>';
            echo '</div>';
            echo '<div class="attribute-box">';
            echo '<div class="attribute"><strong>Fertilizer:</strong> ' . $row['fert'] . '</div>';
            echo '</div>';
            echo '<a href="../home_page/menu.html">Back to Menu</a>';
            echo '</div>';
            echo '</div>';
        } else {
            echo "No vegetable found with the given name.";
        }
        $stmt->close();
    } else {
        echo "Invalid vegetable name.";
    }

    $conn->close();
    ?>

</body>

</html>