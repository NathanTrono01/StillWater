<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items Gallery</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .gallery-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 300px;
            text-align: center;
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            margin-top: 10px;
        }

        .gallery-item .details {
            padding: 15px;
        }

        .gallery-item .details h3 {
            margin: 10px 0;
            font-size: 1.2em;
            color: #333;
        }

        .gallery-item .details p {
            margin: 5px 0;
            color: #666;
        }

        .gallery-item .details .price {
            color: green;
            font-weight: bold;
        }

        .gallery-item .details .condition {
            font-weight: bold;
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
        ?>
            <div class="gallery-item">
                <img src="<?php echo $result['image_path']; ?>" alt="Item Image">
                <div class="details">
                    <h3><?php echo $result['description']; ?></h3>
                    <p>Owner: <?php echo !empty($result['givenName']) || !empty($result['lastName']) ? htmlspecialchars($result['givenName'] . ' ' . $result['lastName']) : 'Stillwater Antique'; ?></p>
                    <p class="price">₱ <?php echo $formatPrice; ?></p>
                    <p class="condition <?php echo $conditionClass; ?>"><?php echo $result['condition']; ?></p>
                    <p><?php echo $result['critiqued_comments']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>