<?php
include("connection.php");
$id=$_GET['id'];

$delete="DELETE FROM tables WHERE table_id='$id'";
$data=mysqli_query($con, $delete);
if($data){
    echo "<script>alert('Table is deleted successfully')</script>";
    header('location:add_table.php');

}else{
    echo "<script>alert('Failed to delete the table')</script>";

}
?>