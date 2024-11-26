<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients List</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        
        th {
            background-color: #6C4E31;
            color: white;
        }

        .th {
            text-align: left;
            font-size: 1.3em;
        }

        .container {
            width: 100%;
        }
    </style>
</head>
<?php
include("database.php");
include("nav.php");

$sql = "SELECT * FROM allclients ORDER BY lastName ASC";
$query = mysqli_query($conn, $sql);

if (!$query) {
    echo "Error: " . mysqli_error($conn);
}
?>

<body>
    <form action="c_list.php" method="POST">
        <div class="table-wrapper">
            <table class="container">
                <thead>
                    <tr>
                        <th class="th" colspan="2"><a href="insert_c.php">Add Client</a></th>
                        <th align="right">Stillwater Antique Client List</th>
                    </tr>
                    <tr align="left">
                        <th width="40%">Full Name</th>
                        <th width="40%">Address</th>
                        <th align="center" class="action-buttons">Actions</th>
                    </tr>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td align="left"><span style="color: #008170;"><?php echo htmlspecialchars($result['lastName']); ?></span>,
                                <?php echo htmlspecialchars($result['givenName']); ?></td>
                            <td align="left"><?php echo $result['ClientAddress']; ?></td>
                            <td align="center" class="action-buttons">
                                <a class="bx bxs-edit editbtn" href='update_c.php?action=edit&ClientNumber=<?php echo $result["ClientNumber"]; ?>'></a>
                                <a class="bx bxs-trash deletebtn" href='c_list.php?action=delete&ClientNumber=<?php echo $result["ClientNumber"]; ?>' onclick="return confirm('Are you sure you want to delete this client?');"></a>
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