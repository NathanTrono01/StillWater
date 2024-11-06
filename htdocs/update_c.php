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

<style>
  body {
    font-family: 'Open Sans', sans-serif;
    font-weight: 300;
    line-height: 1.42em;
    color: #A7A1AE;
    background-color: #1F2739;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  h2 {
    font-size: 2em;
    font-weight: bold;
    text-align: center;
    color: #FB667A;
    margin-bottom: 20px;
    margin-top: 0;
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
    margin-bottom: 10px;
    color: #A7A1AE;
    font-weight: bold;
  }

  input[type="text"],
  input[type="number"],
  input[type="submit"],
  select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 2px solid #4DC3FA;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
  }

  input[type="text"],
  input[type="number"] {
    background-color: #2C3446;
    color: #FFF;
  }

  input[type="submit"] {
    background-color: #FFF842;
    color: #403E10;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  input[type="submit"]:hover {
    background-color: #FB667A;
    color: #FFF;
  }

  a[href*="c_list.php"] {
    display: inline-block;
    padding: 10px 15px;
    margin: 0 10px;
    background-color: #185875;
    /* Blue accent to match table headings */
    color: white;
    text-decoration: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  }

  a[href*="c_list.php"]:hover {
    background-color: #FB667A;
    cursor: pointer;
    transition: background-color 0.1s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    /* Pink hover effect to match table details */
  }
</style>
<br><br><br><br><br><br>
<form action="update_c.php?ClientNumber=<?php echo $clientNumber; ?>" method="post">
<a href="c_list.php">Back</a>
<br><br>

  <label for="lastName">Last Name:</label>
  <input type="text" id="lastName" name="lastName" value="<?php echo $clientData['lastName']; ?>" required><br>

  <label for="givenName">Given Name:</label>
  <input type="text" id="givenName" name="givenName" value="<?php echo $clientData['givenName']; ?>" required><br>

  <label for="ClientAddress">Address:</label>
  <input type="text" id="ClientAddress" name="ClientAddress" value="<?php echo $clientData['ClientAddress']; ?>" required><br>

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