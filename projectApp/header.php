<?php
require(__DIR__ . '/config/baseURL.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link rel="stylesheet" href="<?php echo baseurl.'/design/style.css';?>">
</head>
<body>
<div class="heading">
    <h1>Car Management Dashboard</h1>
</div>
<section id="main">
    <header>  
        <nav>
            <ul>
                <li><a href="AllCars.php">All cars</a></li>
                <li><a href="AvailableCars.php">Available cars</a></li>
                <li><a href="OccupiedCars.php">Occupied cars</a></li>
                <li><a href="rentalHistory.php">Rental History</a></li>
                <li><a href="AddCar.php">Add car</a></li>
                <li><a href="rentCar.php">rent car</a></li>
                <li><a href="returnCar.php">return car</a></li>
                <li><a href="<?php echo baseurl.'/logout.php' ; ?>">Logout [<?php echo $_SESSION['login_user']; ?>]</a></li>
            </ul>
        </nav>
    </header>
    <main>
