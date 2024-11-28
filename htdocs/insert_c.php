<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        form {
            display: block;
            width: 600px;
            padding: 30px;
            background-color: #3f3c36;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin: 40px auto;
            box-sizing: border-box;
        }

        h2 {
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            color: #FB667A;
            margin: 0 0 20px;
        }

        label {
            font-size: 1.1em;
            color: #FFF;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #232223;
            border-radius: 8px;
            font-size: 16px;
            background-color: #FFEAC5;
            color: black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            border-color: rgb(211, 0, 0);
            outline: none;
        }

        input[type="submit"] {
            background-color: #982B1C;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
            padding: 12px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #800000;
            color: #FFF;
        }

        .back a {
            text-align: left;
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

        .back a:hover {
            background-color: #d2c9ac;
            box-shadow: 0 4px 8px #d2c9ac81;
            transition: background-color 0.3s ease;
            color: #000;
            cursor: pointer;
        }

        @media (max-width: 600px) {
            form {
                width: 95%;
            }

            label,
            input,
            select {
                font-size: 1em;
            }

            input[type="submit"] {
                padding: 15px;
                font-size: 1.2em;
            }

            h2 {
                font-size: 1.5em;
            }
        }
    </style>
</head>

<body>
    <?php include("nav.php"); ?>
    <?php include("database.php"); ?>

    <form action="insert_c.php" method="post">
        <div class="back">
            <a href="c_list.php"><b>Back</b></a><br><br>
        </div>

        <label for="lastName">Last Name: <span style="color: #B8001F">*</span></label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="givenName">Given Name: <span style="color: #B8001F">*</span></label>
        <input type="text" id="givenName" name="givenName" required>

        <label for="ClientAddress">Address: <span style="color: #B8001F">*</span></label>
        <input type="text" id="ClientAddress" name="ClientAddress" required>

        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $givenName = trim($_POST['givenName']);
        $lastName = trim($_POST['lastName']);
        $ClientAddress = trim($_POST['ClientAddress']);

        $sql = "SELECT * FROM allclients WHERE givenName = '$givenName' AND lastName = '$lastName'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                $clientData = mysqli_fetch_assoc($query);
                $clientNumber = $clientData['ClientNumber'];
                echo "<p>Client already exists with ClientNumber: <b>$clientNumber</b></p>";
            } else {
                $sql = "INSERT INTO allclients (givenName, lastName, ClientAddress) 
                        VALUES ('$givenName', '$lastName', '$ClientAddress')";
                if (mysqli_query($conn, $sql)) {
                    $clientNumber = mysqli_insert_id($conn);
                    echo "<script>alert('Client added successfully'); window.location='c_list.php';</script>";
                } else {
                    echo "<p>Error: " . mysqli_error($conn) . "</p>";
                }
            }
        } else {
            echo "<p>Connection Error: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>
</body>

</html>
