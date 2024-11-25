<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* General Form Layout */
        form {
            display: block;
            width: 600px;
            padding: 30px;
            background-color: #603F26;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin: 40px auto;
            /* Center form on page */
            box-sizing: border-box;
        }

        /* Form Heading */
        h2 {
            font-size: 2em;
            font-weight: bold;
            text-align: center;
            color: #FB667A;
            margin: 0 0 20px;
        }

        /* Form Label Styling */
        label {
            font-size: 1.1em;
            color: #FFDBB5;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        /* Input Fields */
        input[type="text"],
        input[type="number"],
        input[type="date"],
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

        /* Focus Effect on Input Fields */
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #FB667A;
            outline: none;
        }

        /* Submit Button Styling */
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

        /* Back Button Styling */
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

        /* Responsive Design */
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
</head>
<?php
include 'database.php';
include 'nav.php';

$itemNum = $_GET['item_num'];

$sql = "SELECT * FROM items WHERE item_num = '$itemNum'";
$query = mysqli_query($conn, $sql);
$itemData = mysqli_fetch_assoc($query);

if (!$itemData) {
    echo "<script>alert('No item found with Item Number $itemNum'); window.location='items.php';</script>";
    exit();
}
?>
</head>

<body>

    <form action="update_i.php?item_num=<?php echo $itemNum; ?>" method="post" enctype="multipart/form-data">

        <div class="back">
            <a href="items.php">Back</a>
        </div>
        <?php if (!empty($itemData['image_path'])): ?>
            <div class="image-preview">
                <img src="uploads/<?php echo $itemData['image_path']; ?>" alt="Item Image" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">
            </div>
        <?php endif; ?>

        <br>
        <label for="itemImage">Upload Image:</label>
        <input type="file" name="itemImage" id="itemImage" accept=".jpg, .jpeg, .png">

        <br><br>

        <label for="condition">Condition:<span style="color: #B8001F"> *</span></label>
        <select name="condition" id="condition">
            <option value="<?php echo htmlspecialchars($itemData['condition']); ?>">Currently: <?php echo htmlspecialchars($itemData['condition']); ?></option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Fair">Fair</option>
            <option value="Bad">Bad</option>
        </select>

        <label for="item_type">Item Type: <span style="color: #B8001F">*</span></label>
        <select name="item_type" id="item_type">
            <option value="<?php echo htmlspecialchars($itemData['item_type']); ?>">Currently: <?php echo htmlspecialchars($itemData['item_type']); ?></option>
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
        <input type="number" id="asking_price" name="asking_price" value="<?php echo htmlspecialchars($itemData['asking_price']); ?>">

        <label for="description">Description: <span style="color: #B8001F">*</span></label>
        <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($itemData['description']); ?>">

        <label for="critiqued_comments">Comments: <span style="color: #B8001F">*</span></label>
        <input type="text" id="critiqued_comments" name="critiqued_comments" value="<?php echo htmlspecialchars($itemData['critiqued_comments']); ?>">

        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $uploadDir = 'uploads/';

    // Check if image is uploaded
    if (isset($_FILES['itemImage']) && $_FILES['itemImage']['error'] == 0) {
        $file = $_FILES['itemImage'];
        $fileName = basename($file['name']);
        $fileSize = $file['size'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Allowed file types and size limit
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        $maxSize = 2 * 1024 * 1024; // 2 MB

        // Validate file type and size
        if (in_array($fileExt, $allowedTypes) && $fileSize <= $maxSize) {
            $newFileName = uniqid('item_', true) . '.' . $fileExt;
            $uploadFile = $uploadDir . $newFileName;

            // Move the uploaded file
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                // Image uploaded successfully, store path in the database
                $imagePath = $newFileName;
            } else {

                echo "Error uploading the file.";
                exit();
            }
        } else {
            echo "Invalid file type or size exceeded.";
            exit();
        }
    } else {
        // If no image is uploaded, use the old image
        $imagePath = $itemData['image_path'];
    }

    // Get other form data
    $condition = trim($_POST['condition']);
    $item_type = trim($_POST['item_type']);
    $asking_price = trim($_POST['asking_price']);
    $description = trim($_POST['description']);
    $comments = trim($_POST['critiqued_comments']);

    // Update the database with new data
    $sql = "UPDATE items SET 
            condition = '$condition', 
            item_type = '$item_type', 
            asking_price = '$asking_price', 
            description = '$description', 
            critiqued_comments = '$comments', 
            image_path = '$imagePath' 
            WHERE item_num = '$itemNum'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Item\'s Information updated successfully!');
            window.location.reload(); // This reloads the page
          </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>