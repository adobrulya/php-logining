<?php
session_start();
//header('location:login.php');
require_once 'connection.php';
require_once 'exp.php';

$link = mysqli_connect($host, $user, $password, $database)
    or die("Error " . mysqli_error($link));
$name = $_POST['user'];
$pass = $_POST['password'];

//Проверка имени пользователя с помощью регулярного выражения
//чтобы имя было буквы, знак подчёркивания и цифры
if(preg_match($exp, $name))
{
    echo "Name Right";
    //header('location:login.php');
    exit();
}
else
{
    echo "Name Error";
    //header('location:login.php');
    exit();
}

//Проверка на первый символ букву
/*if (preg_match('/\D/', $name))
{
    header('location:login.php');
    exit();
}
*/
//Проверка на длину имени
if (strlen($name) <= 2)
{
    echo strlen($name);
    //header('location:login.php');
    //exit();
}

$query = "SELECT name FROM usertable WHERE name='$name'";
$result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
$num = mysqli_num_rows($result);
if($num >0)
{
    echo "Login exist";
    //$query_in = "SELECT name FROM usertable WHERE name = '$name' && password = '$pass'";
    //$result = mysqli_query($link, $query_in) or die("Error " . mysqli_error($link));
    //$row_query_in = mysqli_num_rows($result);
    /*if($row_query_in == 1)
    {   //echo "home";
        //$_SESSION['username'] = $name;
        //header('location:home.php');
        echo "Login exist";
    }
    else
    {
        //echo "Login";
        header('location:login.php');
    }*/
}
else
{
    $reg = "insert into usertable(name, password) values ('$name', '$pass')";
    mysqli_query($link, $reg);
    echo "Registration Successful";
}


mysqli_close($link);

?>