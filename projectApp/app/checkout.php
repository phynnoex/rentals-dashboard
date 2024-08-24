<?php 
    require(__DIR__ . '/../config/config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $vin = $_POST['vin'];
        $license = $_POST['drivingLicense'];
        $numberOfDays = $_POST['numberOfDays'];
        $bill = $_POST['Bill'];
        $totalBill = $bill * $numberOfDays;

        //update the availablity
        $stmz = $conn->prepare("UPDATE CAR_DETAILS SET is_available = 1 WHERE VIN = ? ");
        $stmz -> bind_param("s",$vin);
        $stmz -> execute();
        $stmz->close();

        //delete row from occupied cars db
        $stmr = $conn->prepare("DELETE FROM occupied_cars WHERE VIN = ? ");
        $stmr -> bind_param("s",$vin);
        if ($stmr -> execute()) {
           echo "record removed from occupied_Cars";
        }else {
            echo "Error: " . $stmt -> error;
        }
        
        $stmr->close();


        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO Rental_History (VIN, License_number, Days_of_rent, Total_Bill) VALUES (?, ?, ? , ?)");
        $stmt->bind_param("ssis", $vin, $license, $numberOfDays, $totalBill);

        // Execute the query
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
    }
?>

<form action="rentalHistory.php" method="post">
    <button type="submit">Go to rental History</button>
</form>



