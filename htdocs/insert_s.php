<title>Add Sales Record</title>
<link rel="stylesheet" href="css/style.css">
<style>
    /* General Form Layout */
    form {
        display: block;
        grid-template-columns: 1fr;
        width: 600px;
        padding: 20px;
        background-color: #603F26;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        margin: 40px auto 0;
        /* Center form on page */
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
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #800000;
        color: #FFF;
    }

    /* Back Button Styling */
    .back a[href*="sales.php"] {
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

    .back a[href*="sales.php"]:hover {
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
include("nav.php");
include("database.php");
include("datetime.php");
?>
<form action="insert_s.php" method="post">
    <div class="back">
        <a href="sales.php" align="left"><b>Back</b></a><br><br>
    </div>


    <label for="item_num">Item:</label>
    <select id="item_num" name="item_num" required><br>
        <option value="">Select an Item</option>
        <?php
        $item_sql = "SELECT item_num, `description` FROM items WHERE is_sold = 0";
        $item_query = mysqli_query($conn, $item_sql);
        while ($row = mysqli_fetch_assoc($item_query)) {
            echo "<option value='" . $row['item_num'] . "'>" . $row['description'] . "</option>";
        }
        ?>
    </select><br>

    <label for="sellingPrice">Selling Price:</label><br>
    <input type="number" id="sellingPrice" name="sellingPrice" required oninput="calculateSalesTax()"><br>

    <label for="ClientNumber">Called Client: (Optional)</label><br>
    <select id="ClientNumber" name="ClientNumber">
        <option value="">-- SELECT A CLIENT --</option>
        <?php
        $client_sql = "SELECT ClientNumber, givenName, lastName FROM allclients";
        $client_query = mysqli_query($conn, $client_sql);
        while ($row = mysqli_fetch_assoc($client_query)) {
            echo "<option value='" . $row['ClientNumber'] . "'>" . $row['givenName'] . " " . $row['lastName'] . "</option>";
        }
        ?>
    </select><br>

    <label for="commissionPaid">Commission Paid (Optional):</label><br>
    <input type="number" id="commissionPaid" name="commissionPaid"><br>

    <label for="salesTax">Sales Tax (12%):</label>
    <input type="number" id="salesTax" name="salesTax" readonly><br>

    <input type="submit" name="submit" value="Submit">
</form>

<script>
    function calculateSalesTax() {
        var sellingPrice = document.getElementById("sellingPrice").value;
        var salesTax = sellingPrice * 0.12;
        document.getElementById("salesTax").value = salesTax.toFixed(2);
    }
</script>

<?php
if (isset($_POST['submit'])) {
    $sellingPrice = $_POST['sellingPrice'];
    $commissionPaid = $_POST['commissionPaid'] ?: null;
    $clientNumber = $_POST['ClientNumber'] ?: null;
    $itemNum = $_POST['item_num'];
    $salesTax = $_POST['salesTax'];

    $currentTimeStamp = getCurrentDateTime();

    $sql = "INSERT INTO sales (sellingPrice, commissionPaid, salesTax, ClientNumber, item_num, date_sold) 
            VALUES ('$sellingPrice', " . ($commissionPaid !== null ? "'$commissionPaid'" : "NULL") . ", 
            '$salesTax', " . ($clientNumber !== null ? "'$clientNumber'" : "NULL") . ", 
            '$itemNum', '$currentTimeStamp')";

    if (mysqli_query($conn, $sql)) {
        $update_item_sql = "UPDATE items SET is_sold = 1 WHERE item_num = '$itemNum'";
        mysqli_query($conn, $update_item_sql);
        echo "<script>alert('Record has been added successfully.'); window.location='sales.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>