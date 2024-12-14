<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <linkrel="stylesheet"href="admin.css">
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
                background-size: 100%;
                height: 100vh;
                font-family: "Poppins", sans-serif;
            }

            .container {
                padding: 20px;

                h2 {
                    display: flex;
                    justify-content: center;
                }

                table {
                    border-collapse: collapse;
                    margin-left: auto;
                    margin-right: auto;
                    margin-top: 20px;

                    tr {
                        border-bottom: 1px solid black;
                    }
                    tr:nth-child(even){background-color: #f2f2f2;}
                    tr:hover {background-color: #ddd;}
                    td {
                        border: 1px solid black;
                        padding: 10px;
                        font-size: 20px;
                    }

                    th {
                        background-color: rgb(83, 83, 83);
                        color: white;
                        padding: 10px;
                    }
                }
                button{
                    padding: 5px 10px;
                    font-size: 20px;
                }
            }
        </style>
</head>

<body>
    <div class="container">
        <button><a href="admin_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        <h2>Reservation Records</h2>
        <table>
            <thead>
                <th>Table</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php
                include ('connection.php');

                $select = "SELECT * 
                  FROM tables as t
                  INNER JOIN reservation as r 
                  ON t.table_id = r.t_id 
                  INNER JOIN customer as c 
                  ON r.customer_id=c.customer_id
                  ORDER BY 
                    CASE 
                    WHEN r.status = 'booked' THEN 1 
                    ELSE 2 
                    END";
                $data = mysqli_query($con, $select);
                if (mysqli_num_rows($data) > 0) {
                    while ($result = mysqli_fetch_assoc($data)) {
                        ?>
                        <tr>
                            <td><?php echo $result['table_name'] ?></td>
                            <td><?php echo $result['customer_name'] ?></td>
                            <td><?php echo $result['customer_email'] ?></td>
                            <td><?php echo $result['date'] ?></td>
                            <td><?php echo $result['time'] ?></td>
                            <td><?php echo $result['status'] ?></td>
                        </tr>
                        <?php
                    }
                }

                ?>
            </tbody>
        </table>
    </div>

</body>

</html>