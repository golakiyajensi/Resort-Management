<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);

if (strlen($_SESSION['hbmsuid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_GET['viewid'])) {
        $viewid = intval($_GET['viewid']);
        $uid = $_SESSION['hbmsuid'];

        // Delete the booking record
        $sql = "DELETE FROM tbleventbooking WHERE ID = :viewid AND UserID = :uid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':viewid', $viewid, PDO::PARAM_INT);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->execute();

        if ($query) {
            // Redirect to the booking detail page with a success message
            // $_SESSION['msg'] = "Booking cancle successfully!";
            // header('location:my-booking.php');
            echo '<script>alert("Your room has been  cancle successfully.")</script>';
            echo "<script>window.location.href ='my-booking.php'</script>";
        } else {
            // Redirect to the booking detail page with an error message
            echo '<script>alert("Your room has been not be cancle")</script>';
            echo "<script>window.location.href ='my-booking.php'</script>";
        }
    }
}
?>
