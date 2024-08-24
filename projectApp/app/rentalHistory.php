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
$sql = "SELECT VIN, License_number, days_of_rent, total_bill FROM Rental_History";
$result = $conn->query($sql);
?>

<content>
    <h2>Rental History</h2>
    <table>
        <thead>
        <tr>
            <th>VIN</th>
            <th>License_number</th>
            <th>days-of-rent</th>
            <th>total-bill</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["VIN"]. "</td><td>" . $row["License_number"]. "</td><td>" . $row["days_of_rent"]. "</td><td>". "$" . $row["total_bill"].".00". "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</content>

<?php include(__DIR__ . '/../footer.php'); ?>
