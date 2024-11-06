<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Record</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .td a[href*="purchases.php?action=delete"] {
            display: inline-block;
            padding: 5px 15px;
            margin: 0 5px;
            background-color: #185875;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .td a[href*="purchases.php?action=delete"]:hover {
            background-color: #FB667A;
            cursor: pointer;
            transform: translateY(-2px);
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .td a:hover {
            background-color: #FB667A;
        }

        .condition-excellent {
            color: gold;
            font-weight: bold;
            padding: 5px;

        }

        .condition-good {
            color: greenyellow;
            font-weight: bold;
            padding: 5px;

        }

        .condition-fair {
            color: orange;
            font-weight: bold;
            padding: 5px;

        }

        .condition-bad {
            color: red;
            font-weight: bold;
            padding: 5px;

        }

        .container td:first-child {
            color: #FB667A;
        }
    </style>
</head>

<body>
    <?php
    include("nav.php");
    include("database.php");

    $sql = "SELECT 
            p.p_date, 
            p.condition_at_purchase, 
            p.p_cost, 
            p.purchase_id, 
            p.item_num, 
            p.ClientNumber, 
            i.description AS item_description, 
            c.givenName, 
            c.lastName 
        FROM 
            purchases p
        INNER JOIN 
            items i ON p.item_num = i.item_num
        INNER JOIN 
            allclients c ON p.ClientNumber = c.ClientNumber
        ORDER BY 
            p.p_date DESC";

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        echo "Error: " . mysqli_error($conn);
    }
    ?>
    <br><br><br><br><br>
    <div class="table-wrapper">
    <table class="container">
        <thead>
            <tr>
                <th class="th" colspan="6"><a href="insert_p.php">Add Record</a></th>
                <th align="right">Stillwater Purchase Record</th>
            </tr>
            <tr align="center">
                <th width="150px">Date Purchased</th>
                <th width="150px">Sold by</th>
                <th width="150px">Item</th>
                <th width="50px">Item Condition</th>
                <th width="80px">Purchase Cost</th>
                <th width="80px">Purchase ID</th>
                <th width="200px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($result = mysqli_fetch_assoc($query)) {
                $formatCost = number_format($result['p_cost']);

                $conditionClass = '';
                switch (strtolower($result['condition_at_purchase'])) {
                    case 'excellent':
                        $conditionClass = 'condition-excellent';
                        break;
                    case 'good':
                        $conditionClass = 'condition-good';
                        break;
                    case 'fair':
                        $conditionClass = 'condition-fair';
                        break;
                    case 'bad':
                        $conditionClass = 'condition-bad';
                        break;
                }

                $p_date = !empty($result['p_date']) ? date("M d, Y -- g:i A", strtotime($result['p_date'])) : 'N/A';
            ?>
                <tr align="center">
                    <td><?php echo $p_date; ?></td>
                    <td><?php echo $result['givenName']; ?></td>
                    <td><?php echo $result['item_description']; ?></td>
                    <td class="<?php echo $conditionClass; ?>"><?php echo $result['condition_at_purchase']; ?></td>
                    <td align="left"><span style="color: green;">₱ </span><?php echo $formatCost; ?></td>
                    <td style="color: #FB667A;"><?php echo $result['purchase_id']; ?></td>
                    <td class="td">
                        <a href='purchases.php?action=delete&purchase_id=<?php echo $result["purchase_id"]; ?>' onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    </div>
    <?php
    if (isset($_GET['action']) && isset($_GET['purchase_id'])) {
        $action = $_GET['action'];
        $purchase_id = $_GET['purchase_id'];

        if ($action == 'delete') {
            $sql = "DELETE FROM purchases WHERE purchase_id = '$purchase_id'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Purchase Record has been deleted successfully.'); window.location='purchases.php';</script>";
            } else {
                echo "<script>alert('Failed to delete the Purchase Record.'); window.location='purchases.php';</script>";
            }
        }
    }
    ?>
</body>

</html>