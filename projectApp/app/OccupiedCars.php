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
$sql = "SELECT VIN, LICENSE_NUMBER, RATE_OF_RENT_PER_DAY, DATE_OF_RENT FROM OCCUPIED_CARS";
$result = $conn->query($sql);
?>

<content>
    <h2>Occupied Cars</h2>
    <table>
        <thead>
        <tr>
            <th>VIN</th>
            <th>License Number</th>
            <th>rate-of-rent</th>
            <th>date-of-rent</th>            
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["VIN"]. "</td><td>" . $row["LICENSE_NUMBER"]. "</td><td>" . $row["RATE_OF_RENT_PER_DAY"]. "</td><td>" . $row["DATE_OF_RENT"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</content>

<?php include(__DIR__ . '/../footer.php'); ?>
