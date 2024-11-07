<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation with Dropdown</title>
    <style>
        nav {
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #1F2739;
            padding: 15px 0;
            z-index: 10;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        nav a {
            background-color: #185875;
            display: inline-block;
            padding: 10px 15px;
            margin: 0 5px;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        nav a:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.5s;
        }

        nav a:hover:before {
            left: 100%;
        }

        nav a:hover {
            background-color: #FB667A;
            box-shadow: 0 0 15px rgba(251, 102, 122, 0.5);
            transform: translateY(-3px);
        }

        nav .dropdown {
            display: inline-block;
            position: relative;
        }

        nav .dropdown-content {
            display: block;
            /* Always block for visibility control */
            position: absolute;
            background-color: #185875;
            min-width: 160px;
            z-index: 1;
            border-radius: 10px;
            opacity: 0;
            /* Start hidden */
            visibility: hidden;
            /* Prevent interaction */
            transition: opacity 0.3s ease, visibility 0.3s ease;
            /* Transition for opacity and visibility */
        }

        nav .dropdown-content a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        nav .dropdown-content a:hover {
            background-color: #FB667A;
        }

        nav .dropdown.show .dropdown-content {
            opacity: 1;
            /* Fade in */
            visibility: visible;
            /* Make it visible */
        }

        @media (max-width: 768px) {
            nav {
                padding: 10px 0;
            }

            nav a {
                padding: 8px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="dropdown" onmouseenter="showDropdown(this)" onmouseleave="hideDropdown(this)">
            <a href="c_list.php">Clients</a>
            <div class="dropdown-content">
                <a href="insert_c.php">Add Client</a>
            </div>
        </div>

        <div class="dropdown" onmouseenter="showDropdown(this)" onmouseleave="hideDropdown(this)">
            <a href="items.php" class="dropbtn">Items</a>
            <div class="dropdown-content">
                <a href="insert_i.php">Add Item</a>
                <hr>
                <a href="items.php">Available Items</a>
                <a href="sold_items.php">Sold Items</a>
            </div>
        </div>

        <div class="dropdown" onmouseenter="showDropdown(this)" onmouseleave="hideDropdown(this)">
            <a href="purchases.php">Store Purchases</a>
            <div class="dropdown-content">
                <a href="insert_p.php">New Purchase</a>
            </div>
        </div>
        <div class="dropdown" onmouseenter="showDropdown(this)" onmouseleave="hideDropdown(this)">
            <a href="sales.php">Sales</a>
            <div class="dropdown-content">
                <a href="insert_s.php">New Sale</a>
            </div>
        </div>
    </nav>

    <script>
        let dropdownTimeout;

        function showDropdown(dropdown) {
            dropdownTimeout = setTimeout(() => {
                dropdown.classList.add('show');
            }, 500); // Delay of 300ms before showing the dropdown
        }

        function hideDropdown(dropdown) {
            clearTimeout(dropdownTimeout);
            dropdown.classList.remove('show');
        }
    </script>

</body>

</html>