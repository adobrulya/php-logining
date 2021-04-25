<?php
session_start();

$con = mysqli_connect('localhost', 'root', '');

mysqli_select_db($con, 'userregistration');
mysqli_select_db($con, 'userregistration');
$username = mysqli_query("SELECT name FROM usertable WHERE name='$name'");
$count = mysqli_num_rows($username);

if($count!=0)
{
    die("Name already exists! Please type another name");
}
$name = $_POST['user'];
$pass = $_POST['password'];

$s = " select * ftom usertable where name = '$name'";
$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if ($num == 1)
{
    echo " Username Already Taken";
}
else
{
    $reg = " insert into usertable(name, password) values ('$name', '$pass')";
    mysqli_query($con, $reg);
    echo "Registration Successful";
}

?>