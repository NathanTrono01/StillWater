<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        form {
            display: block;
            width: 600px;
            padding: 30px;
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
            box-sizing: border-box;
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
            margin-bottom: 20px;
        }

        .back a:hover {
            background-color: #d2c9ac;
            box-shadow: 0 4px 8px #d2c9ac81;
            transition: background-color 0.3s ease;
            color: #000;
            cursor: pointer;
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
</head>

<?php
include('database.php');
include('nav.php');

$itemNum = $_GET['item_num'];

$sql = "SELECT * FROM items WHERE item_num = '$itemNum'";
$query = mysqli_query($conn, $sql);
$itemData = mysqli_fetch_assoc($query);

if (!$itemData) {
    echo "<script>alert('No item found with Item Number $itemNum'); window.location='items.php';</script>";
    exit();
}
?>

<body>
    <form action="update_i.php?item_num=<?php echo $itemNum; ?>" method="post" enctype="multipart/form-data">
        <div class="back">
            <a href="items.php">Back</a>
        </div>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo $itemData['description']; ?>">

        <label for="condition">Condition:</label>
        <select name="condition" id="condition">
            <option value="<?php echo $itemData['condition']; ?>">Currently: <?php echo $itemData['condition']; ?></option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Fair">Fair</option>
            <option value="Bad">Bad</option>
        </select>

        <label for="item_type">Item Type:</label>
        <select name="item_type" id="item_type">
            <option value="<?php echo $itemData['item_type']; ?>">Currently: <?php echo $itemData['item_type']; ?></option>
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

        <label for="asking_price">Asking Price:</label>
        <input type="number" id="asking_price" name="asking_price" value="<?php echo $itemData['asking_price']; ?>">

        <label for="critiqued_comments">Comments:</label>
        <input type="text" id="critiqued_comments" name="critiqued_comments" value="<?php echo $itemData['critiqued_comments']; ?>">

        <label for="itemImage">Upload Image:</label>
        <input type="file" name="itemImage" id="itemImage" accept=".jpg, .jpeg, .png">

        <div class="image-preview">
            <img id="imagePreview" src="uploads/<?php echo $itemData['image_path']; ?>" alt="Item Image">
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
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $condition = $_POST['condition'];
    $item_type = $_POST['item_type'];
    $asking_price = $_POST['asking_price'];
    $description = $_POST['description'];
    $comments = $_POST['critiqued_comments'];

    $uploadDir = 'uploads/';
    $newFileName = ''; // Initialize new file name

    // Retrieve the existing image path
    $existingImagePath = $itemData['image_path'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['itemImage']) && $_FILES['itemImage']['error'] == UPLOAD_ERR_OK) {
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
    } else {
        // If no new file was uploaded, keep the existing image path
        $newFileName = $existingImagePath;
    }

    // Update SQL query to use the correct image path
    $sql = "UPDATE items SET 
            `condition` = '$condition', 
            item_type = '$item_type', 
            asking_price = '$asking_price', 
            `description` = '$description', 
            critiqued_comments = '$comments', 
            image_path = '$newFileName' 
            WHERE item_num = '$itemNum'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Item updated successfully!'); window.location='items.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>