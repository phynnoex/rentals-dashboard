<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
    exit;
}
include(__DIR__ . '/../header.php');

require(__DIR__ . '/../config/config.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $driversLicense = $_POST['driverLicense'];
    $vin = $_POST['vin'];
    $dateOfRent = $_POST['dateOfRent'];
    $rateOfRent = null; 
    
    $stmr = $conn -> prepare("SELECT VIN, rate_of_rent_per_day FROM CAR_DETAILS WHERE VIN = ? ");
    $stmr -> bind_param("s",$vin);
    $stmr -> execute();
    $result = $stmr->get_result();

    // Get the form data
    if ($result && $result -> num_rows > 0) {
        echo "result found, car with VIN: " . $vin . " is now occupied <br>";
        while($row = $result->fetch_assoc()) {
            $rateOfRent = $row["rate_of_rent_per_day"];
        }
    } else {
        echo "result not found";
    }

    // Prepare and bind
    if ($result && $result -> num_rows > 0) {
        $stmz = $conn->prepare("UPDATE CAR_DETAILS SET is_available = 0 WHERE VIN = ? ");
        $stmz -> bind_param("s",$vin);
        $stmz -> execute();
        $stmz->close();
    

        $stmt = $conn->prepare("INSERT INTO OCCUPIED_CARS (VIN, License_Number, rate_of_rent_per_day, date_of_rent) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $vin, $driversLicense, $rateOfRent, $dateOfRent );

            // Execute the query
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
    }

    // Close the statement and connection
    
}

$conn->close();
?>

<content>
    <h2>Insert Data</h2>
    <div class="form-container">
        <form action="rentCar.php" method="post">
        <input type="text" id="vin" name="vin" placeholder="vin" required><br><br>
            <input type="text" id="driverLicense" name="driverLicense" placeholder="Drivers License" required><br><br>
            <input type="date" id="dateOfRent" name="dateOfRent" placeholder="Email" required><br><br>
            <input type="submit" value="rent">
        </form>
    </div>
</content>

<?php include(__DIR__ . '/../footer.php'); ?>
