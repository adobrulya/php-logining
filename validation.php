<?php
session_start();
//header('location:login.php');
require_once 'connection.php';


$link = mysqli_connect($host, $user, $password, $database)
or die("Error " . mysqli_error($link));
$name = $_POST['user'];
$pass = $_POST['password'];

$query_in = "SELECT name FROM usertable WHERE name = '$name' && password = '$pass'";
$result = mysqli_query($link, $query_in) or die("Error " . mysqli_error($link));
$row_query_in = mysqli_num_rows($result);
if($row_query_in == 1)
{   //echo "home";
    $_SESSION['username'] = $name;
    header('location:home.php');
}
else
{
    //echo "Login exist";
    header('location:login.php');
}



mysqli_close($link);

?>

