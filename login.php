<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <linkrel="stylesheet"href="admin.css">
        <title>Admin Login </title>
        <link rel="stylesheet" href="css/login1.css">
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
    <div class="login-form">
        <h2>Login Form</h2>
        <form action="" method="post">
            <div class="input-field">
                <!-- <i class="fas fa-user"></i> -->
                <input type="text" placeholder="Enter your email" name="email" required>

                <!-- <i class="fas fa-user"></i> -->
                <input type="password" placeholder="Enter your Password" name="password" required>
            </div>

            <button type="submit" name="SignIn">Sign In</button>
            <div class="extra">
                Don't have a account ?
                <a href="create_account.php">Create account</a>
            </div>
        </form>

</body>

</html>

<?php
include ("connection.php");
session_start();
if (isset($_POST['SignIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //admin login
    $query = "SELECT * FROM admin WHERE admin_name='$email' AND admin_password='$password'";
    $result_admin = mysqli_query($con, $query);

    //customer login
    $query = "SELECT * FROM customer WHERE customer_email='$email' AND customer_password='$password'";
    $result_customer = mysqli_query($con, $query);

    if (mysqli_num_rows($result_admin) == 1) {
        $admin = mysqli_fetch_assoc($result_admin);
        $_SESSION['admin_id'] = $admin['admin_id'];
        //echo "login successfull";
        header("location:admin_dashboard.php");
        exit();
    } else if (mysqli_num_rows($result_customer) == 1) {
        $customer = mysqli_fetch_assoc($result_customer);
        $_SESSION['customer_id'] = $customer['customer_id'];
        //echo "login successfull";
        header("location:customer_dashboard.php");
        exit();
    } else {
        echo "<script>alert('incorrect password or email')</script>";
    }

}

?>