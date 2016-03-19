<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<?php
$data = array (	""=>""	);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://192.168.0.250:8080/NPCateWS/category/family");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
                                                                        
));       
// execute the request
$output = curl_exec($ch);

$end = "[";
$sub = explode("[",$output);
$end .= substr($sub[1],0,-1);
//echo $end;



?>