<?php
require("connection.php");
$ID=$_GET['id'];

$over="UPDATE reservation SET status='over' WHERE booking_id='$ID'";
$data=mysqli_query($con, $over);
if($data){
    header('location:admin_dashboard.php');
}else{
    echo "<script>alert('failed')</script>";
}
?>