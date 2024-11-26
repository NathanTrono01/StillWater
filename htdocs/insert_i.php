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
            background-color: #3f3c36;
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
            box-sizing: border-box;
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
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include("database.php");
    include("nav.php");
    ?>
    <form action="" method="post" enctype="multipart/form-data">
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
        $condition = trim($_POST['condition']);
        $item_type = trim($_POST['item_type']);
        $asking_price = trim($_POST['asking_price']);
        $description = trim($_POST['description']);
        $comments = trim($_POST['critiqued_comments']);

        $imagePath = '';
        if (!empty($_FILES['itemImage']['name'])) {
            $uploadDir = 'uploads/';
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
                    $imagePath = $newFileName; // Update image path with the new file name
                    echo "File uploaded successfully: $newFileName";
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "Invalid file type or size exceeded.";
            }
        }

        $sql = "SELECT * FROM items WHERE description = '$description'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            echo "<script>alert('Use different description, Item already exists.'); window.location='items.php';</script>";
        } else {
            $sql = "INSERT INTO items (`condition`, item_type, asking_price, `description`, critiqued_comments, image_path) 
                VALUES ('$condition', '$item_type', '$asking_price', '$description', '$comments', '$imagePath')";
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