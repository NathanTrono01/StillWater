<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Commission</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        form {
            align-content: center;
            grid-template-columns: 1fr;
            width: 600px;
            padding: 30px;
            background-color: #3f3c36;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin: 40px auto;
            text-align: center;
            box-sizing: border-box;
        }

        hr {
            margin: 15px 0;
        }

        h2 {
            font-size: 2em;
            color: #FFF;
            font-weight: bold;
            margin-bottom: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }

        a[href*="existing_p.php"],
        a[href*="new_p.php"] {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px 0;
            background-color: #232223;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            font-size: 18px;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
            max-width: 300px;
        }

        a[href*="existing_p.php"]:hover,
        a[href*="new_p.php"]:hover {
            background-color: #d2c9ac;
            color: #000;
            box-shadow: 0 4px 8px #d2c9ac81;
            cursor: pointer;
            transform: scale(1.05);
        }

        .back a[href*="purchases.php"] {
            display: inline-block;
            padding: 10px 20px;
            background-color: #232223;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
            font-size: 1.1em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .back a[href*="purchases.php"]:hover {
            background-color: #d2c9ac;
            color: #000;
            box-shadow: 0 4px 8px #d2c9ac81;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        @media (max-width: 600px) {
            form {
                width: 95%;
            }

            label,
            select {
                font-size: 1em;
            }

            h2 {
                font-size: 1.5em;
            }

            a[href*="existing_p.php"],
            a[href*="new_p.php"] {
                padding: 10px 20px;
                font-size: 16px;
            }

            .back a[href*="purchases.php"] {
                padding: 8px 15px;
                font-size: 1em;
            }
        }
    </style>
</head>
<?php
include 'database.php';
include 'nav.php';
?>

<body>
    <form action="insert_c.php" method="post">
        <div class="back">
            <a href="purchases.php" align="left"><b>Back</b></a><br>

            <h2 align="center">Choose a Client Type</h2>
            <br><br>
            <a href="new_p.php">New</a><br><br>
            <a href="existing_p.php">Existing</a>
        </div>
    </form>
</body>

</html>
