<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commission Record</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .td a[href*="purchases.php?action=delete"] {
            display: inline-block;
            padding: 5px 10px;
            background-color: #6C4E31;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .td a[href*="purchases.php?action=delete"]:hover {
            background-color: #FB667A;
            cursor: pointer;
            transition: background-color 0.2s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .td a:hover {
            background-color: #FB667A;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* Ensures that borders between cells are collapsed into one */
        }

        td {
            border-left: 1px solid #E8B86D;
            /* Adds vertical lines on the left side */
            border-right: 1px solid #E8B86D;
            /* Adds vertical lines on the right side */
            padding: 10px;
        }

        .condition-excellent {
            color: gold;
            font-weight: bold;
            padding: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            /* Text outline effect */
        }

        .condition-good {
            color: greenyellow;
            font-weight: bold;
            padding: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            /* Text outline effect */
        }

        .condition-fair {
            color: orange;
            font-weight: bold;
            padding: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            /* Text outline effect */
        }

        .condition-bad {
            color: red;
            font-weight: bold;
            padding: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            /* Text outline effect */
        }

        .container td:first-child {
            color: #982B1C;
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
        p.purchase_id, 
        p.item_num,
        p.ClientNumber, 
        i.description AS item_description,
        i.asking_price, 
        i.is_sold,   -- Add this line to select the 'is_sold' column from items
        c.givenName, 
        c.lastName 
    FROM purchases p
    INNER JOIN items i ON p.item_num = i.item_num
    INNER JOIN allclients c ON p.ClientNumber = c.ClientNumber
    ORDER BY p.p_date DESC";

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        echo "Error: " . mysqli_error($conn);
    }
    ?>
    <div class="table-wrapper">
        <table class="container">
            <thead>
                <tr>
                    <th class="th" colspan="6"><a href="insert_p.php">Add Commission</a></th>
                    <th align="right">Stillwater Antique Commissions</th>
                </tr>
                <tr align="left">
                    <th width="170px">Date Commissioned</th>
                    <th width="150px">Commissioned By</th>
                    <th width="160px">Commissioned Item</th>
                    <th width="90px">Item Condition</th>
                    <th width="90px">Asking Price</th>
                    <th width="90px">Item Status</th>
                    <th align="center" width="170px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($result = mysqli_fetch_assoc($query)) {
                    $formatCost = number_format($result['asking_price']);

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

                    $p_date = !empty($result['p_date']) ? date("M d, Y", strtotime($result['p_date'])) . " -- " . date("g:i A", strtotime($result['p_date'])) : 'N/A';
                ?>
                    <tr align="left">
                        <td><?php echo $p_date; ?></td>
                        <td><?php echo $result['lastName'] . ', ' . $result['givenName']; ?></td>
                        <td><?php echo $result['item_description']; ?></td>
                        <td class="<?php echo $conditionClass; ?>"><?php echo $result['condition_at_purchase']; ?></td>
                        <td><span style="color: green;">₱ </span><?php echo $formatCost; ?></td>
                        <td>
                            <?php
                            // Check if the item is sold or still selling
                            if ($result['is_sold'] == 1) {
                                echo '<span style="color: green;">Sold</span>';
                            } else {
                                echo '<span style="color: orange;">Selling</span>';
                            }
                            ?>
                        </td>
                        <td align="center" class="td">
                            <a href="purchases.php?action=delete&id=<?php echo $result['purchase_id']; ?>">Delete</a>
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