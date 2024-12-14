<?php
include ("connection.php");
session_start();

if (isset($_SESSION['customer_id'])) {
    //echo "isset";
    $customer_id = $_SESSION['customer_id'];
    $query = "SELECT * FROM customer WHERE customer_id='$customer_id'";
    $data = mysqli_query($con, $query);
    if (mysqli_num_rows($data) == 1) {
        $customer_data = mysqli_fetch_assoc($data);
        //echo $customer_data['customer_name'];
    }
} else {
    header("location:login.php");

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login </title>
    <link rel="stylesheet" href="css/customer1.css">
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <!-- <div class="background_img">
        <img src="image/img-1.jpg">
    </div> -->
    
    <div class="main_container"
        style="background-image:url('image/img-2.jpg');background-repeat: no-repeat;background-position: center;background-size: cover;height: 100vh;">

        <div class="nav">
            <h1>Reservation-X</h1>
            <div class="menu">
                <a href="#" style="color: rgb(225, 173, 62);">Home</a>
                <a href="about.php">About Us</a>
                <a href="reservation.php">Reservation</a>
            </div>
            <div class="btn_container">
                <div class="profile_btn">
                    <div class="letter">
                        <?php echo substr($customer_data['customer_name'], 0, 1); ?>
                    </div>
                    <p>
                        <?php echo $customer_data['customer_name']; ?>
                    </p>
                </div>

            </div>
        </div>

        <div class="hero">
            <p>Resturant Booking Website</p>
            <h1>Book Your Table Here</h1>
            <a href="book.php"><button class="book_btn">Book Your Table</button></a>
        </div>
        <button class="logout_btn"><a href="logout.php">Logout</a></button>

    </div>
</body>

</html>