<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Commission</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Apply box-sizing globally to ensure padding and borders are included in width/height */
        * {
            box-sizing: border-box;
        }

        /* General Form Layout */
        form {
            display: block;
            width: 600px;
            /* Fixed width for larger screens */
            padding: 20px;
            background-color: #3f3c36;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin: 40px auto;
        }

        /* Form Heading */
        h2 {
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            color: #FFF;
            margin: 0;
        }

        /* Form Label Styling */
        label {
            font-size: 1.1em;
            color: #FFF;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        /* Input Fields */
        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="datetime-local"],
        select {
            width: 100%;
            /* Full width for all inputs */
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #232223;
            border-radius: 8px;
            font-size: 16px;
            background-color: #FFEAC5;
            color: black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: border-color 0.3s ease;
        }

        /* Focus Effect on Input Fields */
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="datetime-local"]:focus,
        select:focus {
            border-color: rgb(211, 0, 0);
            outline: none;
        }

        /* Submit Button Styling */
        input[type="submit"] {
            background-color: #982B1C;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
            padding: 12px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 100%;
            /* Full width for the submit button */
        }

        input[type="submit"]:hover {
            background-color: #800000;
            color: #FFF;
        }

        /* Back Button Styling */
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

        /* Responsive Design */
        @media (max-width: 600px) {
            form {
                width: 95%;
                /* Adjust form width for small screens */
            }

            label,
            input,
            select {
                font-size: 1em;
                /* Adjust font size for small screens */
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
    <?php
    include("database.php");
    include("datetime.php");
    include("nav.php");

    if (isset($_POST['submit'])) {
        $lastName = $_POST['lastName'];
        $givenName = $_POST['givenName'];
        $clientAddress = $_POST['ClientAddress'];

        //Insert Client
        $insertClientSql = "INSERT INTO allclients (lastName, givenName, ClientAddress) VALUES ('$lastName', '$givenName', '$clientAddress')";

        if (mysqli_query($conn, $insertClientSql)) {
            $clientNumber = mysqli_insert_id($conn);

            $asking_price = $_POST['asking_price'];
            $item_type = $_POST['item_type'];
            $description = $_POST['description'];
            $critiqued_comments = $_POST['critiqued_comments'];
            $condition_at_purchase = $_POST['condition_at_purchase'];

            //Insert item
            $insertItemSql = "INSERT INTO items (asking_price, item_type, description, critiqued_comments, `condition`, ClientNumber) 
                              VALUES ('$asking_price', '$item_type', '$description', '$critiqued_comments', '$condition_at_purchase', '$clientNumber')";

            if (mysqli_query($conn, $insertItemSql)) {
                $itemNumber = mysqli_insert_id($conn);

                $currentTimeStamp = getCurrentDateTime();

                // Insert purchase
                $insertPurchaseSql = "INSERT INTO purchases (condition_at_purchase, item_num, ClientNumber, p_date) 
                                      VALUES ('$condition_at_purchase', '$itemNumber', '$clientNumber', '$currentTimeStamp')";

                if (mysqli_query($conn, $insertPurchaseSql)) {
                    echo "<script>alert('New record has been added successfully.'); window.location='purchases.php';</script>";
                } else {
                    echo "<script>alert('Failed to add Purchase: " . mysqli_error($conn) . "'); window.location='purchases.php';</script>";
                }
            } else {
                echo "<script>alert('Failed to add Item: " . mysqli_error($conn) . "'); window.location='purchases.php';</script>";
            }
        } else {
            echo "<script>alert('Failed to add Client: " . mysqli_error($conn) . "'); window.location='purchases.php';</script>";
        }
    }
    ?>

    <form action="" method="POST">
        <div class="back">
            <a href="insert_p.php">Back</a>
        </div>

        <h2>Client Info:</h2>
        <div id="new_client_fields">
            <label for="lastName" required>Last Name: <span style="color: #B8001F">*</span></label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="givenName">Given Name: <span style="color: #B8001F">*</span></label>
            <input type="text" id="givenName" name="givenName" required>

            <label for="ClientAddress">Address: <span style="color: #B8001F">*</span></label>
            <input type="text" id="ClientAddress" name="ClientAddress" required>
        </div>

        <hr>
        <br>
        <h2>Item Info:</h2>

        <label for="description">Description: <span style="color: #B8001F">*</span></label>
        <input type="text" name="description" required>

        <label for="item_type">Item Type: <span style="color: #B8001F">*</span></label>
        <select name="item_type" id="item_type" required>
            <option value="">-- SELECT ITEM TYPE --</option>
            <option value="Furniture">Furniture</option>
            <option value="Instruments">Instruments</option>
            <option value="Tools">Tools</option>
            <option value="Jewelry">Jewelry</option>
            <option value="Home Decor">Home Decor</option>
            <option value="Collectibles">Collectibles</option>
            <option value="Glassware and Ceramics">Glassware and Ceramics</option>
            <option value="Textiles">Textiles</option>
            <option value="Books">Books</option>
            <option value="Artwork">Artwork</option>
            <option value="Lighting">Lighting</option>
            <option value="Books">Books</option>
            <option value="Toys">Toys</option>
            <option value="Others">Others...</option>
        </select>

        <label for="condition_at_purchase">Condition: <span style="color: #B8001F">*</span></label>
        <select name="condition_at_purchase" id="condition_at_purchase" required>
            <option value="">-- SELECT ITEM CONDITION --</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Fair">Fair</option>
            <option value="Bad">Bad</option>
        </select>

        <label for="asking_price">Asking Price: <span style="color: #B8001F">*</span></label>
        <input type="number" name="asking_price" required>

        <label for="critiqued_comments">Critiqued Comments: <span style="color: #B8001F">*</span></label>
        <input type="text" name="critiqued_comments" required>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>