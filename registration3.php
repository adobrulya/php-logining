<?php
session_start();
require_once "alphabet.php";
require_once 'connection.php';

// Соединение с БД
$link = mysqli_connect($host, $user, $password, $database)
or die("Error " . mysqli_error($link));

$name = $_POST['user'];
$pass = $_POST['password'];

//Проверка на длину имени
if (strlen($name) <= 2)
{
    //echo strlen($name);
    header('location:login.php');
    exit();
}

$nameLenght = strlen($name);
$counter_symbol = 0;

for ($i = 0; $i < $nameLenght; $i++)
{
    foreach ($alphabet as $symbol)
    {
        if ($symbol == $name[$i])
        {
            $counter_symbol++;
            break;
        }
    }
}
if ($counter_symbol != $nameLenght)
{
    header('location:login.php');
}
else
{
    //Проверка на существование пользователя в БД
    $query = "SELECT name FROM usertable WHERE name='$name'";
    $result = mysqli_query($link, $query) or die("Error ". mysqli_error($link));
    $num = mysqli_num_rows($result);
    if ($num > 0)
    {
        echo "Login exist";
    }
    else
    {
        $reg = "insert into usertable(name, password) values ('$name', '$pass')";
        mysqli_query($link, $reg);
        echo "Registration Successful";
    }


}

//Закрытие соединения с БД
mysqli_close($link);

?>