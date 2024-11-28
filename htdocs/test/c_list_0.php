<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients List</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sb.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            line-height: 1.42em;
            color: #202020;
            background-color: #D2C9AC;
            margin: 0;
        }

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
            background-color: rgba(31, 39, 57, 0.6);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-spacing: 0;
            font-size: 1rem;
        }

        .container th,
        .container td {
            padding: 10px;
            font-size: 1rem;
            border-left: 1px solid #3f3c36;
            border-right: 1px solid #3f3c36;
        }

        .container tr:nth-child(odd) {
            background-color: #FFF8E8;
        }

        .container tr:nth-child(even) {
            background-color: #F7EED3;
        }

        .container tr:hover {
            background-color: #E8B86D;
            box-shadow: 0 6px 6px -6px #0E1119;
            transition: all 0.3s ease;
        }

        .action-buttons a {
            display: inline-block;
            font-size: 20px;
            padding: 5px 5px;
            background-color: #3f3c36;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .action-buttons a:hover {
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .editbtn:hover {
            color: limegreen;
        }

        .deletebtn:hover {
            color: rgb(211, 0, 0);
        }
    </style>
</head>

<body>
    <?php include("sidebar.php"); ?>

    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Clients List</span>
        </div>
        <div class="one">
            <?php
            include("database.php");

            $sql = "SELECT * FROM allclients ORDER BY lastName ASC";
            $query = mysqli_query($conn, $sql);

            if (!$query) {
                echo "Error: " . mysqli_error($conn);
            }
            ?>

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
                        </thead>
                        <tbody>
                            <?php
                            while ($result = mysqli_fetch_assoc($query)) { ?>
                                <tr>
                                    <td align="left"><span style="color: #CD5C08;"><?php echo htmlspecialchars($result['lastName']); ?></span>,
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
        </div>
    </section>

    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>
</body>

</html>