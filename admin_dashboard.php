<?php
include ("connection.php");
session_start();
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $query = "SELECT * FROM admin WHERE admin_id='$admin_id'";
    $data = mysqli_query($con, $query);
    if (mysqli_num_rows($data) == 1) {
        $admin_data = mysqli_fetch_assoc($data);
        //echo $admin_data['admin_name'];
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
    <linkrel="stylesheet"href="admin.css">
        <title>Admin Login </title>
        <link rel="stylesheet" href="css/admin1.css">
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
    <div class="main_container"
        style="background-image:url('image/admin.jpg');background-repeat: no-repeat;background-position: center;background-size: cover;height: 100vh;">

        <div class="nav">
            <h1>Admin Panel</h1>
            <div class="menu">
                <a href="#">Dashboard</a>
                <a href="add_table.php">Add Table</a>
                <a href="reservation_record.php">Reservation</a>
                <a href="customer_record.php">Customers</a>
            </div>
            <dic class="logout_btn">
                <button><a href="logout.php">Logout</a></button>
            </dic>

        </div>

        <div class="reservation_container">
            <h2>Booking Details</h2>
            <div class="table_container">
                <table>
                    <thead>
                        <th>Customer Name</th>
                        <th>Customer phone</th>
                        <th>Customer Email</th>
                        <th>Table</th>
                        <th>Reservation Date</th>
                        <th>Reservation Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $currentDate = date('Y/M/d l');

                        $select = "SELECT * 
                    FROM reservation as r
                    INNER JOIN customer as c ON r.customer_id=c.customer_id
                    INNER JOIN tables as t ON r.t_id=t.table_id
                    WHERE date='$currentDate' AND status='booked'
                    ORDER BY date";
                        $data = mysqli_query($con, $select);
                        if (mysqli_num_rows($data) > 0) {
                            while ($row_book = mysqli_fetch_assoc($data)) {
                                //echo $row_book['t_id'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row_book['customer_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_book['customer_phone'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_book['customer_email'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_book['table_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_book['date'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_book['time'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_book['status'] ?>
                                    </td>
                                    <td>
                                        <a href="cancel_booking_admin.php?id=<?php echo $row_book['booking_id'] ?>"
                                            onclick="return confirmCancel()">Cancel</a>
                                        <a href="over_booking_admin.php?id=<?php echo $row_book['booking_id'] ?>">Over</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "no booking";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function confirmCancel() {
            return confirm('Are You Sure, you want to cancel the booking');
        }

        // current date
        document.addEventListener('DOMContentLoaded', function () {
            var today = new Date().toISOString().slice(0, 10);

            document.getElementById('datepicker').value = today;
        });
    </script>
</body>

</html>