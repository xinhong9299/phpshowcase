<?php
//
date_default_timezone_set("Asia/Kuala_Lumpur");
//Enable cross origin access control
header("Access-Control-Allow-Origin: *");
//
//Load recources
require_once('./classes/recordSet.class.php');
//// require_once('./classes/recordSet_rmv_header.class.php');
require_once('./classes/pdoDB.class.php');
//
//Start Session
session_start();
//
//Time and Date
date_default_timezone_set("Asia/Kuala_Lumpur");
$mysqlDateandTime = date("Y-m-d H:i:s");
$mysqlDate = date("Y-m-d");
$mysqlTime = date("H:i:s");

//Standard REQUEST
$call = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'error';
$subject = isset($_REQUEST['subject']) ? $_REQUEST['subject'] : null;
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

//REQUEST
$value = isset($_REQUEST['value']) ? $_REQUEST['value'] : null;
$value2 = isset($_REQUEST['value2']) ? $_REQUEST['value2'] : null;


//Action and Subject to Route
$route = $call . ucfirst($subject);

// Connect to db
$db = pdoDB::getConnection();

//set the header to json because everything is returned in that format
header("Content-Type: application/json");

switch ($route) {

    case 'viewAll':
        $sqlSearch = "SELECT * FROM `table`";
        $rs = new JSONRecordSet();
        $retval = $rs->getRecordSet($sqlSearch, null, null);
        echo $retval;
        break; 

    case 'viewSelected':
        $sqlSearch = "SELECT * FROM `table` WHERE `id`=:id";
        $rs = new JSONRecordSet();
        $retval = $rs->getRecordSet($sqlSearch, null, array(
            ':id' => $id
        ));
        echo $retval;
        break;
    
    case 'insert':
        $sqlInsert="INSERT INTO `table` (`value`,`value2`) VALUES (:value, :value2)";
        $rs = new JSONRecordSet();
        $retval = $rs->setRecord($sqlInsert, null, array(
            ':value'=>$value,
            ':value2'=>$value2
        ));
        echo $retval;
        break;
    
    case 'remove':
        $sqlInsert="DELETE FROM `table` WHERE `id`=:id";
        $rs = new JSONRecordSet();
        $retval = $rs->setRecord($sqlInsert, null, array(
            ':id'=>$id,
        ));
        echo $retval;
        break;

    case 'update':
        $sqlInsert="UPDATE `phpshowcase`.`table`
                    SET
                    `value` = :value,
                    `value2` = :value2
                    WHERE 
                    `id` = :id
                    ";
        $rs = new JSONRecordSet();
        $retval = $rs->setRecord($sqlInsert, null, array(
            ':id'=>$id,
            ':value'=>$value,
            ':value2'=>$value2
        ));
        echo $retval;
        break;


}
//end of switch
?>