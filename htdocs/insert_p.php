<?php
include("database.php");
include("nav.php")
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
        padding: 20px;
        background-color: #323C50;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        margin: 0 auto;
        display: flex;
        /* Use flexbox for centering */
        flex-direction: column;
        /* Align items vertically */
        align-items: center;
        /* Center items horizontally */
    }

    h1 {
        font-size: 2em;
        font-weight: bold;
        text-align: center;
        color: #4DC3FA;
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

    label {
        display: block;
        margin-bottom: 5px;
        color: #A7A1AE;
    }

    a[href*="existing_p.php"] {
        display: inline-block;
        padding: 15px 30px;
        /* Increased padding for larger buttons */
        margin: 10px 0;
        /* Adjusted margin for spacing */
        background-color: #185875;
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
        background-color: #72BF78;
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
        background-color: #185875;
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
        background-color: #72BF78;
        /* Hover color */
        cursor: pointer;
        transform: scale(1.05);
        /* Slightly enlarge on hover */
    }

    a[href*="purchases.php"] {
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

    a[href*="purchases.php"]:hover {
        background-color: #FB667A;
        cursor: pointer;
        transition: background-color 0.1s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        /* Pink hover effect to match table details */
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

    @media (max-width: 768px) {
        form {
            width: 95%;
            padding: 15px;
        }
    }
</style>
<br><br><br><br><br><br>
<form action="insert_c.php" method="post">
    <a href="purchases.php" align="left"><b>Back</b></a><br>

    <h2 align="center">Choose a Client Type</h2>
    <br><br>
    <a href="new_p.php" align="center">New</a><br><br>
    <a href="existing_p.php" align="center">Existing</a>
</form>