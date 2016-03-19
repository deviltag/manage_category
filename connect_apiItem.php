<?php
/**
 *  Example API call
 *  Create a new profile in a database
 */
// the databaseID
//$databaseID = 1;
/*$linkOld = "data_linkAPI/link_api.txt";
	$lopen = fopen($linkOld, 'r');     
    $linkO = fgets($lopen, 4096);    
    fclose($lopen); */

$data = array (
	"subCatCode" => "954"
	);
// json encode data
$data_string = json_encode($data); 
// the token
$token = 'your token here';
// set up the curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://192.168.0.250:8080/NPCateWS/category/itemcatch");//http://s01xp.dyndns.org:8080/SmartQWs/pickup/search");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)                                                                       
));       
// execute the request
$output = curl_exec($ch);
// output the profile information - includes the header
//echo $output."<br>";
//$sub = substr($output,9);
$item = "[";
$sub = explode("[",$output);
$item .= substr($sub[1],0,-1);
//echo $item;


?>