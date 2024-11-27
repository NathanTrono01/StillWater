<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Commission</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            box-sizing: border-box;
        }

        form {
            display: block;
            width: 600px;
            padding: 20px;
            background-color: #3f3c36;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin: 40px auto;
        }

        h2 {
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            color: #FFF;
            margin: 0;
        }

        label {
            font-size: 1.1em;
            color: #FFF;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #232223;
            border-radius: 8px;
            font-size: 16px;
            background-color: #FFEAC5;
            color: black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: border-color 0.3s ease;
        }

        input:focus,
        select:focus {
            border-color: rgb(211, 0, 0);
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
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
            background-color: #232223;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
            font-size: 1.1em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .back a:hover {
            background-color: #d2c9ac;
            box-shadow: 0 4px 8px #d2c9ac81;
            transition: background-color 0.3s ease;
            color: #000;
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

        .image-preview {
            text-align: block;
            margin-bottom: 20px;
        }

        .image-preview img {
            height: 100px;
            border: 2px dashed #FFEAC5;
            display: none;
        }
    </style>
</head>

<body>
    <?php
    include("nav.php");
    include("database.php");
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="back">
            <a href="insert_p.php">Back</a>
        </div>
        <h2>Client Info:</h2>
        <label for="ClientNumber">Select Existing Client/s:</label>
        <select id="ClientNumber" name="ClientNumber" required>
            <option value="">-- PLEASE SELECT A CLIENT --</option>
            <?php
            $client_sql = "SELECT ClientNumber, givenName, lastName FROM allclients";
            $client_query = mysqli_query($conn, $client_sql);
            while ($row = mysqli_fetch_assoc($client_query)) {
                echo "<option value='" . $row['ClientNumber'] . "'>" . $row['givenName'] . " " . $row['lastName'] . "</option>";
            }
            ?>
        </select>

        <hr>
        <h2>Item Info:</h2>

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
            <option value="Books">Books</option>
            <option value="Artwork">Artwork</option>
            <option value="Lighting">Lighting</option>
            <option value="Toys">Toys</option>
            <option value="Others">Others...</option>
        </select>

        <label for="condition_at_purchase">Condition: <span style="color: #B8001F">*</span></label>
        <select name="condition_at_purchase" id="condition_at_purchase" required>
            <option value="">-- SELECT ITEM CONDITION --</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Fair">Fair</option>
            <option value="Bad">Bad</option>
        </select>

        <label for="description">Description: <span style="color: #B8001F">*</span></label>
        <input type="text" name="description" required>

        <label for="asking_price">Asking Price: <span style="color: #B8001F">*</span></label>
        <input type="number" name="asking_price" required>

        <label for="critiqued_comments">Critiqued Comments: <span style="color: #B8001F">*</span></label>
        <input type="text" name="critiqued_comments" required>

        <label for="itemImage">Upload Image:</label>
        <input type="file" name="itemImage" id="itemImage" accept=".jpg, .jpeg, .png">

        <div class="image-preview">
            <img id="imagePreview" src="" alt="Image Preview">
        </div>

        <input type="submit" name="submit" value="Submit">
    </form>

    <script>
        document.getElementById('itemImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <?php
    if (isset($_POST['submit'])) {
        $clientNumber = mysqli_real_escape_string($conn, $_POST['ClientNumber']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $item_type = mysqli_real_escape_string($conn, $_POST['item_type']);
        $condition_at_purchase = mysqli_real_escape_string($conn, $_POST['condition_at_purchase']);
        $asking_price = mysqli_real_escape_string($conn, $_POST['asking_price']);
        $critiqued_comments = mysqli_real_escape_string($conn, $_POST['critiqued_comments']);

        $uploadDir = 'uploads/';

        $newFileName = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['itemImage'])) {
            $file = $_FILES['itemImage'];
            $fileName = basename($file['name']);
            $fileSize = $file['size'];
            $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

            // Define allowed file types and size limit (e.g., 2MB for images)
            $allowedTypes = ['jpg', 'jpeg', 'png'];
            $maxSize = 2 * 1024 * 1024; // 2 MB

            // Validate file type and size
            if (in_array($fileExt, $allowedTypes) && $fileSize <= $maxSize) {
                // Create unique file name and upload file
                $newFileName = uniqid() . '.' . $fileExt;
                $uploadFile = $uploadDir . $newFileName;

                if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                    echo "File uploaded successfully: $newFileName";
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "Invalid file type or size exceeded.";
            }
        }

        if (empty($clientNumber)) {
            echo "<script>alert('Please select a client.'); window.location='purchases.php';</script>";
            exit;
        }

        $insertItemSql = "INSERT INTO items (`condition`, item_type, asking_price, `description`, critiqued_comments, ClientNumber, image_path) 
                          VALUES ('$condition_at_purchase', '$item_type', '$asking_price', '$description', '$critiqued_comments', '$clientNumber', '$newFileName')";
        if (mysqli_query($conn, $insertItemSql)) {
            $itemNumber = mysqli_insert_id($conn);
            $currentTimeStamp = date('Y-m-d H:i:s');

            $insertPurchaseSql = "INSERT INTO purchases (ClientNumber, item_num, p_date, condition_at_purchase) 
                                  VALUES ('$clientNumber', '$itemNumber', '$currentTimeStamp', '$condition_at_purchase')";
            if (mysqli_query($conn, $insertPurchaseSql)) {
                echo "<script>alert('New record added successfully.'); window.location='purchases.php';</script>";
            } else {
                echo "<script>alert('Failed to add Purchase: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Failed to add Item: " . mysqli_error($conn) . "');</script>";
        }
    }
    ?>
</body>

</html>