<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Client</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      font-weight: 300;
      line-height: 1.42em;
      color: #A7A1AE;
      /* Light gray text */
      background-color: #1F2739;
      /* Dark background */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      /* Full height of the viewport */
      margin: 0;
    }

    h2 {
      font-size: 2em;
      font-weight: bold;
      /* Bold the header */
      text-align: center;
      color: #FB667A;
      /* Light red for the form heading */
      margin-bottom: 20px;
      margin-top: 0;
    }

    form {
      width: 50%;
      padding: 20px;
      background-color: #323C50;
      /* Darker background for form */
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #A7A1AE;
      /* Light gray for label text */
      font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="datetime-local"],
    input[type="submit"],
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 2px solid #4DC3FA;
      /* Blue border */
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 16px;
    }

    input[type="text"],
    input[type="number"] {
      background-color: #2C3446;
      /* Dark input background */
      color: #FFF;
      /* White text in input fields */
    }

    input[type="submit"] {
      background-color: #FFF842;
      /* Yellow submit button */
      color: #403E10;
      /* Dark text */
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #FB667A;
      /* Red hover for submit button */
      color: #FFF;
      /* White text on hover */
    }

    .back a[href*="c_list.php"] {
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
  </style>
  <?php
  include("database.php");
  include("nav.php");

  $clientNumber = $_GET['ClientNumber'];

  $sql = "SELECT * FROM allclients WHERE ClientNumber = '$clientNumber'";
  $query = mysqli_query($conn, $sql);
  $clientData = mysqli_fetch_assoc($query);

  if (!$clientData) {
    echo "<script>alert('No client found with Client Number $clientNumber'); window.location='c_list.php';</script>";
    exit();
  }
  ?>
</head>

<body>
<div class="back">
  <form action="update_c.php?ClientNumber=<?php echo $clientNumber; ?>" method="post">
    <a href="c_list.php">Back</a>
</div>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($clientData['lastName']); ?>" required>

    <label for="givenName">Given Name:</label>
    <input type="text" id="givenName" name="givenName" value="<?php echo htmlspecialchars($clientData['givenName']); ?>" required>

    <label for="ClientAddress">Address:</label>
    <input type="text" id="ClientAddress" name="ClientAddress" value="<?php echo htmlspecialchars($clientData['ClientAddress']); ?>" required>

    <input type="submit" name="submit" value="Submit">
  </form>

  <?php
  if (isset($_POST['submit'])) {
    $lastName = trim($_POST['lastName']);
    $givenName = trim($_POST['givenName']);
    $ClientAddress = trim($_POST['ClientAddress']);

    $sql = "UPDATE allclients SET lastName = '$lastName', givenName = '$givenName', ClientAddress = '$ClientAddress' WHERE ClientNumber = '$clientNumber'";

    if (mysqli_query($conn, $sql)) {
      echo "<script>alert('Client\'s Information updated successfully!'); window.location='c_list.php';</script>";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  ?>
</body>

</html>