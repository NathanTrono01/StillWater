
<title>Add Client</title>
<link rel="stylesheet" href="css/style.css">
<style>
    /* General Form Layout */
    form {
        display: block;
        grid-template-columns: 1fr;
        width: 500px;  /* Reduced width of the form */
        padding: 15px;
        background-color: #603F26;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        margin: 40px auto 0;
        /* Center form on page */
    }

    /* Form Heading */
    h2 {
        font-size: 1.8em;
        font-weight: bold;
        text-align: center;
        color: #FB667A;
        margin: 0 0 20px 0;
    }

    /* Form Label Styling */
    label {
        font-size: 1em;
        color: #FFDBB5;
        font-weight: bold;
        margin-bottom: 5px;
    }

    /* Input Fields */
    input[type="text"],
    input[type="number"],
    input[type="datetime-local"],
    select {
        width: 95%;  /* Full width of the form */
        padding: 10px;
        margin-bottom: 15px;
        border: 2px solid #CD5C08;
        border-radius: 8px;
        font-size: 14px;
        background-color: #FFEAC5;
        color: black;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: border-color 0.3s ease;
    }

    /* Focus Effect on Input Fields */
    input[type="text"]:focus,
    input[type="number"]:focus,
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
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #800000;
        color: #FFF;
    }

    /* Back Button Styling */
    .back a[href*="c_list.php"] {
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

    .back a[href*="c_list.php"]:hover {
        background-color: #FB667A;
        cursor: pointer;
    }

    /* Responsive Design */
    @media (max-width: 600px) {
        form {
            width: 95%;
        }

        label,
        input,
        select {
            font-size: 0.9em;
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
<?php
include("nav.php");
include("database.php");
?>
<form action="insert_c.php" method="post">
    <div class="back">
        <a href="c_list.php"><b>Back</b></a><br><br>
    </div>


    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required><br>

    <label for="givenName">Given Name:</label>
    <input type="text" id="givenName" name="givenName" required><br>

    <label for="ClientAddress">Address:</label>
    <input type="text" id="ClientAddress" name="ClientAddress" required><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php
if (isset($_POST['submit'])) {
    $givenName = trim($_POST['givenName']);
    $lastName = trim($_POST['lastName']);
    $ClientAddress = trim($_POST['ClientAddress']);

    // Check if client already exists
    $sql = "SELECT * FROM allclients WHERE givenName = '$givenName' AND lastName = '$lastName'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        if (mysqli_num_rows($query) > 0) {
            $clientData = mysqli_fetch_assoc($query);
            $clientNumber = $clientData['ClientNumber'];
            echo "<p>Client already exists with ClientNumber: <b>$clientNumber</b></p>";
        } else {
            // Insert new client
            $sql = "INSERT INTO allclients (givenName, lastName, ClientAddress) 
                    VALUES ('$givenName', '$lastName', '$ClientAddress')";
            if (mysqli_query($conn, $sql)) {
                $clientNumber = mysqli_insert_id($conn);
                echo "<p>Client <b>$givenName $lastName</b> added successfully. ClientNumber: <b>$clientNumber</b></p>";
            } else {
                echo "<p>Error: " . mysqli_error($conn) . "</p>";
            }
        }
    } else {
        echo "<p>Connection Error: " . mysqli_error($conn) . "</p>";
    }
}
?>
