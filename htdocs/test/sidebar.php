<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Navigation with Dropdown</title>
    <link rel="stylesheet" href="css/sb.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <i class='bx bxl-c-plus-plus'></i>
            <span class="logo_name">MesaVerte</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="c_list.php">
                    <i class='bx bx-user'></i>
                    <span class="link_name">Clients</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="c_list.php">Clients</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="items.php">
                        <i class='bx bx-box'></i>
                        <span class="link_name">Inventory</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="items.php">Inventory</a></li>
                    <li><a href="insert_i.php">New Item</a></li>
                    <li><a href="items.php">Available Items</a></li>
                    <li><a href="sold_items.php">Sold Items</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="purchases.php">
                        <i class='bx bx-dollar-circle'></i>
                        <span class="link_name">Commissions</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="purchases.php">Commissions</a></li>
                    <li><a href="insert_p.php">New Commission</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="sales.php">
                        <i class='bx bx-cart'></i>
                        <span class="link_name">Sales</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="sales.php">Sales</a></li>
                    <li><a href="insert_s.php">New Sale</a></li>
                </ul>
            </li>
        </ul>
    </div>

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