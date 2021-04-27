<?php
require_once 'connection.php';
require_once 'exp.php';

$link = mysqli_connect($host, $user, $password, $database)
    or die("Error " . mysqli_error($link));
$name = $_POST['user'];
$pass = $_POST['password'];

if(!preg_match($exp, $name)) //'/^w{5,}$/'
{
    header('location:login.php');
    exit();
}

$query = "SELECT name FROM usertable WHERE name='$name'";
$result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
$num = mysqli_num_rows($result);
if($num >0)
{
    $query_in = "SELECT name FROM usertable WHERE name = '$name' && password = '$pass'";
    $result = mysqli_query($link, $query_in) or die("Error " . mysqli_error($link));
    $row_query_in = mysqli_num_rows($result);
    if($row_query_in == 1)
    {   //echo "home";
        header('location:home.php');
    }
    else
    {
        //echo "Login";
        header('location:login.php');
    }
}
else
{
    $reg = "insert into usertable(name, password) values ('$name', '$pass')";
    mysqli_query($link, $reg);
    echo "Registration Successful";
}


mysqli_close($link);

?>