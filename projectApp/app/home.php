<?php
session_start();
if (!isset($_SESSION['login_user'])) {
    header("location: ../login.php");
    exit;
}
include(__DIR__ . '/../header.php');
?>
<content>
    <h2>Welcome <?php echo $_SESSION['login_user']; ?></h2>
    <h5>Your Session ID: <?php echo session_id(); ?></h5>
</content>


<?php include(__DIR__ . '/../footer.php'); ?>
