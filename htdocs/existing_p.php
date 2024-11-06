<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Purchase Record</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #1F2739;
            color: #A7A1AE;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        form {
            width: 90%;
            max-width: 600px;
            /* Set a maximum width */
            padding: 20px;
            background-color: #323C50;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin: 0 auto;
            /* Center the form */
        }

        h1 {
            font-size: 2em;
            font-weight: bold;
            /* Bold the header */
            text-align: center;
            color: #4DC3FA;
            /* Light red for the form heading */
            margin-bottom: 20px;
            margin-top: 0;
        }

        h2 {
            margin-top: 15px;
            margin-bottom: 10px;
            font-size: 1.5em;
        }

        hr {
            margin: 15px 0;
        }

        form {
            width: 50%;
            padding: 20px;
            background-color: #323C50;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #A7A1AE;
        }

        input[type="text"],
        input[type="number"],
        input[type="datetime-local"],
        input[type="submit"],
        select[id="ClientNumber"],
        select[id="condition_at_purchase"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 2px solid #4DC3FA;
            /* Blue border */
            border-radius: 5px;
            background-color: #2C3446;
            /* Dark input background */
            color: #FFF;
            /* White text */
            box-sizing: border-box;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        input[type="text"],
        input[type="number"],
        select {
            background-color: #2C3446;
            /* Dark input background */
            color: #FFF;
            /* White text in input fields */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"] {
            margin-top: 15px;
            background-color: #FFF842;
            color: #403E10;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"]:hover {
            background-color: #FB667A;
            color: #FFF;
        }

        a[href*="insert_p.php"] {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #185875;
            /* Blue accent to match table headings */
            color: white;
            text-decoration: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        a[href*="insert_p.php"]:hover {
            background-color: #FB667A;
            cursor: pointer;
            transition: background-color 0.1s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            /* Pink hover effect to match table details */
        }

        @media (max-width: 768px) {
            form {
                width: 95%;
                padding: 15px;
            }
        }
    </style>
</head>
<?php
include("database.php");
include("nav.php");
include("datetime.php");

//------------------------------------------------------------------
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

<body>
    <br><br><br><br><br><br>
    <form action="" method="POST">
        <a href="insert_p.php">Back</a>
        <br>
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
            <option value="Excellent" align="center" style="color: Gold;">Excellent</option>
            <option value="Good" align="center" style="color: greenyellow;">Good</option>
            <option value="Fair" align="center" style="color: Orange;">Fair</option>
            <option value="Bad" align="center" style="color: red;">Bad</option>
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
</body>

</html>