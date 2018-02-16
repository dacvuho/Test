<?php
/**
 * Created by PhpStorm.
 * User: dacvuho
 * Date: 16/02/2018
 * Time: 2:42 PM
 */

$username = "root";
$password = "password";
$host = "mysql";
$db = "apnic";
//registry|cc|type|start|value|date|status|opaque-id[|extensions...]
//apnic|JP|asn|173|1|20020801|allocated
$sql_create = "CREATE TABLE IF NOT EXISTS `ip_records` (
               `registry` varchar(40) NOT NULL,
               `cc` varchar(40) NOT NULL,
               `type` varchar(40) NOT NULL,
               `start` varchar(40) NOT NULL,
               `value` varchar(40) NOT NULL,
               `date` varchar(40) NOT NULL,
               `status` varchar(40) NOT NULL,
               `opaque-id` varchar(40)  NULL,
               `extensions` varchar(40) NULL
             )";

$sql_del="drop table if EXISTS ip_records";
//Total ASN count (value field) in 2016 for each country
$sql_list_2016="select sum(value) Total,ANY_VALUE(left(date,4)) Year,ANY_VALUE(type) as Resource, cc as Economy from ip_records where left(date,4)='2016' group by cc
";
try
{
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}