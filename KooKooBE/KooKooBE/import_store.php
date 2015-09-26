<?php
/* TODO: Add code here */
require('config/globalconfig.php');
include_once('class/model_store.php');
include_once('class/model_articletype.php');
include_once('class/model_storecategory.php');
include_once('class/model_city.php');
include_once('class/model_district.php');

$objArticleType = new Model_ArticleType($objConnection);

$objCity = new Model_City($objConnection);
$objDistrict = new Model_District($objConnection);
$objStore = new Model_Store($objConnection);
$objStoreCategory = new Model_Storecategory($objConnection);

$folder = global_common::FOLDER_FILES_OTHER.'/Foody/';
$fileCat = $folder.'All_Foody_Categories.txt';
if($_pgR["act"] == "import")
{
    echo $fileCat;
    echo '<br>';
    $jsonCats = global_common::readFromFile($fileCat);
    
    $rootCats = json_decode($jsonCats, true);
    $cats = $rootCats['allCategories'];
    //print_r($cats);
    $createdBy = 11111;
    $updatedBy = 11111;
    foreach($cats as $cat)
    {
        //print_r($cat);
        //return;
        $catName = $cat['Name'];
        $checkExisted = $objArticleType->getArticleTypeByName($catName);
        //print_r($checkExisted); ;
        if(!$checkExisted)
        {
           echo 'Adding...'.$catName.'<br>';
           $result = $objArticleType->insert($catName,$createdBy,global_common::nowSQL(),$updatedBy,global_common::nowSQL(),null,null,null,$cat['Id'],0,0);
           if($result)
           {
                echo 'Added '.$catName. ' successfull';
                echo '<br>';
           }
           else
           {
                echo 'Add '.$catName. ' failed';
                echo '<br>';
           }
        }
    }
    
    $allCats = $objArticleType->getAllArticleType(0);
    $allFiles = scandir($folder);
    
    //print_r($allFiles);
    foreach($allFiles as $file)
    {
        if(strpos($file, 'Foody_stores_of_cat') !== FALSE)
        {
            $jsonStores = global_common::readFromFile($folder.$file);
            $rootElements = json_decode($jsonStores, true);
            $stores = $rootElements['restaurants'];
            //print_r($stores);
            foreach($stores as $store)
            {
                //print_r($store);
                //return;
                $storeRefID = '7009-'.$store['Id'];
                $storeName = $store['Name'];
                $checkExisted = $objStore->getStoreByRefID($storeRefID);
                //print_r($checkExisted); ;
                if(!$checkExisted)
                {
                   $cityName = $store['City'];
                   $city = $objCity->getCityByName($cityName);
                   
                   
                   
                   //print_r($city);
                   if($city)
                   {
                        $cityID = $city[global_mapping::CityID];
                   }
                   else
                   {
                        $cityID = $objCity->insert($cityName);
                   }
                   
                   $districtName = $store['District'];
                   $district = $objDistrict->getDistrictByName($districtName);
                  
                   //print_r($district);
                   if($district)
                   {
                        $districtID = $district[global_mapping::DistrictID];
                   }
                   else
                   {
                        $districtID = $objDistrict->insert($districtName,$cityID);
                   }
                   echo 'DistricID:'.$districtID.'<br>';
                   echo 'Adding...'.$storeName.'<br>';
                   $result = $objStore->insert($storeName,
                               $store['Address'],
                               $districtID,
                               $cityID,
                               '',
                               '',
                               $store['Latitude'],
                               $store['Longitude'],
                               '',
                               $store['MainCategoryId'],
                               $store['PicturePath'],
                               $store['PicturePath'],
                               '',
                               $createdBy,global_common::nowSQL(),
                               $updatedBy,global_common::nowSQL(),null,null,$storeRefID);
                                               
                   if($result)
                   {
                        $categoryID=0;
                        foreach($allCats as $cat)
                        {
                            if($cat[global_mapping::Status] == $store['MainCategoryId'])
                            {
                                $categoryID = $cat[global_mapping::ArticleTypeID];
                                break;
                            }
                        }
                        $objStoreCategory->insert($result,$categoryID);
                        echo 'Added '.$storeName. ' successfull';
                        echo '<br>';
                        //return;
                   }
                   else
                   {
                        echo 'Add '.$storeName. ' failed';
                        echo '<br>';
                   }
                   //return;
                }
                
                if(count($store["SubItems"])>0)
                {
                     $subStores = $store["SubItems"];
                     $store = null;
                     foreach($subStores as $substore)
                     {
                      
                        $storeRefID = '7009-'.$substore['Id'];
                        $storeName = $substore['Name'];
                        $checkExisted = $objStore->getStoreByRefID($storeRefID);
                        //print_r($checkExisted); ;
                        if(!$checkExisted)
                        {
                           $cityName = $substore['City'];
                           $city = $objCity->getCityByName($cityName);
                           
                           
                           
                           //print_r($city);
                           if($city)
                           {
                                $cityID = $city[global_mapping::CityID];
                           }
                           else
                           {
                                $cityID = $objCity->insert($cityName);
                           }
                           
                           $districtName = $substore['District'];
                           $district = $objDistrict->getDistrictByName($districtName);
                          
                           //print_r($district);
                           if($district)
                           {
                                $districtID = $district[global_mapping::DistrictID];
                           }
                           else
                           {
                                $districtID = $objDistrict->insert($districtName,$cityID);
                           }
                           echo 'DistrictID:'.$districtID.'<br>';
                           echo 'Adding...'.$storeName.'<br>';
                           $result = $objStore->insert($storeName,
                                       $substore['Address'],
                                       $districtID,
                                       $cityID,
                                       '',
                                       '',
                                       $substore['Latitude'],
                                       $substore['Longitude'],
                                       '',
                                       $substore['MainCategoryId'],
                                       $substore['PicturePath'],
                                       $substore['PicturePath'],
                                       '',
                                       $createdBy,global_common::nowSQL(),
                                       $updatedBy,global_common::nowSQL(),null,null,$storeRefID);
                                                       
                           if($result)
                           {
                                $categoryID=0;
                                foreach($allCats as $cat)
                                {
                                    if($cat[global_mapping::Status] == $substore['MainCategoryId'])
                                    {
                                        $categoryID = $cat[global_mapping::ArticleTypeID];
                                        break;
                                    }
                                }
                                $objStoreCategory->insert($result,$categoryID);
                                echo 'Added '.$storeName. ' successfull';
                                echo '<br>';
                                //return;
                           }
                           else
                           {
                                echo 'Add '.$storeName. ' failed';
                                echo '<br>';
                           }
                        }
                     }
                }
            }
            //return;
        }
    }
}else if($_pgR["act"] == "fixlatlong")
{
    
    $total = global_common::getTotalRecord(Model_Store::TBL_SL_STORE,$objConnection);
    for($index = 1; $index<= ($total/Model_Store::NUM_PER_PAGE)+1; $index++)
    {
        $allStores = $objStore->getAllStore($index);
        //print_r($allStores);
        //break;
        foreach($allStores as $store)
        {
           // print_r($store);
            //add urlencode to your address
            $rawAddr = $store[global_mapping::Address].', '.$store[global_mapping::DistrictName].', '.str_replace("TP.","",$store[global_mapping::CityName]) .', Việt Nam';
            //$address = urlencode($rawAddr);
            //$address = str_replace(" ", "+", $address);
            //echo $rawAddr;
            if($store[global_mapping::Latitude]== '10.8230990000' && $store[global_mapping::Longitude] == '106.6296640000')
            {
                echo '<br>Start get lat long: '.$rawAddr;
                
                //$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
               
                //$json = json_decode($json);
                $mapLocation = global_common::getLocation($_gmapAPI,$rawAddr);
                $lat = $mapLocation['lat'];
                $long =$mapLocation['long'];
                if($lat && $long)
                {
                    $result =  $objStore->update($store[global_mapping::StoreID],$store[global_mapping::Name],
                                $store[global_mapping::Address],$store[global_mapping::DistrictID],$store[global_mapping::CityID],
                                $store[global_mapping::Phone],$store[global_mapping::SpecialDesc],$lat,$long,
                                $store[global_mapping::WorkingDay],$store[global_mapping::MainCategoryId],$store[global_mapping::StoreIcon],
                                $store[global_mapping::StoreImage],$store[global_mapping::Status],$store[global_mapping::CreatedBy]
                                ,$store[global_mapping::CreatedDate],$store[global_mapping::UpdatedBy],$store[global_mapping::UpdatedDate]
                                ,$store[global_mapping::DeletedBy],$store[global_mapping::DeletedDate]);
                    if($result)
                    {
                        echo "<br>Update successfull "."Name:".$store[global_mapping::Name]." Address:".$store[global_mapping::Address];
                    } 
                    else
                    {
                        echo "<br>Update failed "."Name:".$store[global_mapping::Name]." Address:".$store[global_mapping::Address];
                    }
                    
                }
                else
                {
                    echo "<br>Update failed. Can't get geo of "."Name:".$store[global_mapping::Name]." Address:".$store[global_mapping::Address];
                }
            }
            else
            {
                echo "<br>Update already."."Name:".$store[global_mapping::Name]." Address:".$store[global_mapping::Address];
            }
            //echo $lat;
            //echo '<br>';
            //echo $long;
            //break;
        }
        //break;
    }
}

?>