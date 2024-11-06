<?php
include("database.php");
include("nav.php");
?>
<style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #1F2739;
            color: #A7A1AE;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        form {
            width: 90%;
            max-width: 600px;
            /* Set a maximum width */
            padding: 20px;
            background-color: #323C50;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin: 0 auto;
            /* Center the form */
        }

        h1 {
            font-size: 2em;
            font-weight: bold;
            /* Bold the header */
            text-align: center;
            color: #4DC3FA;
            /* Light red for the form heading */
            margin-bottom: 20px;
            margin-top: 0;
        }

        h2 {
            margin-top: 15px;
            margin-bottom: 10px;
            font-size: 1.5em;
        }

        hr {
            margin: 15px 0;
        }

        form {
            width: 50%;
            padding: 20px;
            background-color: #323C50;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #A7A1AE;
        }

        input[type="text"],
        input[type="number"],
        input[type="datetime-local"],
        input[type="submit"],
        select[id="ClientNumber"],
        select[id="condition"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 2px solid #4DC3FA;
            /* Blue border */
            border-radius: 5px;
            background-color: #2C3446;
            /* Dark input background */
            color: #FFF;
            /* White text */
            box-sizing: border-box;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        input[type="text"],
        input[type="number"],
        select {
            background-color: #2C3446;
            /* Dark input background */
            color: #FFF;
            /* White text in input fields */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"] {
            margin-top: 15px;
            background-color: #FFF842;
            color: #403E10;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        input[type="submit"]:hover {
            background-color: #FB667A;
            color: #FFF;
        }

        a[href*="items.php"] {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #185875;
            /* Blue accent to match table headings */
            color: white;
            text-decoration: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        a[href*="items.php"]:hover {
            background-color: #FB667A;
            cursor: pointer;
            transition: background-color 0.1s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            /* Pink hover effect to match table details */
        }

        @media (max-width: 768px) {
            form {
                width: 95%;
                padding: 15px;
            }
        }
</style>
<br><br><br><br><br><br>
<form action="insert_i.php" method="post">
  <a href="items.php"><b>Back</b></a>
  <br><br>

  <label for="condition">Condition:</label>
  <select name="condition" id="condition">
    <option value="" align="center">-- SELECT ITEM'S CONDITION --</option>
    <option value="Excellent" align="center" style="color: Gold;">Excellent</option>
    <option value="Good" align="center" style="color: greenyellow;">Good</option>
    <option value="Fair" align="center" style="color: Orange;">Fair</option>
    <option value="Bad" align="center" style="color: red;">Bad</option>
  </select>

  <label for="item_type">Item Type: (eg. Furniture, Equipment, Jewelry, etc.)
  </label>
  <input type="text" id="item_type" name="item_type" required>

  <label for="asking_price">Asking Price:</label>
  <input type="number" id="asking_price" name="asking_price" required>

  <label for="description">Description:</label>
  <input type="text" id="description" name="description" required>

  <label for="critiqued_comments">Comments:</label>
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

  $sql = "SELECT * FROM items WHERE description = '$description'";
  $query = mysqli_query($conn, $sql);
  if ($query) {
    if (mysqli_num_rows($query) > 0) {
      echo "Item already exists";
    } else {
      $sql = "INSERT INTO items (`condition`, item_type, asking_price, description, critiqued_comments) 
                  VALUES ('$condition', '$item_type', '$asking_price', '$description', '$comments')";
      if (mysqli_query($conn, $sql)) {
        echo "<br>Item Added Successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
  } else {
    echo "Connection Error: " . mysqli_error($conn);
  }
}
?>