<?php
/* TODO: Add code here */
require('config/globalconfig.php');
//echo time();
//echo '<br>';
//echo microtime();
//return;
$cityid = 217;//219: da_namg; 217: ho-chi-minh, 218: ha-noi
$cityName = "ho-chi-minh";//


//setcookie("FOODY.AUTH", "F471F391D1F7C977BD5C55B82492F9EB2B218FAAFFB1DA0C859A6EA53AF4166BE161FAA72B3D199B9A828C802160708414541B5064FCBACEF253038ABE6831728970A876601790EF6592E6E40267EFA6312BD83F70CA119D5FD05AF4A09CC4F2B278BD5563936C8863FC11F19C882F2A1F1D5E725FF3B5A1727983F2F6011B4B82607C626E8DF10C08D4CC9AEA9CD44C218A6C4A699AA74E262186D35567A05C6F3FAAC40AD19E1527CC554E10C1B56AD827BE0D329A15A1AA65A3F9A73BB1E9D472185298F0800D390FA626EBDAD6FCFCDF01A8693C3132D854C49D988505EB");

//Example
/*
$catID = 1;
$pageIndex=6;  
$hostStores =  'http://www.foody.vn/ho-chi-minh/dia-diem?ds=Restaurant&vt=row&st=1&dt=undefined&c=3&lat=10.7720308&lon=106.70269479999999&page=10&provinceId=219&categoryId=3&append=true';
$headerStores = array(  
                'Host: www.foody.vn',
                'Connection: keep-alive',
                'Accept: application/json, text/javascript, /*//*; q=0.01',
                'CSP: active',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36',
                'X-Requested-With: XMLHttpRequest',
                'X-Foody-User-Token:  9d0c3de3-dbc4-41a5-8334-9252ede6c077',
                //'Cache-Control: no-cache',
             
                'Referer: http://www.foody.vn/ho-chi-minh/quan-an',
                'Accept-Encoding: gzip, deflate, sdch',
                'Accept-Language: en-US,en;q=0.5',
                //'Cookie: flg=vn; ASP.NET_SessionId=patvstdo4fbgspgdrwikle4e; __RequestVerificationToken=9d0c3de3-dbc4-41a5-8334-9252ede6c077; gcat=entertain; floc=217'
                );
$cookieHeader = 'flg=vn; ASP.NET_SessionId=patvstdo4fbgspgdrwikle4e; gcat=food; floc=217; FOODY.AUTH=4C570C6EC4F0CE54432BDE46511940101605CC450363214566F54425C7369354A15DDB54861CBA0A062DBC227B00BA2C4EDD012031EAE8669A3AADEB6E1DE43B99D7AE303ACEF43151DBF12A401DD738F6CDF0E23142313521071A3D889ADC7343851F95534FE4D655735DD14C331BD3D4415A57BCF5B7DE79F6091D74826B9B9BC367CA4CAF45A284C336B61D6451F781F8E0299CB224ED14D5CF6F45691613E8F351C03B43E09E549678BE9F4F1E3311B4FADEDFEE698EAD1F9AE27D0D59C80164FE3060DCA1A73F8C9CB993C239DF8B0242FD61B724E330B0694613F76BAB; FOODY.RequestVerificationToken=9d0c3de3-dbc4-41a5-8334-9252ede6c077; fbm_395614663835338=base_domain=.foody.vn; _ga=GA1.2.1461401499.1457490421; _gat=1; _gat_ads=1; fbsr_395614663835338=w7ufXZyNTTFPagz45NawdAzn1U2eEIh4zxCCeiJNZW0.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImNvZGUiOiJBUUI5M3hGc2lod2x5S202QzU3Q2pzYV9OWTN1TWpYb1dwQzVXVTdYNHVnazgteEJSSktRRFVZZEtuSWFGZHFyMGFiWDZqc0pjX0cwekkyWThSSVg5V3JVQ1NkbHJBLXhxS0hmVnBnZjZ5ZjJPUmNValRCZTNEcUxrb19KbjlIQWpmc2hsa2xSWDlQbExzS0N1WlNsZ2JieWpENHVwcTdXa1pNc29lOGx3Y09FSkFOVG5lajNPcXlpNzNON1BSZjJ6MUllTmc0enJvcGFQa1lJQ1ZZb2hwSU5KZkhuQkJwR0RiUUxkQW9yUXhOZ0NoMHpER2lEZDB4TXlVMkRHTXhQZWFXQV9od182NUNKc3pDajVtYTN5Q1ExRFhHbjd5SktVNVVvUGExcGE2ZXh3M3o1R01iYW9lMUdqdXNRQUVjTkgxSThMVzZ4Z2FvTU1TX3RzcUx0XzY5eSIsImlzc3VlZF9hdCI6MTQ1OTg4NDI5OCwidXNlcl9pZCI6IjEwMDAwMTg1NjA3NTI5OCJ9';
$jsonStores = global_common::getDataUrl($hostStores,$headerStores, $cookieHeader); 
echo $jsonStores;
return;
*/

$headerCategory = array('Accept	:application/json, text/javascript, */*; q=0.01',
                'Accept-Encoding	:gzip, deflate',
                'Accept-Language	:en-US,en;q=0.5',
                'Cookie	:gcat=travel; flg=vn; floc=217; _ga=GA1.2.1207923018.1436599156; fbm_395614663835338=base_domain=.foody.vn; fbsr_395614663835338=FvL9o1qSoJEfXhawUY-12BVZZKM8ZtyDLReFbpdX20g.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImNvZGUiOiJBUURtbER5QXl5QXJ4WHVab0hNdXI5cmY5QzR0LTdzbXY2b3dWX2FhbnpWanRDRkp2cFd6cWhJQy1oVFdyREV2bmZwdWN1ZV8tMUNZYXFJSGdTekZmRXlScXFGS2N6WUw4eGEwaDNUUE1iTHBmOWFodVNYekQwd1RDcTFQWndNUDdvU196akxLaEZCZndUQjRIckpLYmp1Rm12bU91NzR0S1dYa2Z6VmRnWW13djlmbjhPNEhIak4wQkJqcDBENmkxNlhwNXl4cG51cUtCUlYwSmc1bUczSWZuVWNUTzJ3VkdPU3NIOHN6VjVNc2RhRTlUZWNyYUpyeEdKOUp0UUtHVXlocjQzLTBjRTBzdkNKSXRYOF9JM3ZVY1MxdnptdXpkeFdlUS1mLXM2WHlEUDNFZTd2ekdNRnl3S29oOFA5aXlrblRiTlYxRzdlS2phcWRoQk03Ymt2XyIsImlzc3VlZF9hdCI6MTQzNjYwMjU3OSwidXNlcl9pZCI6IjEwMDAwMTg1NjA3NTI5OCJ9; FOODY.AUTH=2953748CE976EA8138CDDCB2F1DB0F730B6D406E797914ED4EBE42E28034B48D76466E039CDBF227DFC218593B2F32A780C3C19D888462CEA96AECECD597963C3DA6A761A486810498DFA578954DFAA874C43F868513D2DCAEBE0880ECD05EFB48632F7A01D813AA6ADBBD618FA9880B3C82D9ADADE6EA03D95D28226378EFB939BD3C423454EFB97144BC51BE3C81D66E4A3701D5DA759674928C651096ED1EEAD2C6D5C07E9D5BD69CA89CF7F786E137F75803135BD6B3441E8FC3ABA8CB0D0990D0CE9C15E579CB0C0F8DB1F919A408E710E295F31823712A9E7A0C41FDC9; FOODY.RequestVerificationToken=ad50533b-967a-4826-b8f6-916e17eb55b7; _gat=1; f_idientifier=f23cd161-e716-414d-acb1-89ede858c12b; ASP.NET_SessionId=ldpxnxwso1pqjlhtg5powptn; __RequestVerificationToken=8y3lCH0y6BBNq5gYA8BwqyXva3LvlXnZjiojqXJtqPL5St2I1N7lg1zdh1t0KBp2RyiWYtaEJyQ7VPqM_GXTMVgaYVOhNrfhF-49cHmv1bM1',
                'Host	:travel.foody.vn',
                'Referer	:http://travel.foody.vn/ho-chi-minh/khu-du-lich',
                'User-Agent	:Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0',
                'X-Foody-User-Token	:null',
                'X-Requested-With	:XMLHttpRequest');
$hostUrlCat = 'http://foody.vn/Directory/GetSearchFilter?ds=Restaurant&vt=row&st=1&dt=undefined&c=7&lat=10.746903&lon=106.67629199999999&filter=category&provinceId='.$cityid;
//echo $hostUrlCat;
$jsonCategories = global_common::getDataUrl($hostUrlCat,null,null);
//echo $jsonCategories; 
//return;
//echo $jsonCategories;
$folder = global_common::FOLDER_FILES_OTHER;
global_common::writeToFile($folder.'Foody/All_Foody_Categories.txt',$jsonCategories);

echo 'Got Foody categories';
$allCategories = json_decode($jsonCategories, true);
//var_dump($allCategories); 
//return;
$allCategories = $allCategories['allCategories'];
echo '<br>';
//return;
//print_r($allCategories);
//return;
foreach($allCategories as $item)
{
    $total = $item['ResultCount'];
    $catID = $item['Id'];  
    $count = 1 + $total/ 12 ;
    echo '<br>';
    echo 'Got Foody stores of cat_'.$catID.'_total_'.$total;
    //return;
    for($pageIndex=1 ; $pageIndex< $count; $pageIndex++)
    {        
        $filePath = $folder.'Foody/Foody_stores_of_cat_'.$catID.'_page_'.$pageIndex.'.txt';
        if(file_exists($filePath) == false)
        {
            $hostStores =  'http://www.foody.vn/'.$cityName.'/dia-diem?ds=Restaurant&vt=row&st=1&dt=undefined&c='.$catID.'&page='.$pageIndex.'&provinceId='.$cityid.'&categoryId='.$catID.'&append=true';
            $headerStores = array(  
                           'Host: www.foody.vn',
                            'Connection: keep-alive',
                            'Accept: application/json, text/javascript, */*; q=0.01',
                            'CSP: active',
                            'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36',
                            'X-Requested-With: XMLHttpRequest',
                            //replace new token
                            'X-Foody-User-Token: 9d0c3de3-dbc4-41a5-8334-9252ede6c077',
                            'Cache-Control: no-cache',                         
                            'Referer: http://www.foody.vn/'.$cityName.'/quan-an',
                            'Accept-Encoding: gzip, deflate, sdch',
                            'Accept-Language: en-US,en;q=0.5'
                            );
            //$cookieHeader = 'flg=vn; ASP.NET_SessionId=w1pwfv01xno1sixk2wqxtvwp; __RequestVerificationToken=QXh8ezc4yMSkKxZgBi4waCJJkRuXEPDbL3ISEKdZXXxmTlJTrQJ4UD5S4TT0Vv6eM48t1Eqy5Wbare1yfv4OtJWiEfCtbvnBFt7HL3CYzxM1; gcat=entertain; floc=217';
            //Replace new cookie
            $cookieHeader = 'flg=vn; ASP.NET_SessionId=patvstdo4fbgspgdrwikle4e; gcat=food; floc=217; FOODY.AUTH=4C570C6EC4F0CE54432BDE46511940101605CC450363214566F54425C7369354A15DDB54861CBA0A062DBC227B00BA2C4EDD012031EAE8669A3AADEB6E1DE43B99D7AE303ACEF43151DBF12A401DD738F6CDF0E23142313521071A3D889ADC7343851F95534FE4D655735DD14C331BD3D4415A57BCF5B7DE79F6091D74826B9B9BC367CA4CAF45A284C336B61D6451F781F8E0299CB224ED14D5CF6F45691613E8F351C03B43E09E549678BE9F4F1E3311B4FADEDFEE698EAD1F9AE27D0D59C80164FE3060DCA1A73F8C9CB993C239DF8B0242FD61B724E330B0694613F76BAB; FOODY.RequestVerificationToken=9d0c3de3-dbc4-41a5-8334-9252ede6c077; fbm_395614663835338=base_domain=.foody.vn; _ga=GA1.2.1461401499.1457490421; _gat=1; _gat_ads=1; fbsr_395614663835338=w7ufXZyNTTFPagz45NawdAzn1U2eEIh4zxCCeiJNZW0.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImNvZGUiOiJBUUI5M3hGc2lod2x5S202QzU3Q2pzYV9OWTN1TWpYb1dwQzVXVTdYNHVnazgteEJSSktRRFVZZEtuSWFGZHFyMGFiWDZqc0pjX0cwekkyWThSSVg5V3JVQ1NkbHJBLXhxS0hmVnBnZjZ5ZjJPUmNValRCZTNEcUxrb19KbjlIQWpmc2hsa2xSWDlQbExzS0N1WlNsZ2JieWpENHVwcTdXa1pNc29lOGx3Y09FSkFOVG5lajNPcXlpNzNON1BSZjJ6MUllTmc0enJvcGFQa1lJQ1ZZb2hwSU5KZkhuQkJwR0RiUUxkQW9yUXhOZ0NoMHpER2lEZDB4TXlVMkRHTXhQZWFXQV9od182NUNKc3pDajVtYTN5Q1ExRFhHbjd5SktVNVVvUGExcGE2ZXh3M3o1R01iYW9lMUdqdXNRQUVjTkgxSThMVzZ4Z2FvTU1TX3RzcUx0XzY5eSIsImlzc3VlZF9hdCI6MTQ1OTg4NDI5OCwidXNlcl9pZCI6IjEwMDAwMTg1NjA3NTI5OCJ9';
            // echo '<br> Host: ';
             //echo $hostStores;
             //echo '<br>';
             //print_r($headerStores) ;
            $jsonStores = global_common::getDataUrl($hostStores,$headerStores,$cookieHeader); 
            //echo $jsonStores;
            global_common::writeToFile($filePath,$jsonStores);
            echo '<br>';
            echo 'Got Foody stores of cat_'.$catID.'_page_'.$pageIndex;
            $allStores = json_decode($jsonStores, true);
            //sleep 10 second
            sleep(30 * (1436885463%9 +1 ));
            //break;
            // return;
        }
        //break;
       // return;
    }  
    //return;
}

?>