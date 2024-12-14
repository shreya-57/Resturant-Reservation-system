<?php

// $con = new mysqli('localhost', 'melishma', 'Melishma@321#', 'melishma');

// if (mysqli_connect_error()) {
//     echo "Cannot Connect";
// }

$con = new mysqli('localhost', 'root', '', 'resturantreservationsystem');
if($con){
    //echo "connection successfull";
}else{
    echo "failed to connect";
}

?>