<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
    exit;
}
include(__DIR__ . '/../header.php');

require(__DIR__ . '/../config/config.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT ID, VIN, MAKE,MODEL, YEAR, RATE_OF_RENT_PER_DAY  FROM CAR_DETAILS WHERE IS_AVAILABLE = 1";
$result = $conn->query($sql);
?>

<content>
    <h2>Available Cars</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>VIN</th>
            <th>Make</th>
            <th>Model</th>
            <th>year</th>
            <th>rate-of-rent</th>
            
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["VIN"]. "</td><td>" . $row["MAKE"]. "</td><td>" . $row["MODEL"]. "</td><td>" . $row["YEAR"]. "</td><td>" . $row["RATE_OF_RENT_PER_DAY"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</content>

<?php include(__DIR__ . '/../footer.php'); ?>
