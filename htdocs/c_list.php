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
    /* Existing styles */
    .td a[href*="update_c.php"] {
        display: inline-block;
        padding: 5px 10px;
        background-color: #6C4E31;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        /* Ensures that borders between cells are collapsed into one */
    }

    .td a[href*="update_c.php"]:hover {
        background-color: #72BF78;
        cursor: pointer;
        transition: background-color 0.2s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .td a[href*="c_list.php?action=delete"] {
        display: inline-block;
        padding: 5px 10px;
        margin: 0 5px;
        background-color: #6C4E31;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .td a[href*="c_list.php?action=delete"]:hover {
        background-color: #FB667A;
        cursor: pointer;
        transition: background-color 0.2s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .td a:hover {
        background-color: #FB667A;
    }

    /* Table Styling */
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

    th {
        background-color: #6C4E31;
        /* Add background color to headers */
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
        /* Add alternate row background for readability */
    }

    tr:hover {
        background-color: #e6e6e6;
        /* Highlight rows on hover */
    }

    .th {
        text-align: left;
        font-size: 1.3em;
    }

    .container {
        width: 100%;
    }
</style>

<body>
    <form action="c_list.php" method="POST">
        <div class="table-wrapper">
            <table class="container" border="0">
                <thead>
                    <tr>
                        <th class="th" colspan="2"><a href="insert_c.php">Add Client</a></th>
                        <th align="right">Stillwater Antique Client List</th>
                    </tr>
                    <tr align="left">
                        <th width="40%">Full Name</th>
                        <th width="40%">Address</th>
                        <th align="center">Actions</th>
                    </tr>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td align="left"><span style="color: #CD5C08;"><?php echo htmlspecialchars($result['lastName']); ?></span>,
                                <?php echo htmlspecialchars($result['givenName']); ?></td>
                            <td align="left"><?php echo $result['ClientAddress']; ?></td>
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