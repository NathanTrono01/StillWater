<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items List</title>
    <link rel="stylesheet" href="css/style.css">
    <?php
    include("nav.php");
    include("database.php");

    // Change the SQL query to select items where is_sold = 1
    $sql = "SELECT * FROM items WHERE is_sold = 1 ORDER BY item_num DESC";

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        echo "Error: " . mysqli_error($conn);
    }
    ?>
    <style>
        .td a[href*="update_i.php"] {
            display: inline-block;
            padding: 5px 15px;
            margin: 0 5px;
            background-color: #185875;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .td a[href*="update_i.php"]:hover {
            background-color: #72BF78;
            cursor: pointer;
            transform: translateY(-2px);
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .td a[href*="items.php?action=delete"] {
            display: inline-block;
            padding: 5px 15px;
            margin: 0 5px;
            background-color: #185875;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .td a[href*="items.php?action=delete"]:hover {
            background-color: #FB667A;
            cursor: pointer;
            transform: translateY(-2px);
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .condition-excellent {
            color: gold;
            font-weight: bold;
            padding: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }

        .condition-good {
            color: greenyellow;
            font-weight: bold;
            padding: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }

        .condition-fair {
            color: orange;
            font-weight: bold;
            padding: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }

        .condition-bad {
            color: red;
            font-weight: bold;
            padding: 5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }
    </style>
</head>

<body>
    <div class="table-wrapper">
        <table class="container">
            <thead>
                <tr>
                    <th align="left" colspan="5">Stillwater Antique Sold Items</th>
                </tr>
                <tr align="left">
                    <th width="150px">Name / Description</th>
                    <th width="80px">Condition</th>
                    <th width="80px">Price</th>
                    <th width="200px">Critiqued Comments</th>
                    <th width="50px">Item Type</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($result = mysqli_fetch_assoc($query)) {
                    $formatPrice = number_format($result['asking_price'], 2);
                    $conditionClass = '';
                    switch (strtolower($result['condition'])) {
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
                ?>
                    <tr align="left">
                        <td><?php echo $result['description']; ?></td>
                        <td class="<?php echo $conditionClass; ?>">
                            <?php echo $result['condition']; ?>
                        </td>
                        <td align="left"><span style="color: green;"> ₱</span> <?php echo $formatPrice; ?></td>
                        <td><?php echo $result['critiqued_comments']; ?></td>
                        <td><?php echo $result['item_type']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <?php
            if (isset($_GET['action']) && isset($_GET['item_num'])) {
                $action = $_GET['action'];
                $item_num = $_GET['item_num'];

                if ($action == 'delete') {
                    $sql = "DELETE FROM items WHERE item_num = '$item_num'";
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>alert('Deletion is successful.'); window.location='items.php';</script>";
                    } else {
                        echo "<script>alert('Failed to delete the item.'); window.location='items.php';</script>";
                    }
                }
            }
            ?>
        </table>
    </div>
</body>

</html>