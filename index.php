<?php
/**
 * Created by PhpStorm.
 * User: dacvuho
 * Date: 16/02/2018
 * Time: 2:23 PM
 */
include_once("config.php");
$format="json";
if(strpos($_SERVER['HTTP_ACCEPT'],"html")!==false)
{
    $format="html";
}

set_exception_handler(function($err) use ($format) {

    http_response_code($err->getCode());
    output($err->getMessage(),$format);
});

$method=$_SERVER['REQUEST_METHOD'];

$spitRequest= explode("/",$_SERVER['PATH_INFO']);

switch($spitRequest[1])
{
    case "list2016":
        $funcName = $spitRequest[1].$method;
        if(function_exists($funcName))
        {
            $data=$funcName();
        }
        else
        {
            throw new Exception("Method not available", 405);
        }
        break;
    default:
        throw new Exception("Unknown endpoint", 404);
        break;
}

output($data,$format);

function output($data, $format)
{
    if($format=="html")
    {
        print_r($data);
    }
    else
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}

function list2016GET()
{
    global $conn;
    global $sql_list_2016;
    $data=array();
    $query = $conn->query($sql_list_2016);

    $query->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $query->fetch())
    {
        $data[]=$row;
    }
    return $data;
}