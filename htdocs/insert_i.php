<title>Add Item</title>
<link rel="stylesheet" href="css/style.css">
<style>
    /* General Form Layout */
    form {
        display: block;
        width: 600px;
        padding: 30px;
        background-color: #603F26;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        margin: 40px auto;
        /* Center form on page */
        box-sizing: border-box;
    }

    /* Form Heading */
    h2 {
        font-size: 2em;
        font-weight: bold;
        text-align: center;
        color: #FB667A;
        margin: 0 0 20px;
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
    select {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 2px solid #CD5C08;
        border-radius: 8px;
        font-size: 16px;
        background-color: #FFEAC5;
        color: black;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: border-color 0.3s ease;
        box-sizing: border-box;
    }

    /* Focus Effect on Input Fields */
    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="date"]:focus,
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
        width: 100%;
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
?>
<form action="insert_i.php" method="post">
    <div class="back">
        <a href="items.php"><b>Back</b></a>
    </div>

    <label for="condition">Condition:</label>
    <select name="condition" id="condition" required>
        <option value="">-- SELECT ITEM'S CONDITION --</option>
        <option value="Excellent" style="color: gold;">Excellent</option>
        <option value="Good" style="color: greenyellow;">Good</option>
        <option value="Fair" style="color: orange;">Fair</option>
        <option value="Bad" style="color: red;">Bad</option>
    </select>

    <label for="item_type">Item Type (e.g., Furniture, Equipment, Jewelry):</label>
    <input type="text" id="item_type" name="item_type" required>

    <label for="asking_price">Asking Price:</label>
    <input type="number" id="asking_price" name="asking_price" required>

    <label for="description">Description:</label>
    <input type="text" id="description" name="description" required>

    <label for="critiqued_comments">Comments:</label>
    <input type="text" id="critiqued_comments" name="critiqued_comments" required>

    <input type="submit" name="submit" value="Submit">
</form>

<?php
if (isset($_POST['submit'])) {
    $condition = trim($_POST['condition']);
    $item_type = trim($_POST['item_type']);
    $asking_price = trim($_POST['asking_price']);
    $description = trim($_POST['description']);
    $comments = trim($_POST['critiqued_comments']);

    // Check if item already exists
    $sql = "SELECT * FROM items WHERE description = '$description'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        if (mysqli_num_rows($query) > 0) {
            echo "Item already exists";
        } else {
            // Insert the new item
            $sql = "INSERT INTO items (`condition`, item_type, asking_price, description, critiqued_comments) 
                    VALUES ('$condition', '$item_type', '$asking_price', '$description', '$comments')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Item Added Successfully'); window.location='items.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        echo "Connection Error: " . mysqli_error($conn);
    }
}
?>
