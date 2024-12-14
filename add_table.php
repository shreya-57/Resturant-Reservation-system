<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <linkrel="stylesheet"href="admin.css">
        <title>Add Table</title>
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
            body {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: Poppins;
            }

            .main_container {
                padding: 20px;
            }

            .form_container {
                /* background-color: red; */
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 10px;

                h2 {
                    display: flex;
                    justify-content: center;
                    color: indianred;
                }

                .fields {
                    display: flex;
                    flex-direction: column;

                    .input_field {
                        display: flex;
                        flex-direction: column;

                        input {
                            font-size: 20px;
                            padding: 5px 10px;
                            border: 0.5px sloid rgb(125, 124, 124);
                            border-radius: 5px;
                            margin-top: 20px;
                        }
                    }

                    button {
                        font-size: 20px;
                        padding: 5px 10px;
                        border: none;
                        border-radius: 5px;
                        margin-top: 20px;
                        background-color: indianred;
                        color: white;
                    }
                }
            }

            .table_container {
                /* background-color: red; */
                display: flex;
                justify-content: center;
                margin-top: 20px;
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
        <a href="admin_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="form_container">
            <h2>Add Table Form</h2>
            <form action="" method="post">
                <div class="fields">
                    <div class="input_field">
                        <input type="text" name="table_name" placeholder="Enter the table name" required>
                        <input type="text" name="table_details" placeholder="Enter the table details" required>
                    </div>
                    <button type="submit" name="add">Add Table</button>
            </form>
        </div>


        <div class="table_container">
            <table>
                <thead>
                    <th>Table Name</th>
                    <th>Details</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    include ('connection.php');
                    $table = "SELECT * FROM tables";
                    $data = mysqli_query($con, $table);
                    if (mysqli_num_rows($data) > 0) {
                        while ($result = mysqli_fetch_assoc($data)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $result['table_name'] ?>
                                </td>
                                <td>
                                    <?php echo $result['table_details'] ?>
                                </td>
                                <td>
                                    <div class="action_btn">
                                        <a href="table_update.php?id=<?php echo $result['table_id']?>">Edit</a>
                                        <a href="table_delete.php?id=<?php echo $result['table_id']?>" onclick="return confirmDelete()">Delete</a>
                                    </div>
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
        function confirmDelete(){
            return confirm('Are you sure, you want ot delete the table');
        }
    </script>
</body>

</html>
<?php
include ('connection.php');
if (isset($_POST['add'])) {
    $name = $_POST['table_name'];
    $details = $_POST['table_details'];

    $add_query = "INSERT INTO tables (table_name, table_details) VALUES('$name', '$details')";
    $add_data = mysqli_query($con, $add_query);
    if ($add_data) {
        echo "<script>alert('table successfully added')</script>";
    } else {
        echo "<script>alert('failed to add the table')</script>";
    }
}
?>