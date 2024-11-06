<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Record</title>
</head>
<link rel="stylesheet" href="css/style.css">
<style>
    .td a[href*="update_s.php"] {
        display: inline-block;
        padding: 5px 15px;
        margin: 0 10px;
        background-color: #185875;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .td a[href*="update_s.php"]:hover {
        background-color: #72BF78;
        cursor: pointer;
        transition: background-color 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .td a[href*="sales.php?action=delete"] {
        display: inline-block;
        padding: 5px 15px;
        margin: 0 10px;
        background-color: #185875;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .td a[href*="sales.php?action=delete"]:hover {
        background-color: #FB667A;
        cursor: pointer;
        transform: translateY(-2px);
        transition: background-color 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .container td:first-child {
        color: #FB667A;
    }
</style>

<?php
include("nav.php");
include("database.php");
include("datetime.php");

$sql = "SELECT 
    s.date_sold, 
    s.sellingPrice, 
    s.commissionPaid, 
    s.saleID, s.ClientNumber, 
    c.givenName, 
    c.lastName, 
    s.item_num, 
    i.description
FROM sales s
INNER JOIN allclients c ON s.ClientNumber = c.ClientNumber
INNER JOIN items i ON s.item_num = i.item_num
ORDER BY s.date_sold ASC;";

$query = mysqli_query($conn, $sql);

if (!$query) {
    echo "Error: " . mysqli_error($conn);
}
?>

<body>
    <br><br><br><br><br>
    <div class="table-wrapper">
    <table class="container">
        <thead>
            <tr>
                <th class="th" colspan="7"><a href="insert_s.php">Add Record</a></th>
                <th align="right">Stillwater Sales Record</th>
            </tr>
            <tr align="center">
                <th>Date Sold</th>
                <th>Sold to</th>
                <th>Item Description</th>
                <th>Selling Price</th>
                <th>Commission Paid</th>
                <th>Sales Tax (12%)</th>
                <th>Sale ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody align="center">
            <?php
            while ($result = mysqli_fetch_assoc($query)) {
                $saleID = $result['saleID'];
                $description = $result['description'];
                $lastName = $result['lastName'];
                $givenName = ($result['givenName'] !== null) ? $result['givenName'] : 'N/A';

                $sellingPrice = $result['sellingPrice'] !== null ? number_format($result['sellingPrice'], 2) : ' 0.00';
                $commission = $result['commissionPaid'] !== null ? number_format($result['commissionPaid'], 2) : ' 0.00';

                $salesTax = $result['sellingPrice'] !== null ? $result['sellingPrice'] * 0.12 : 0;
                $formatSalesTax = number_format($salesTax, 2); // format sales tax

                $dateSold = !empty($result['date_sold']) ? date("M d, Y -- g:i A", strtotime($result['date_sold'])) : 'N/A';
            ?>
                <tr>
                    <td><?php echo $dateSold; ?></td>
                    <td><?php echo $givenName . ' ' . $lastName; ?></td>
                    <td><?php echo $description; ?></td>
                    <td align="left"><span style="color: green;">₱</span> <?php echo $sellingPrice; ?></td>
                    <td align="left"><span style="color: green;">₱</span> <?php echo $commission; ?></td>
                    <td align="left"><span style="color: green;">₱</span> <?php echo $formatSalesTax; ?></td> <!-- Display calculated sales tax -->
                    <td style="color: #FB667A"><?php echo $saleID; ?></td>
                    <td align="center" width="20%" class="td">
                        <a href='sales.php?action=delete&saleID=<?php echo $result["saleID"]; ?>' onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>

    <?php
    if (isset($_GET['action']) && isset($_GET['saleID'])) {
        $action = $_GET['action'];
        $saleID = $_GET['saleID'];

        if ($action == 'delete') {
            $sql = "DELETE FROM sales WHERE saleID = '$saleID'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Record has been deleted successfully.'); window.location='sales.php';</script>";
            } else {
                echo "<script>alert('Failed to delete the Record.'); window.location='sales.php';</script>";
            }
        }
    }
    ?>
</body>

</html>