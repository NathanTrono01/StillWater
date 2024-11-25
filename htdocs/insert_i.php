<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <style>
        form {
            display: block;
            width: 600px;
            padding: 30px;
            background-color: #603F26;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin: 40px auto;
            box-sizing: border-box;
        }

        h2 {
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            color: #FB667A;
            margin: 0 0 20px;
        }

        label {
            font-size: 1.1em;
            color: #FFDBB5;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #CD5C08;
            border-radius: 8px;
            font-size: 16px;
            background-color: #FFEAC5;
            color: black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #FB667A;
            outline: none;
        }

        input[type="submit"] {
            background-color: #982B1C;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
            padding: 12px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #800000;
            color: #FFF;
        }

        .back a {
            text-align: left;
            display: inline-block;
            padding: 10px 20px;
            background-color: #6C4E31;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
            font-size: 1.1em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .back a:hover {
            background-color: #FB667A;
            cursor: pointer;
        }

        @media (max-width: 600px) {
            form {
                width: 95%;
            }

            label,
            input,
            select {
                font-size: 1em;
            }

            input[type="submit"] {
                padding: 15px;
                font-size: 1.2em;
            }

            h2 {
                font-size: 1.5em;
            }
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include("database.php");
    include("nav.php");
    ?>
    <form action="" method="post">
        <div class="back">
            <a href="items.php"><b>Back</b></a>
        </div>

        <label for="condition">Condition:<span style="color: #B8001F"> *</span></label>
        <select name="condition" id="condition" required>
            <option value="">-- SELECT ITEM'S CONDITION --</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Fair">Fair</option>
            <option value="Bad">Bad</option>
        </select>

        <label for="item_type">Item Type: <span style="color: #B8001F">*</span></label>
        <select name="item_type" id="item_type" required>
            <option value="">-- SELECT ITEM TYPE --</option>
            <option value="Furniture">Furniture</option>
            <option value="Instruments">Instruments</option>
            <option value="Tools">Tools</option>
            <option value="Jewelry">Jewelry</option>
            <option value="Home Decor">Home Decor</option>
            <option value="Collectibles">Collectibles</option>
            <option value="Glassware and Ceramics">Glassware and Ceramics</option>
            <option value="Textiles">Textiles</option>
            <option value="Artwork">Artwork</option>
            <option value="Lighting">Lighting</option>
            <option value="Books">Books</option>
            <option value="Toys">Toys</option>
            <option value="Others">Others...</option>
        </select>

        <label for="asking_price">Asking Price: <span style="color: #B8001F">*</span></label>
        <input type="number" id="asking_price" name="asking_price" min="1" required>

        <label for="description">Description: <span style="color: #B8001F">*</span></label>
        <input type="text" id="description" name="description" required>

        <label for="critiqued_comments">Comments: <span style="color: #B8001F">*</span></label>
        <input type="text" id="critiqued_comments" name="critiqued_comments" required>

        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $condition = trim($_POST['condition']);
        $item_type = trim($_POST['item_type']);
        $asking_price = trim($_POST['asking_price']);
        $description = trim($_POST['description']);
        $comments = trim($_POST['critiqued_comments']);

        if ($asking_price <= 0) {
            echo "<script>alert('Please enter a valid asking price.'); window.location='add_item.php';</script>";
            exit;
        }

        $sql = "SELECT * FROM items WHERE description = '$description'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            echo "<script>alert('Use different description, Item already exists.'); window.location='items.php';</script>";
        } else {
            $sql = "INSERT INTO items (`condition`, item_type, asking_price, description, critiqued_comments) 
                    VALUES ('$condition', '$item_type', '$asking_price', '$description', '$comments')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Item Added Successfully'); window.location='items.php';</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    ?>
</body>

</html>