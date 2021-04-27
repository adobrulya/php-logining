<?php
session_start();

$con = mysqli_connect('localhost', 'root', '');

mysqli_select_db($con, 'userregistration');

$name = $_POST['user'];
$pass = $_POST['password'];
//echo 'name: '.$name;

/*$username = mysqli_query("SELECT * FROM usertable WHERE name='$name'");
//echo '$username: '.$username;
//echo '$name: '.$name;
//$count = mysqli_num_rows($username);
//echo '$count: '.$count;
if($count!=0)
{
    die("Name already exists! Please type another name");
}
*/

$s = " select * ftom usertable where name = '$name'";
$result = mysqli_query($con, $s);
//echo '$result: '.$result;
$num = mysqli_num_rows($result);
//echo '$num: '.$num;
$rows = mysqli_num_rows($result);
echo "Количество строк: ";
echo $rows;
if($result)
{
    $rows = mysqli_num_rows($result);
    echo "Количество строк: ";
    echo $rows;
}
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