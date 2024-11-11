<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Purchase Record</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Apply box-sizing globally to ensure padding and borders are included in width/height */
        * {
            box-sizing: border-box;
        }

        /* General Form Layout */
        form {
            display: block;
            width: 600px; /* Fixed width for larger screens */
            padding: 20px;
            background-color: #603F26;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin: 40px auto;
        }

        /* Form Heading */
        h2 {
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            color: #FB667A;
            margin: 0;
        }

        /* Form Label Styling */
        label {
            font-size: 1.1em;
            color: #FFDBB5;
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
            width: 100%; /* Full width for all inputs */
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #CD5C08;
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
            border-color: #FB667A;
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
            width: 100%; /* Full width for the submit button */
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
            background-color: #6C4E31;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
            font-size: 1.1em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .back a:hover {
            background-color: #FB667A;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            form {
                width: 95%; /* Adjust form width for small screens */
            }

            label,
            input,
            select {
                font-size: 1em; /* Adjust font size for small screens */
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
    include("nav.php");
    include("database.php");
    include("datetime.php");
    ?>

    <form action="" method="POST">
        <div class="back">
            <a href="insert_p.php"><b>Back</b></a><br><br>
        </div>

        <h2>Client Info:</h2>
        <label for="ClientNumber">Select Existing Client/s:</label>
        <select id="ClientNumber" name="ClientNumber" required>
            <option value="" align="center">-- PLEASE SELECT A CLIENT --</option>
            <?php
            $client_sql = "SELECT ClientNumber, givenName, lastName FROM allclients";
            $client_query = mysqli_query($conn, $client_sql);
            while ($row = mysqli_fetch_assoc($client_query)) {
                echo "<option value='" . $row['ClientNumber'] . "'>" . $row['givenName'] . " " . $row['lastName'] . "</option>";
            }
            ?>
        </select>
        <!-- Form -->
        <h2>Purchase Info:</h2>
        <label for="p_cost">Purchase Cost:</label>
        <input type="number" name="p_cost" required>

        <label for="condition_at_purchase">Condition:</label>
        <select name="condition_at_purchase" id="condition_at_purchase">
            <option value="" align="center">-- SELECT ITEM'S CONDITION --</option>
            <option value="Excellent" align="center">Excellent</option>
            <option value="Good" align="center">Good</option>
            <option value="Fair" align="center">Fair</option>
            <option value="Bad" align="center">Bad</option>
        </select>

        <hr>

        <h2>Item Info:</h2>
        <label for="asking_price">Asking Price:</label>
        <input type="number" name="asking_price" required>

        <label for="item_type">Item Type:</label>
        <input type="text" name="item_type" required>

        <label for="description">Description:</label>
        <input type="text" name="description" required>

        <label for="critiqued_comments">Critiqued Comments:</label>
        <input type="text" name="critiqued_comments" required>

        <input type="submit" name="submit" value="Add Record">
    </form>

    <?php

    if (isset($_POST['submit'])) {
    $clientNumber = trim($_POST['ClientNumber']);

    if (empty($clientNumber)) {
        echo "<script>alert('Please select a client.'); window.location='purchases.php';</script>";
        exit;
    }

    //------------------------------------------------------------------
    $sql = "SELECT * FROM allclients WHERE ClientNumber = '$clientNumber'";
    $query = mysqli_query($conn, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $clientData = mysqli_fetch_assoc($query);
    } else {
        echo "<script>alert('Client not found.'); window.location='purchases.php';</script>";
        exit;
    }

    //------------------------------------------------------------------
    $asking_price = $_POST['asking_price'];
    $item_type = $_POST['item_type'];
    $description = $_POST['description'];
    $critiqued_comments = $_POST['critiqued_comments'];
    $condition_at_purchase = $_POST['condition_at_purchase'];


    $insertItemSql = "INSERT INTO items (asking_price, item_type, description, critiqued_comments, `condition`) 
                      VALUES ('$asking_price', '$item_type', '$description', '$critiqued_comments', '$condition_at_purchase')";
    if (mysqli_query($conn, $insertItemSql)) {
        $itemNumber = mysqli_insert_id($conn);

        //------------------------------------------------------------------

        $p_cost = $_POST['p_cost'];
        $currentTimeStamp = getCurrentDateTime();

        $insertPurchaseSql = "INSERT INTO purchases (p_cost, condition_at_purchase, ClientNumber, item_num, p_date) 
                              VALUES ('$p_cost', '$condition_at_purchase', '$clientNumber', '$itemNumber', '$currentTimeStamp')";
        if (mysqli_query($conn, $insertPurchaseSql)) {
            echo "<script>alert('New record has been added successfully.'); window.location='purchases.php';</script>";
        } else {
            echo "<script>alert('Failed to add Purchase: " . mysqli_error($conn) . "'); window.location='purchases.php';</script>";
        }
    } else {
        echo "<script>alert('Failed to add Item: " . mysqli_error($conn) . "'); window.location='purchases.php';</script>";
    }
}
?>
</body>

</html>
