<?php
include ("connection.php");
$name = "";
$email = "";
$phone = "";
$password = "";
if (isset($_POST['singup'])) {

    $name = $_POST['customer_name'];
    $email = $_POST['customer_email'];
    $phone = $_POST['customer_phone'];
    $password = $_POST['customer_password'];

    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        echo "<script>alert('Name can only contain letters and spaces.')</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid Email Format')</script>";
    } elseif (!preg_match('/^(98|97)\d{8}$/', $phone)) {
        echo "<script>alert('Invalid phone number')</script>";
    } elseif (strlen($password) < 6) {
        echo "<script>alert('Password must be at least 6 characters long')</script>";
    } else {
        $select = "SELECT * from customer WHERE customer_email='$email'";
        $data = mysqli_query($con, $select);
        if (mysqli_num_rows($data) == 1) {
            echo "<script>alert('user with this email address is already exist.')</script>";
        } else {
            $insert_query = "INSERT INTO customer (customer_name, customer_email, customer_phone, customer_password)
             VALUES ('$name', '$email', '$phone', '$password')";
            $insert_data = mysqli_query($con, $insert_query);
            if ($insert_data) {
                echo "<script>alert('resistration successfull')</script>";
                header('location:login.php');
            } else {
                echo "<script>alert('failed to register')</script>" . mysqli_error($con);
            }
        }
    }

}
?>
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
        <h2>Registration Form</h2>
        <form action="" method="post">
            <div class="input-field">
                <input type="text" placeholder="Enter your name" name="customer_name" value="<?php echo $name ?>"
                    required>
                <input type="email" placeholder="Enter your email" name="customer_email" value="<?php echo $email ?>"
                    required>
                <input type="number" placeholder="Enter your phone number" name="customer_phone" value="<?php echo $phone ?>" required>
                <input type="password" placeholder="Enter your Password" name="customer_password" value="<?php echo $password ?>" required>
            </div>

            <button type="submit" name="singup">Sign Up</button>
            <div class="extra">
                Already have a account ?
                <a href="login.php">Login</a>
            </div>
        </form>
    </div>
</body>

</html>