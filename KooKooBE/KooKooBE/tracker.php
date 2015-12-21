<?php
/* TODO: Add code here */
require('config/globalconfig.php');

include_once('class/model_tracker.php');

$objTracker = new Model_Tracker($objConnection);

if($_pgR["act"]==10) //add
{ 
    $userID = $_pgR["UserID"]; 
    $trackType= $_pgR["TrackType"];
    $value= $_pgR["Value"];
    $trackDate= $_pgR["TrackDate"];
    $description= $_pgR["Description"];

    $trackerID = $objTracker->insert($userID,$trackType,$value,$description,$trackDate);    
    echo json_encode($stores);
}
else if($_pgR["act"]==15) //get detail
{
    $store = $objStore->getStoreByID($_pgR['id']);
    echo json_encode($store);
}
?>