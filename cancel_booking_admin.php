<?php
include ("connection.php");

$id = $_GET['id'];
$canel = "DELETE FROM reservation WHERE booking_id='$id'";
$canel_data = mysqli_query($con, $canel);
if ($canel) {
    echo "<script>alert('Your booked table is canceled successfully')</script>";
    header("location:admin_dashboard.php");
} else {
    echo "<script>alert('Failed to cancel the booking')</script>";

}
?>