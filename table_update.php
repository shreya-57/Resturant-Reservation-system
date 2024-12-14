<?php
include ("connection.php");

$table_id = $_GET['id'];
$select = "SELECT * FROM tables WHERE table_id='$table_id'";
$data = mysqli_query($con, $select);
if (mysqli_num_rows($data) == 1) {
    $row_table = mysqli_fetch_assoc($data);
    // echo $row_table['table_name'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update</title>
</head>

<body>
    <style>
        body {
            background-color: whitesmoke;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .admin-form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .box {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid indianred;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn {
            background-color: indianred;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
        }

        .btn:hover {
            background-color: #9e2a2b;
        }

        h3 {
            color: indianred;
        }

        .message {
            color: red;
            display: block;
            margin-bottom: 10px;
        }
    </style>

    <div class="container">
        <div class="admin-form-container centered">
            <form action="" method="post">
                <h3>Update table</h3>
                <input type="text" placeholder="enter the table name" value="<?php echo $row_table['table_name'] ?>"
                    name="table_name" class="box" readonly>
                <input type="text" placeholder="enter the table details"
                    value="<?php echo $row_table['table_details'] ?>" name="table_details" class="box" required>

                <input type="submit" class="btn" name="update_table" value="update table">
            </form>
            <a href="add_table.php" class="btn-goback">go back</a>
        </div>
    </div>

</body>

</html>
<?php
if(isset($_POST['update_table'])){
    $name=$_POST['table_name'];
    $details=$_POST['table_details'];

    $update_query="UPDATE tables SET table_details='$details' WHERE table_id='$table_id'";
    $update_data=mysqli_query($con, $update_query);
    if($update_data){
        echo "<script>alert('Successfully updated')</script>";
        header('location:add_table.php');
    }else{
        echo "<script>alert('Failed to update')</script>";

    }
}
?>