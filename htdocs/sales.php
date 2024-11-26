<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Record</title>
    <link rel="stylesheet" href="css/style.css">
    <style>

        .container td:first-child {
            color: #008170;
        }
    </style>
</head>

<body>
    <?php
    include("nav.php");
    include("database.php");
    include("datetime.php");

    $sql = "SELECT 
            s.date_sold, 
            s.sellingPrice, 
            s.commissionPaid, 
            s.saleID, 
            s.ClientNumber, 
            s.item_num, 
            i.description,
            owner.givenName AS ownerGivenName,
            owner.lastName AS ownerLastName
        FROM sales s
        LEFT JOIN items i ON s.item_num = i.item_num  
        LEFT JOIN allclients owner ON i.ClientNumber = owner.ClientNumber  
        ORDER BY s.date_sold ASC";

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        echo "Error: " . mysqli_error($conn);
    }
    ?>
    <div class="table-wrapper">
        <table class="container">
            <thead>
                <tr>
                    <th class="th" colspan="6"><a href="insert_s.php">Add Sale</a></th>
                    <th align="right">Stillwater Antique Sales</th>
                </tr>
                <tr align="left">
                    <th width="200px">Date Sold</th>
                    <th width="175px">Commissioner</th>
                    <th width="175px">Item Description</th>
                    <th>Selling Price</th>
                    <th>Commission Paid</th>
                    <th>Sales Tax (12%)</th>
                    <th align="center">Action</th>
                </tr>
            </thead>
            <tbody align="left">
                <?php
                while ($result = mysqli_fetch_assoc($query)) {
                    $saleID = $result['saleID'];
                    $description = ($result['description'] !== null) ? $result['description'] : 'N/A';

                    // Check if owner information is available
                    $itemOwner = '';
                    if (isset($result['ownerLastName']) && isset($result['ownerGivenName']) && $result['ownerLastName'] !== null && $result['ownerGivenName'] !== null) {
                        $itemOwner = $result['ownerLastName'] . ', ' . $result['ownerGivenName'];
                    } else {
                        // Fallback owner if no data exists
                        $itemOwner = 'Stillwater Antique';
                    }

                    $sellingPrice = $result['sellingPrice'] !== null ? number_format($result['sellingPrice'], 2) : '0.00';
                    $commission = $result['commissionPaid'] !== null ? number_format($result['commissionPaid'], 2) : '0.00';

                    $salesTax = $result['sellingPrice'] !== null ? $result['sellingPrice'] * 0.12 : 0;
                    $formatSalesTax = number_format($salesTax, 2); // format sales tax

                    $dateSold = !empty($result['date_sold']) ? date("M d, Y", strtotime($result['date_sold'])) . " -- " . date("g:i A", strtotime($result['date_sold'])) : 'N/A';
                ?>
                    <tr>
                        <td style="font-size: 1em;"><?php echo $dateSold; ?></td>
                        <td><?php echo $itemOwner; ?></td> <!-- Displaying the item owner -->
                        <td><?php echo $description; ?></td>
                        <td><span style="color: green;">₱</span> <?php echo $sellingPrice; ?></td>
                        <td><span style="color: green;">₱</span> <?php echo $commission; ?></td>
                        <td><span style="color: green;">₱</span> <?php echo $formatSalesTax; ?></td> <!-- Display calculated sales tax -->
                        <td align="center" class="action-buttons">
                            <a class="bx bxs-trash deletebtn" href='sales.php?action=delete&saleID=<?php echo $result["saleID"]; ?>' onclick="return confirm('Are you sure you want to delete this record?');"></a>
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