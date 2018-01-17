<?php
/**
 * Created by PhpStorm.
 * User: Severin
 * Date: 10.01.2018
 * Time: 13:54
 */
$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'braunun';

try
{
    $con = new PDO( 'mysql:host='.$server.';dbname='.$db.';charset=utf8',$user,$pwd);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
    echo $e->getMessage();
}