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
            a{
                text-decoration: none;
            }
            td button{
                background-color: red;
                border: none;
                border-radius: 5px;
                transition: background 0.5s;
                a{
                    color: white;
                }
            }
            td button:hover{
                background-color: orange;
            }
        </style>
</head>

<body>
    <div class="container">
        <button><a href="admin_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        <h2>Reservation Records</h2>
        <table>
            <thead>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Customer Phone</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                include ('connection.php');

                $select = "SELECT * FROM customer";
                $data = mysqli_query($con, $select);
                if (mysqli_num_rows($data) > 0) {
                    while ($result = mysqli_fetch_assoc($data)) {
                        ?>
                        <tr>
                            <td><?php echo $result['customer_name'] ?></td>
                            <td><?php echo $result['customer_email'] ?></td>
                            <td><?php echo $result['customer_phone'] ?></td>
                            <td>
                                <button onclick=" return confirmDelete()"><a href="delete_customer.php?id=<?php echo $result['customer_id']?>">Delete</a></button>
                            </td>
                        <?php
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
<script>
    function confirmDelete(){
        return confirm('Are you sure, you want to delete this user');
    }
</script>
</body>

</html>