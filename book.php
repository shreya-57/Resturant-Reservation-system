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
            /* background: linear-gradient(to top, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.8)); */
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100%;
            height: 100vh;
            font-family: "Poppins", sans-serif;
        }

        .main_container {
            padding: 20px;
            button{
                font-size: 25px;
                padding: 5px 10px;
                
            }
        }

        .tables_details {
            /* background-color: aqua; */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            h2 {
                display: flex;
                justify-content: center;
            }

            form {
                /* background-color: yellow; */
                margin-top: 20px;

                input {
                    margin-left: 250px;
                    width: 300px;
                    padding: 5px 10px;
                    font-size: 20px;
                    border: 1px solid black;
                    border-radius: 5px;
                }

                .fields {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column;

                    .table_container {
                        display: flex;
                        /* background-color: red; */
                        padding: 20px;
                        flex-wrap: wrap;
                        width: 70%;

                        button {
                            border: 1px solid white;
                            padding: 10px;
                            font-size: 20px;
                            width: 200px;
                            height: 120px;
                            background-color: rgb(65, 167, 7);
                            a {
                                text-decoration: none;


                                p {
                                    font-size: 25px;
                                    color: white;
                                }

                                span {
                                    font-size: 15px;
                                    color: white;
                                }
                            }
                        }
                    }
                }
            }
        }
        .symbol{
            /* background-color: red; */
            display: flex;
.red{
    display: flex;
        align-items: center;
    div{
        background-color: rgb(234, 95, 21);
        width: 20px;
        height: 20px;
        margin-right: 10px;

    }
}
.green{
    display: flex;
        align-items: center;
        margin-left: 10px;
        div{
            background-color:rgb(65, 167, 7);
        width: 20px;
        height: 20px;
        margin-right: 10px;
        }
}
        }
    </style>
</head>

<body>

    <?php
    $currentDate = date('Y/M/d l');
    ?>
    <div class="main_container">
        <button><a href='customer_dashboard.php'><i class="fa-solid fa-arrow-left"></i></a></button>
        <div class="tables_details">
            <h2>Book Your Table</h2>

            <form action="" method="post">
                <input type="text" name="date" value="<?php echo $currentDate ?>" readonly><br>

                <label style="margin-left:250px; margin-top:10px;">Choose Your Time for booking</label><br>
                <input type="time" name="time" min="10:00" max="20:00" required>
                <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>" required>

                <div class="fields">
                    <div class="table_container">

                        <?php
                        include ("connection.php");
                        $select_query = "SELECT t.table_name, t.table_id, t.table_details
                        FROM tables as t
                        ORDER BY t.table_id";
                        $select_data = mysqli_query($con, $select_query);
                        
                        if (mysqli_num_rows($select_data) > 0) {
                            while ($result_table = mysqli_fetch_assoc($select_data)) {
                                $table_id = $result_table['table_id'];
                                $select_reservation = "SELECT * FROM reservation WHERE t_id = $table_id AND date = '$currentDate' AND status = 'booked'";
                                $reservation_data = mysqli_query($con, $select_reservation);
                                
                                // Check if there is a reservation matching the current table ID, date, and status
                                $is_reserved = mysqli_num_rows($reservation_data) > 0;
                           
                           ?>
                           <button type="submit" name="book" value="<?php echo $result_table['table_id']; ?>"
                               <?php echo $is_reserved ? 'style="background-color: rgb(234, 95, 21);" disabled' : ''; ?>>
                               <a href="#?id=<?php echo $result_table['table_id']; ?>">
                                   <p><?php echo $result_table['table_name']; ?></p>
                                   <span><?php echo $result_table['table_details']; ?></span><br>
                               </a>
                           </button>

                                <?php
                        }
                     }
                        ?>
                        
                    </div>
                    <div class="symbol">
                            <div class="red">
                                <div></div>
                                Booked 
                            </div>
                            <div class="green">
                                <div></div>
                                Available
                            </div>
                        </div>
                </div>
                <input type="hidden" name="table_id" value="">
            </form>

        </div>
    </div>

    <script>
        // current date
        document.addEventListener('DOMContentLoaded', function () {
            var today = new Date().toISOString().slice(0, 10);

            document.getElementById('datepicker').value = today;
        });

    </script>
</body>

</html>

<?php
include ('connection.php');
if (isset($_POST['book'])) {
    $table_id = $_POST['book'];
    $customer_id = $_POST['customer_id'];
    $date = $_POST['date'];
    $time = date("g:i A", strtotime($_POST['time']));


    $book_query = "INSERT INTO reservation (customer_id, t_id, date, time)
     VALUES('$customer_id', '$table_id', '$date','$time')";
    $book_data = mysqli_query($con, $book_query);
    if ($book_data) {
        echo "<script>alert('Table Booked Successfully')</script>";
    } else {
        echo "<script>alert('Failed to book')</script>";

    }
    $update="UPDATE reservation SET status='booked'";
    $upadate_data=mysqli_query($con, $update);
    if($update){
        //echo "successfully update";
    }
}
?>
<?php
$currentDate = date('Y/M/d l');
$update="UPDATE reservation SET status='over' WHERE date!='$currentDate'";
$data=mysqli_query($con, $update);
?>
