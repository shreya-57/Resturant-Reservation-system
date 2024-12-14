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

    <title>Reservation Details</title>
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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {

            background-repeat: no-repeat;
            background-position: center;
            background-size: 100%;
            height: 100vh;
            font-family: "Poppins", sans-serif;
        }

        a {
            text-decoration: none;
        }

        .main_container {
            padding: 20px;

            h2 {
                display: flex;
                justify-content: center;
            }
        }

        .table_container {
            /* background-color: red; */
            display: flex;
            justify-content: center;
        }

        table {
            width: 80%;
            margin: 20px 0;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: indianred;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #fff;
            text-decoration: none;
            background-color: indianred;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="main_container">
        <a href='customer_dashboard.php'><i class="fa-solid fa-arrow-left"></i></a>
        <h2>Reservation Deatils</h2>
        <div class="table_container">
            <table>
                <thead>
                    <th>Customer Name</th>
                    <th>Table</th>
                    <th>Reservation Date</th>
                    <th>Reservation Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php

                    $select = "SELECT * 
                    FROM reservation as r
                    INNER JOIN customer as c ON r.customer_id=c.customer_id
                    INNER JOIN tables as t ON r.t_id=t.table_id
                     WHERE r.customer_id='$customer_id'";
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
                                    <?php
                                    if ($row_book['status'] == 'over') {
                                        echo 'Cancel';
                                    } else {
                                        ?>
                                        <a href="cancel_booking.php?id=<?php echo $row_book['booking_id'] ?>"
                                            onclick="return confirmCancel()">Cancel</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function confirmCancel() {
            return confirm('Are You Sure, you want to cancel the booking');
        }
    </script>
</body>

</html>