<?php
include("database.php");

if (isset($_GET['item_num'])) {
    $item_num = mysqli_real_escape_string($conn, $_GET['item_num']);

    // Query to get item details
    $query = "SELECT 
                i.asking_price, 
                CONCAT(
                    IFNULL(c.givenName, 'Stillwater'), ' ',
                    IFNULL(c.lastName, 'Antique')
                ) AS item_owner 
              FROM items i 
              LEFT JOIN allclients c ON i.ClientNumber = c.ClientNumber 
              WHERE i.item_num = '$item_num'";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    echo json_encode($data);
}
