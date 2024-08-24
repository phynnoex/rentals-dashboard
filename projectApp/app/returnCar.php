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

$result = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $license = $_POST['drivers_license'];

    $stmt = $conn -> prepare("SELECT License_number, VIN, rate_of_rent_per_day  FROM OCCUPIED_CARS WHERE License_number = ?");
    $stmt -> bind_param("s",$license);
    $stmt -> execute();
    $result = $stmt->get_result();

}
?>

<content>
    <h2>Add Car</h2>
    <div class="form-container">
        <form action="returnCar.php" method="post">
            <input type="text" id="drivers_license" name="drivers_license" placeholder="driving-license"><br><br>
            <input type="submit" value="search">
        </form>
        <div>
                <?php 
                    if ($result && $result -> num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<h3>" . $row["License_number"] . " was found" . "</h3>";
                            echo '<form action="checkout.php" method="post">
                        <label for="vin"> VIN </label>
                        <input type="text" id="vin" name="vin" value="' . $row['VIN'] . '" readonly><br>
                        <label for="drivingLicense"> Driving License </label>
                        <input type="text" id="drivingLicense" name="drivingLicense" value="' . $row['License_number'] . '" readonly><br>
                        <label for="numberOfDays">Number of days</label>
                        <input type="text" id="numberOfDays" name="numberOfDays" required><br>
                        <label for="Bill"> Driving License </label>
                        <input type="hidden" id="Bill" name="Bill" value="' . $row['rate_of_rent_per_day'] . '" readonly><br>
                        <input type="submit" value="Checkout">
                      </form>';
                            
                        }
                    }else if($result != null){
                        echo "result not found";
                    }
                ?>
            </div>
    </div>
</content>


<?php include(__DIR__ . '/../footer.php'); ?>
