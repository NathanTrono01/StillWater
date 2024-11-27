<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Client</title>
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
  <form action="update_c.php?ClientNumber=<?php echo $clientNumber; ?>" method="post">
    <div class="back">
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
      echo "<script>alert('Client has been updated successfully!'); window.location='c_list.php';</script>";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  ?>
</body>

</html>