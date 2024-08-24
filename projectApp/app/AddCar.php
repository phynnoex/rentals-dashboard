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

// -----------

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $vin = $_POST['VIN'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $rateOfRent = $_POST['rateOfRent'];


    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO CAR_DETAILS (VIN,MAKE,MODEL,YEAR,RATE_OF_RENT_PER_DAY) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $vin, $make, $model, $year, $rateOfRent);

    // Execute the query
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>

<content>
    <h2>Add Car</h2>
    <div class="form-container">
        <form action="AddCar.php" method="post">
            <input type="text" id="VIN" name="VIN" placeholder="VIN" required><br><br>
            <input type="text" id="make" name="make" placeholder="Make" required><br><br>
            <input type="text" id="model" name="model" placeholder="Model" required><br><br>
            <input type="text" id="year" name="year" placeholder="Year" required><br><br>
            <input type="text" id="rateOfRent" name="rateOfRent" placeholder="rate of rent per day" required><br><br>
            <input type="submit" value="Insert">
        </form>
    </div>
</content>

<?php include(__DIR__ . '/../footer.php'); ?>
