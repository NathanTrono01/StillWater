<link rel="stylesheet" href="css/style.css">
<style>
    form {
        display: block;
        grid-template-columns: 1fr;
        width: 400px;
        padding: 20px;
        background-color: #603F26;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        margin: 40px auto 0;
        text-align: center; /* Align content to the center */
        /* Center form on page */
    }

    hr {
        margin: 15px 0;
    }

    h2 {
        font-size: 2.1em;
        color: #FFDBB5;
        font-weight: bold;
        margin-bottom: 8px;
        font-family: Arial, Helvetica, sans-serif;
    }

    a[href*="existing_p.php"] {
        display: inline-block;
        padding: 15px 30px;
        /* Increased padding for larger buttons */
        margin: 10px 0;
        /* Adjusted margin for spacing */
        background-color: #6C4E31;
        /* Original background color */
        color: white;
        text-decoration: none;
        border-radius: 10px;
        /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        font-size: 18px;
        /* Increased font size */
        text-align: center;
        /* Center text in the button */
        transition: background-color 0.3s ease, transform 0.2s ease;
        /* Smooth transition */
        width: 100%;
        /* Make buttons full width */
        max-width: 300px;
        /* Set a maximum width for buttons */
    }

    a[href*="existing_p.php"]:hover {
        background-color: #982B1C;
        /* Hover color */
        cursor: pointer;
        transform: scale(1.05);
        /* Slightly enlarge on hover */
    }

    a[href*="new_p.php"] {
        display: inline-block;
        padding: 15px 30px;
        /* Increased padding for larger buttons */
        margin: 10px 0;
        /* Adjusted margin for spacing */
        background-color: #6C4E31;
        /* Original background color */
        color: white;
        text-decoration: none;
        border-radius: 10px;
        /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        font-size: 18px;
        /* Increased font size */
        text-align: center;
        /* Center text in the button */
        transition: background-color 0.3s ease, transform 0.2s ease;
        /* Smooth transition */
        width: 100%;
        /* Make buttons full width */
        max-width: 300px;
        /* Set a maximum width for buttons */
    }

    a[href*="new_p.php"]:hover {
        background-color: #982B1C;
        /* Hover color */
        cursor: pointer;
        transform: scale(1.05);
        /* Slightly enlarge on hover */
    }

    .back a[href*="purchases.php"] {
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

    .back a[href*="purchases.php"]:hover {
        background-color: #FB667A;
        cursor: pointer;
    }

    @media (max-width: 600px) {
        form {
            width: 95%;
        }

        label,
        select {
            font-size: 1em;
        }

        h2 {
            font-size: 1.5em;
        }
    }
</style>
<?php
include("database.php");
include("nav.php")
?>
<form action="insert_c.php" method="post">
    <div class="back">
        <a href="purchases.php" align="left"><b>Back</b></a><br>

        <h2 align="center">Choose a Client Type</h2>
        <br><br>
        <a href="new_p.php">New</a><br><br>
        <a href="existing_p.php">Existing</a>
    </div>
</form>