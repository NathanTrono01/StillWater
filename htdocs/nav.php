<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation with Dropdown</title>
    <style>
        nav {
            text-align: center;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffe1c1;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        nav a {
            background-color: #6C4E31;
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
            background-color: #800000;
            box-shadow: 0 0 15px rgba(251, 102, 122, 0.5);
            transform: translateY(-3px);
        }

        .dropdown {
            display: inline-block;
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #603F26;
            min-width: 200px;
            /* Adjusted for better layout */
            z-index: 1;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            text-align: left;
            margin: 5px 5px;
            /* Add margin for spacing */
        }

        .dropdown-content a:hover {
            background-color: #982B1C;
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
<img src="uploads/test.png" alt="Logo" align="left" style="max-width: 400px;max-height: 78px;height: auto;display: block;margin-left: 3px auto;">
    <nav>
        <div class="dropdown">
            <a href="c_list.php">Clients</a>
            <div class="dropdown-content">
                <a href="insert_c.php">New Client</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="items.php">Inventory</a>
            <div class="dropdown-content">
                <a href="insert_i.php">New Item</a>
                <hr>
                <a href="items.php">Available Items</a>
                <a href="sold_items.php">Sold Items</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="purchases.php">Commissions</a>
            <div class="dropdown-content">
                <a href="insert_p.php">New Commission</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="sales.php">Sales</a>
            <div class="dropdown-content">
                <a href="insert_s.php">New Sale</a>
            </div>
        </div>
    </nav>

</body>

</html>