<?php
$host = "localhost";
$user = "root";
$password= "";
$dbName = "curd";

$connectSQL = mysqli_connect($host , $user , $password , $dbName);

################### Insert
if(isset($_POST['send'])){
    $name = $_POST['userName'];
    $salary = $_POST['salary'];
    $insert = "INSERT INTO users VALUES (NULL , '$name' , $salary)";
    $i = mysqli_query($connectSQL , $insert);
    header("location: /curd/index.php");
}
################### Select
$select = "SELECT * FROM users";
$sq = mysqli_query($connectSQL , $select);
################### Update
$nameR = "";
$salaryR = "";
$showBtn = false;
if(isset($_GET['edit'])){
$showBtn = true;
$id = $_GET['edit'];
$select = "SELECT * FROM users where id = $id";
$sr = mysqli_query($connectSQL , $select);
$row = mysqli_fetch_assoc($sr);
$nameR = $row['name'];
$salaryR = $row['salary'];
if(isset($_POST['update'])){
    $name = $_POST['userName'];
    $salary = $_POST['salary'];
    $update = "UPDATE users SET name = '$name', salary = $salary where id = $id";
    $u = mysqli_query($connectSQL , $update);
    header("location: /curd/index.php");
}
}
################### Delete
if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   $delete = "DELETE FROM users WHERE id = $id";
    mysqli_query($connectSQL , $delete);
   header("location: /curd/index.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="/curd/main.css">
</head>
<body>
    <div class="container col-md-6 md-6 mt-3">
        <div class="card bg-dark">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                    <lable>User Name</lable>
                    <input type="text" name="userName" value="<?php echo $nameR ?>" placeholder="User Name" class="form-control">
                    </div>
                    <div class="form-group">
                    <lable>User Salary</lable>
                    <input type="text" name="salary" value="<?php echo $salaryR ?>" placeholder="User Salary" class="form-control">
                    </div>
                    <?php if($showBtn) : ?>
                    <button name="update" class="btn btn-primary">Update Data</button>
                    <?php else : ?>
                    <button name="send" class="btn btn-info">Send Data</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>


    <div class="container col-md-6 md-6 mt-3">
        <div class="card bg-secondary">
            <div class="card-body">
                <table class="table table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
                <?php foreach( $sq as $data ){ ?>
                <tr>
                    <td><?php echo $data['id'] ?></td>
                    <td><?php echo $data['name'] ?></td>
                    <td><?php echo $data['salary'] ?></td>
                    <td><a class="btn btn-primary" href="/curd/index.php/?edit=<?php echo $data['id'] ?>">Edit</a></td>
                    <td><a class="btn btn-danger" href="/curd/index.php/?delete=<?php echo $data['id'] ?>">Remove</a></td>
                </tr>
                <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>