<?php
session_start();

include("connection.php");

$userprofile = $_SESSION['username'];

if($userprofile == true)
{
    // Continue displaying the page
}
else
{
    header('Location: ../main/main.php'); 
    exit(); // Ensure to exit after redirection
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file is uploaded
    if(!empty($_FILES["image"]["name"])) {
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)) {
            // File is valid, proceed with further processing
            // $image = $_FILES['image']['tmp_name'];
            $image = $_FILES['image']['name'];
            $image_temp = $_FILES['image']['tmp_name'];  

            $location ='./images/';
            move_uploaded_file($image_temp, $location.$image);
            
            // Prepare and bind SQL statement
            $stmt = $conn->prepare("INSERT INTO $table (img, type, name, intro, des, rainfall, climate, soil, fert) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $image, $type, $name, $intro, $des, $rainfall, $climate, $soil, $fert);

            // Set parameters and execute
            $type = $_POST["type"];
            $name = $_POST["name"];
            $intro = $_POST["intro"];
            $des = $_POST["des"];
            $rainfall = $_POST["rainfall"];
            $climate = $_POST["climate"];
            $soil = $_POST["soil"];
            $fert = $_POST["fert"];
            
            // Execute the statement
            if ($stmt->execute()) {
                $msg = "New record inserted successfully.";
            } else {
                $msg = "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            $msg = "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        $msg = "Error: No file uploaded.";
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contribution form</title>
    <link rel="stylesheet" href="style.css">
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
    body {
            padding-top: 90px;
            /* Adjust this value according to your navbar's height */
            background-image: url('ff.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* The rest of your CSS styles */
        }

      </style>

    

</head>
<nav>
    <div class="left" style="margin-left: 200px;">Kisanmadad</div>
    <div class="right">
    <ul>
            <li><a href="../home_page/index.html">Home</a></li>
            <li><a href="../main/main.php">Login</a></li>
            <li><a href="../home_page/contact.html">Contact us</a></li>
            <li><a href="../home_page/error.php">Feedback</a></li>
            <li><a href="../home_page/repo.php">Report</a></li>
        </ul>
    </div>
</nav>
<body>
    <div class="con">
    <!--p style="font-family: 'Times New Roman', Times, serif; font-size: 20px; "><u>Card Creation Form:</u></p-->
    <form name="fm" method="post" action="jin.php" enctype="multipart/form-data" >
        <span><?php echo $msg; ?> </span>
    <label>Select Image File:</label>
    <input type="file" name="image"><br>

       <label for="type">Type:</label>
       <select name="type">
        <option selected="" value="Default">(Please select a type)</option>
        <option value="VG">Vegetable</option>
        <option value="FR">Fruit</option>
        <option value="FL">Flower</option>
        <option value="SD">Seed</option>
        <option value="FT">Fertilizer</option>
        </select><br><br>

        <label for="name">Name:</label>
        <input class="name" id="n1" type='text' name="name"><br><br>
        <label for="intro">Type an Introductory subtitle:</label>
        <input class="intro" type="text" name="intro"><br><br>
        <label for="des">Description:</label><br>
        <textarea style="height:100px;width:300px;" type="text" name="des"></textarea><br><br>
        <label for="rainfall" >Rainfall:</label><br>
        <input name="rainfall" type="number" placeholder="in mm."><br><br>
        <label for="climate">Climate:</label><br>
        <select name="climate">
            <option selected="" value="Default">(Please select a climate)</option>
            <option value="sm">Summer</option>
            <option value="wt">Winter</option>
            <option value="mn">Monsoon</option>
            <option value="tp">Temperate</option>
            <option value="sp">Spring</option>
            <option value="au">Autumn</option>
            <option value="ar">Arid</option>
            <option value="sd">Semi-Arid</option>
            <option value="tr">Tropical</option>
            <option value="st">Sub-Tropical</option>
            <option value="po">Polar</option>
            <option value="sa">Sub-Arctic</option>
            <option value="hg">Highland</option>
            <option value="sv">Savannah</option>
            <option value="hd">Hot Desert</option>
            <option value="hm">Humid</option>
            <option value="nn">Any</option>
            </select><br><br>

        <label for="soil">Soil:</label>
        <select name="soil">
            <option selected="" value="Default">(Please select a soil type)</option><br><br>
            <option value="rs">Red Soil</option>
            <option value="bs">Black Soil</option>
            <option value="cp">Coco Peat</option>
            <option value="rp">Regular Peat</option>
            <option value="as">Alluvial Soil</option>
            <option value="ms">Mountain Soil</option>
            <option value="ls">laterite Soil</option>
            <option value="sd">Sand</option>
            <option value="ds">Sandy Soil</option>
            <option value="lm">Loam</option>
            <option value="ss">Saline Soil</option>
            <option value="st">Silt Soil</option>
            <option value="cs">Clay Soil</option>
            <option value="aa">Any</option>
        </select><br><br>
            <label for="fert">Preferred Fertilizers:</label>
            <input style="width: 400px;"fert" type="text" name="fert" placeholder="separate multiple with numbers(1. 2.) or commas(,)"><br><br>
        <input style="background-color:blue; color: white; border-radius: 2px;  " class="sub" type="submit" value="submit" name="submit">
    </form>
    </div>

  
</body>
</html>
