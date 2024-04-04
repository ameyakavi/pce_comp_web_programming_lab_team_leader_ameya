<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Database and Table</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('GM-Wheat.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Adding opacity to the background */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group textarea {
            width: calc(100% - 16px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4CAF50;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group small {
            color: #777;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        .admin-login-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #007bff; /* Blue */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .admin-login-btn:hover {
            background-color: #0056b3; /* Darker blue */
        }
    </style>
</head>
<body>
<a href="admin.php" class="admin-login-btn">Go to Admin page</a>
    <div class="container">
        <h2>Create Database and Table</h2>
        <form action="process_create.php" method="post">
            <div class="form-group">
                <label for="dbname">Database Name:</label>
                <input type="text" id="dbname" name="dbname" required>
            </div>
            <div class="form-group">
                <label for="tbname">Table Name:</label>
                <input type="text" id="tbname" name="tbname" required>
            </div>
            <div class="form-group">
                <label for="attributes">Attributes (Columns):</label>
                <textarea id="attributes" name="attributes" rows="4" required></textarea>
                <small>Format: attribute1 datatype, attribute2 datatype, ...</small>
            </div>
            <div class="form-group">
                <input type="submit" value="Create Database and Table">
            </div>
        </form>
    </div>
</body>
</html>
