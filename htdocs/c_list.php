<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients List</title>
</head>
<link rel="stylesheet" href="css/style.css">
<?php
include("database.php");
include("nav.php");

$sql = "SELECT * FROM allclients ORDER BY lastName ASC";
$query = mysqli_query($conn, $sql);

if (!$query) {
    echo "Error: " . mysqli_error($conn);
}
?>
<style>
    .td a[href*="update_c.php"] {
        display: inline-block;
        padding: 5px 15px;
        margin: 0 5px;
        background-color: #185875;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .td a[href*="update_c.php"]:hover {
        background-color: #72BF78;
        cursor: pointer;
        transform: translateY(-2px);
        transition: background-color 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .td a[href*="c_list.php?action=delete"] {
        display: inline-block;
        padding: 5px 15px;
        margin: 0 5px;
        background-color: #185875;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .td a[href*="c_list.php?action=delete"]:hover {
        background-color: #FB667A;
        cursor: pointer;
        transform: translateY(-2px);
        transition: background-color 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .td a:hover {
        background-color: #FB667A;
    }
</style>

<body>
    <br><br><br><br><br>
    <form action="c_list.php" method="POST">
        <div class="table-wrapper">
        <table class="container" border="0">
            <thead>
                <tr>
                    <th class="th" colspan="3"><a href="insert_c.php" colspan="2">Insert Client</a></th>
                    <th align="right">Stillwater Client List</th>
                </tr>
                <tr>
                    <th align="center">Given Name</th>
                    <th align="center">Address</th>
                    <th align="center">Client Number</th>
                    <th align="center" style="width: 175px;">Actions</th>
                </tr>
            <tbody>
                <?php
                while ($result = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td align="left" width="25%"><span style="color: yellow;"><?php echo htmlspecialchars($result['lastName']); ?></span>,
                            <?php echo htmlspecialchars($result['givenName']); ?></td>
                        <td align="center" width="40%"><?php echo $result['ClientAddress']; ?></td>
                        <td align="center"><span style="color: #FB667A;"><?php echo $result['ClientNumber']; ?></td>
                        <td align="center" class="td">
                            <a href='update_c.php?action=edit&ClientNumber=<?php echo $result["ClientNumber"]; ?>'>Edit</a>
                            <a href='c_list.php?action=delete&ClientNumber=<?php echo $result["ClientNumber"]; ?>' onclick="return confirm('Are you sure you want to delete this client?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </form>

    <?php
    if (isset($_GET['action']) && isset($_GET['ClientNumber'])) {
        $action = $_GET['action'];
        $clientNumber = $_GET['ClientNumber'];

        if ($action == 'delete') {
            $sql = "DELETE FROM allclients WHERE ClientNumber = '$clientNumber'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Client has been deleted successfully.'); window.location='c_list.php';</script>";
            } else {
                echo "<script>alert('Failed to delete client.'); window.location='c_list.php';</script>";
            }
        }
    }
    ?>
</body>

</html>