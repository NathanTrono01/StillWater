<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items Gallery</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .gallery-wrapper::-webkit-scrollbar {
            width: 5px;
        }

        .gallery-wrapper::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .gallery-wrapper:hover::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.5);
        }

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .contain {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 20px);
            margin: 10px;
        }

        .gallery-wrapper {
            background-color: #F7EED3;
            border: 3px solid black;
            padding: 10px;
            border-radius: 10px;
            width: calc(100% - 50px);
            height: calc(100vh - 50px);
            overflow-y: auto;
            position: relative;
        }

        .gallery-header {
            position: sticky;
            top: 0;
            padding: 10px;
            text-align: center;
            font-size: 2em;
            font-weight: bold;
            border-bottom: 1px solid black;
            z-index: 1;
            color: black;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 10px;
            justify-content: center;
        }

        .gallery-item {
            padding: 15px;
            background-color: #FFF8E8;
            border: 1px solid #000;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 300px;
            text-align: center;
            transition: transform 0.2s;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: auto;
        }

        .gallery-item .details {
            padding: 8px;
        }

        .gallery-item .details h3 {
            margin: 10px 0;
            font-size: 1.2em;
            color: #232223;
        }

        .gallery-item .details p {
            margin: 3px 0;
            color: #232223;
            font-size: 1em;
        }

        .gallery-item .details .price {
            color: green;
            font-weight: bold;
            font-size: 1.1em;
        }

        .gallery-item .details .condition {
            font-weight: bold;
            font-size: 1.1em;
        }

        .condition-excellent {
            color: gold;
        }

        .condition-good {
            color: greenyellow;
        }

        .condition-fair {
            color: orange;
        }

        .condition-bad {
            color: red;
        }

        hr {
            border: 1px solid black;
        }

        @media (max-width: 768px) {
            .gallery-item {
                max-width: 200px;
            }

            .gallery-header {
                font-size: 1.5em;
            }

            .gallery-item .details h3 {
                font-size: 1.1em;
            }

            .gallery-item .details p {
                font-size: 0.9em;
            }
        }

        @media (max-width: 480px) {
            .gallery-item {
                max-width: 150px;
            }

            .gallery-header {
                font-size: 1.2em;
            }

            .gallery-item .details h3 {
                font-size: 1em;
            }

            .gallery-item .details p {
                font-size: 0.8em;
            }

            .gallery-item .details .price,
            .gallery-item .details .condition {
                font-size: 0.9em;
            }
        }
    </style>
    <?php
    include("nav.php");
    include("database.php");

    $sql = "SELECT 
        i.item_num,
        i.description,
        i.asking_price,
        i.critiqued_comments,
        i.condition,
        i.item_type,
        i.ClientNumber,
        c.givenName,
        c.lastName,
        i.image_path
    FROM items i
    LEFT JOIN allclients c ON i.ClientNumber = c.ClientNumber
    WHERE i.is_sold = 0 ORDER BY i.item_num DESC;";

    $query = mysqli_query($conn, $sql);

    if (!$query) {
        echo "Error: " . mysqli_error($conn);
    }
    ?>
</head>

<body>
    <div class="contain">
        <div class="gallery-wrapper">

            <div class="gallery-header">Item Gallery</div>
            <br>
            <div class="gallery">
                <?php while ($result = mysqli_fetch_assoc($query)) {
                    $formatPrice = number_format($result['asking_price'], 2);
                    $conditionClass = '';
                    switch (strtolower($result['condition'])) {
                        case 'excellent':
                            $conditionClass = 'condition-excellent';
                            break;
                        case 'good':
                            $conditionClass = 'condition-good';
                            break;
                        case 'fair':
                            $conditionClass = 'condition-fair';
                            break;
                        case 'bad':
                            $conditionClass = 'condition-bad';
                            break;
                    }
                    // Construct the full image path
                    $imagePath = !empty($result['image_path']) ? 'uploads/' . htmlspecialchars($result['image_path']) : 'uploads/na.png';
                ?>
                    <div class="gallery-item">
                        <img src="<?php echo $imagePath; ?>" alt="Item Image">
                        <div class="details">
                            <p><b>Item Owner:</b></p>
                            <p><?php echo !empty($result['givenName']) || !empty($result['lastName']) ? htmlspecialchars($result['givenName'] . ' ' . $result['lastName']) : 'Stillwater Antique'; ?></p>
                            <hr>
                            <h3><?php echo htmlspecialchars($result['description']); ?></h3>
                            <p class="price">₱ <?php echo $formatPrice; ?></p>
                            <p class="condition <?php echo $conditionClass; ?>"><?php echo htmlspecialchars($result['condition']); ?></p>
                            <p><?php echo htmlspecialchars($result['critiqued_comments']); ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>