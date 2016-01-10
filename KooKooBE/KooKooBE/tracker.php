<?php
/* TODO: Add code here */
require('config/globalconfig.php');
include_once('class/model_user.php');
include_once('class/model_tracker.php');

$objTracker = new Model_Tracker($objConnection);
$objUser = new Model_User($objConnection);

global_common::cors();

$request_body= file_get_contents("php://input");
//echo $request_body;
if($request_body && global_common::isJson($request_body))
{
    $_pgR = json_decode($request_body, true) ;
}
if($_pgR["act"]==Model_Tracker::ACT_ADD) //add
{ 
    
    $userName = $_pgR[global_mapping::UserName];
    $user = $objUser->getUserByName($userName);
    $trackType= $_pgR[global_mapping::TrackType];
    $value= $_pgR["Value"];   
    $description= $_pgR["Description"];

    $trackerID = $objTracker->insert($user[global_mapping::UserID],$trackType,$value,$description);    
    echo json_encode($trackerID);
}
else if($_pgR["act"]==Model_Tracker::ACT_GET_USER) //add
{ 
    
    $userName = $_pgR[global_mapping::UserName];
    $user = $objUser->getUserByName($userName);
    $storeID= $_pgR[global_mapping::StoreID];
    $tracker = $objTracker->getTrackerUser($user[global_mapping::UserID],$storeID);   

    echo json_encode($tracker);
}
else if($_pgR["act"]==15) //get detail
{
    $store = $objStore->getStoreByID($_pgR['id']);
    echo json_encode($store);
}
?>