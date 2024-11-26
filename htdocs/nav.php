<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation with Dropdown</title>
    <style>
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9eec8;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .logo-name {
            display: flex;
            align-items: center;
        }

        .logo-name img {
            max-width: 100px;
            max-height: 70px;
            margin-right: 10px;
        }

        .logo-name h1 {
            margin: 0;
            font-size: 24px;
        }

        .nav-links {
            display: flex;
            align-items: center;
        }

        nav a {
            background-color: #232223;
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
            background-color: #d2c9ac;
            color: #000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transform: translateY(-3px);
        }

        .dropdown {
            display: inline-block;
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #3f3c36;
            min-width: 200px;
            z-index: 5;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            right: 0;
            /* Align dropdown to the right */
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
        }

        .dropdown-content a:hover {
            background-color: #d2c9ac;
        }

        @media (max-width: 768px) {
            nav {
                padding: 10px 0;
                flex-direction: column;
            }

            .nav-links {
                flex-direction: column;
                align-items: flex-start;
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
        <div class="logo-name">
            <img src="uploads/Logo.jpg" alt="Logo">
            <h1>Stillwater Antique</h1>
        </div>
        <div class="nav-links">
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
                    <a href="item_gallery.php">Item Gallery</a>
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
        </div>
    </nav>
</body>

</html>