<?php
include("database.php");
include("nav.php");

$item_num = $_GET['item_num'];

$sql = "SELECT * FROM items WHERE item_num = '$item_num'";
$query = mysqli_query($conn, $sql);
$itemData = mysqli_fetch_assoc($query);

if (!$itemData) {
    echo "<script>alert('No Item found with Item Number $item_num'); window.location='items.php';</script>";
    exit();
}
?>

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
        height: 100vh;
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

    a[href*="items.php"] {
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

    a[href*="items.php"]:hover {
        background-color: #FB667A;
        cursor: pointer;
        transition: background-color 0.1s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        /* Pink hover effect to match table details */
    }
</style>
<br><br><br><br><br><br>
<form action="update_i.php?item_num=<?php echo $item_num; ?>" method="post">
    <a href="items.php">Back</a>
    <br><br>

    <label for="condition">Condition: </label>
    <select name="condition" id="condition" required>
        <option value="" disabled selected align="center">Currently: <?php echo htmlspecialchars($itemData['condition']); ?></option>
        <option value="Excellent" style="color: Gold; text-align: center;">Excellent</option>
        <option value="Good" style="color: GreenYellow; text-align: center;">Good</option>
        <option value="Fair" style="color: Orange; text-align: center;">Fair</option>
        <option value="Bad" style="color: Red; text-align: center;">Bad</option>
    </select>

    <label for="item_type">Item Type:</label>
    <input type="text" id="item_type" name="item_type" value="<?php echo $itemData['item_type']; ?>" required><br>

    <label for="asking_price">Asking Price:</label>
    <input type="number" id="asking_price" name="asking_price" value="<?php echo $itemData['asking_price']; ?>" required><br><br>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" value="<?php echo $itemData['description']; ?>" required><br>

    <label for="critiqued_comments">Comments:</label>
    <input type="text" id="critiqued_comments" name="critiqued_comments" value="<?php echo $itemData['critiqued_comments']; ?>" required><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php
if (isset($_POST['submit'])) {
    $condition = trim($_POST['condition']);
    $item_type = trim($_POST['item_type']);
    $asking_price = trim($_POST['asking_price']);
    $description = trim($_POST['description']);
    $comments = trim($_POST['critiqued_comments']);

    $sql = "UPDATE items SET `condition` = '$condition', item_type = '$item_type', asking_price = '$asking_price', `description` = '$description', critiqued_comments = '$comments' WHERE item_num = '$item_num'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Item\'s Information updated successfully!'); window.location='items.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>