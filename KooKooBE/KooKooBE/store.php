<?php
/* TODO: Add code here */
require('config/globalconfig.php');

include_once('class/model_store.php');
include_once('class/model_user.php');
include_once('class/model_articletype.php');
include_once('class/model_storecategory.php');
include_once('class/model_city.php');
include_once('class/model_article.php');
include_once('class/model_user.php');
include_once('class/model_district.php');
include_once('class/model_tracker.php');

$objArticleType = new Model_ArticleType($objConnection);

$objCity = new Model_City($objConnection);
$objUser = new Model_User($objConnection);
$objDistrict = new Model_District($objConnection);
$objStore = new Model_Store($objConnection);
$objStoreCategory = new Model_Storecategory($objConnection);
$objTracker = new Model_Tracker($objConnection);


global_common::cors();
//print_r($allStores);
//return;
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: GET, POST');
//header('Content-Type: application/json');
$request_body= file_get_contents("php://input");
//echo $request_body;
if($request_body && global_common::isJson($request_body))
{
    $_pgR = json_decode($request_body, true) ;
}
if($_pgR["act"]==1) //search
{
    //echo $_gmapAPI;
 
    $address = $_pgR["keyword"]; 
    $distance= $_pgR["distance"];
    $cat= $_pgR["cat"];
    
    //echo $address;
   /* 
    //echo $address;
    if($address != null  && $address!='')
    {
        //echo 'search with address';
        $address .= ',HCM,VN';
        
        if(!$distance || $distance<=0 ||  $distance>$_distance )
        {
            $distance = $_distance;
        }
        //echo $address;
        $location = global_common::getLocation($_gmapAPI,$address);
    }
    else
    {
        //echo 'lat & long';
        $location = array('lat' =>global_common::convertToDecimal( $_pgR["lat"]), 
        'long' => global_common::convertToDecimal($_pgR["lng"]));
    }
    */
     $location = array('lat' =>global_common::convertToDecimal( $_pgR["lat"]), 
        'long' => global_common::convertToDecimal($_pgR["lng"]));
    //echo $address;
    //echo $address;
    $condition = '';
    if($cat && $cat!='undefined')
    {
        $condition = '`'.global_mapping::MainCategoryId.'` ='.$cat;
    }
    else
    {
        $cat='0';
    }
    if($address)
    {
        if($condition)
        {
            $condition.= ' AND ';
        }
        $condition .= '`'.global_mapping::Name.'` like \'%'.$address.'%\'';
    }
    //echo  $condition;
    //print_r($location);
    //return;
    $allStores = Application::getVar('allStores_'.$cat.'_'.$address);
    if(!$allStores)
    {
        $allStores = $objStore->getAllStore(0,global_mapping::StoreID.','.
                global_mapping::Latitude.','.global_mapping::Longitude,$condition);
        Application::setVar('allStores_'.$cat.'_'.$address,$allStores);
    }
  
    //print_r($allStores);
    //return;
    $count =0;
    //return;
    $result = array();
    //echo $distance.'<br>';
    foreach($allStores as $item)
    {
        //echo date('Y-m-d H:i:s').'<br>';
        //removing
        //   $count++;
        //   if($count>=1000)
        //     break;
        //End removing        
        //echo $location['lat'].$location['long'].$item[global_mapping::Latitude].$item[global_mapping::Longitude].'<br>';        
        //$storeDistance = global_common::getDistance($location['lat'],$location['long'],$item[global_mapping::Latitude],$item[global_mapping::Longitude]);
        $rad = M_PI / 180;
        $storeDistance = acos(sin($item[global_mapping::Latitude]*$rad) * sin($location['lat']*$rad) + 
                cos($item[global_mapping::Latitude]*$rad) * cos($location['lat']*$rad) * 
                cos($item[global_mapping::Longitude]*$rad - $location['long']*$rad)) * 6371;// Kilometers
        
        //$storeDistance = 1000;
        if($storeDistance< $distance)
        {
            //echo $storeDistance;
            //echo '<br>';
            //$item[global_mapping::Latitude] = global_common::convertToDecimal($item[global_mapping::Latitude])	;
            //$item[global_mapping::Longitude] = global_common::convertToDecimal($item[global_mapping::Longitude])	;
            $item[global_mapping::Distance] = $storeDistance;
            array_push($result,$item);
            $count++;
            if($count>=50)
                break;
        }
    }
    //echo 'End get distance</br>';
    //return;
    //print_r($result) ;   
    //return;
    if($result)
    {
        usort($result, "global_common::cmpDistance");
        $result = array_slice($result,0, 10);
        $arrStoreID =  global_common::getArrayColumn($result,global_mapping::StoreID);
        //print_r('$arrStoreID');
        //print_r($arrStoreID);
        //return;
        $stores = $objStore->getStoreByIDs($arrStoreID);
         //echo 'End get distance</br>';
        //return;
        //print_r($result);
        //print_r(global_common::getArrayColumn($result,global_mapping::Distance));
        //return;
        echo json_encode($stores);
    }
    else
    {
        echo '';
    }
    //echo '[{"Active":true,"Address1":"1095 Judge Ely Blvd","Address2":"","CS_StoreID":14,"City":"Abilene","StoreName":"United Supermarkets","StoreID":545,"LocationName":"","State":"TX","Zipcode":"79601","PhoneNumber":"(325) 677-8527","Latitude":32.4617645,"Longitude":-99.7052135},
    //{"Active":true,"Address1":"1095 Judge Ely Blvd","Address2":"","CS_StoreID":15,"City":"Abilene","StoreName":"United Supermarkets","StoreID":546,"LocationName":"","State":"TX","Zipcode":"79601","PhoneNumber":"(325) 677-8527","Latitude":32.4616645,"Longitude":-99.7062135}]';
}
else if($_pgR["act"]==2) //get detail
{
    $store = $objStore->getStoreByID($_pgR['id']);
    echo json_encode($store);
}
else if($_pgR["act"]==3) //check in
{
    $userName = $_pgR[global_mapping::UserName];
    $user = $objUser->getUserByName($userName);
    $store = $objStore->addCheckIn($_pgR[global_mapping::StoreID],$user[global_mapping::UserID],$_pgR[global_mapping::Message],$_pgR[global_mapping::Rate]);
    echo json_encode($store);
}
else if($_pgR["act"]==Model_Store::ACT_GET_CHECKED_STORE) //get store checked in
{
    //echo 'get store checked in';
    $userName = $_pgR[global_mapping::UserName];
    $user = $objUser->getUserByName($userName);
    $userID = $user[global_mapping::UserID];
    $page = $_pgR['page']? $_pgR['page']:1;
   
    $checkedInStores = $objStore->getCheckedInStores($userID,$page);   
    
    //print_r($checkedInStores);
    //return;
    $stores = $objStore->getStoreByIDs($checkedInStores);
    
    $resultStores = null;
  	foreach($stores as $key => $info)
	{
		$resultStores[$info[global_mapping::StoreID]]=$info;
		unset($stores[$key]);
	}
    
    $result = array();
    //echo $distance.'<br>';
    foreach($checkedInStores as $item)
    {
        //echo '<br>ID:'.$item;
        array_push($result,$resultStores[$item]);
    }    
    
    echo json_encode($result);
}
else if($_pgR["act"]==Model_Store::ACT_GET_FAVORITE_STORE) //get store checked in
{
    //echo 'get store checked in';
    $userName = $_pgR[global_mapping::UserName];
    $user = $objUser->getUserByName($userName);
    $userID = $user[global_mapping::UserID];
    $page = $_pgR['page']? $_pgR['page']:1;
    $type = $_pgR['type'];
   
    $trackerStores = $objTracker->getTrackerUserType($userID,$type,$page);   
    //return;
    //print_r($trackerStores);
    //return;
    $stores = $objStore->getStoreByIDs($trackerStores);
    //print_r($stores);
    //return;
    $resultStores = null;
  	foreach($stores as $key => $info)
	{
		$resultStores[$info[global_mapping::StoreID]]=$info;
		unset($stores[$key]);
	}
    
    $result = array();
    //echo $distance.'<br>';
    foreach($trackerStores as $item)
    {
        //echo '<br>ID:'.$item;
        array_push($result,$resultStores[$item]);
    }    
    
    echo json_encode($result);
    
}
else if($_pgR["act"]==5) //get categories
{
    
    $allCats = $objArticleType->getAllArticleType();
    echo json_encode($allCats);
}

//echo '[{"Active":true,"Address1":"1095 Judge Ely Blvd","Address2":"","CS_StoreID":14,"City":"Abilene","StoreName":"United Supermarkets","StoreID":545,"LocationName":"","State":"TX","Zipcode":"79601","PhoneNumber":"(325) 677-8527","Latitude":32.4617645,"Longitude":-99.7052135}]';
 

?>