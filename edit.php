<?php
echo "<meta charset='utf-8'>";

if($_GET['title']=="items"){
echo "หมวดหมู่ :".$_GET['title']."<hr>";
echo "subcate :".$_GET['parent']."<hr>";
echo "ID :".$_GET['code']."<hr>";
echo "ชื่อสินค้า :".$_GET['Thainame']."<hr>";
echo "หน่วยนับ :".$_GET['unitcode']."<hr>";
}else{

switch ($_GET['title']) {
	case 'family':
		$_GET['title']=0;
		break;
	
	case 'Department':
		$_GET['title']=1;
		break;

	case 'category':
		$_GET['title']=2;
		break;

	case 'subcate':
		$_GET['title']=3;
		break;
}
/*echo "หมวดหมู่ :".$_GET['title']."<hr>";
echo "main node :".$_GET['parent']."<hr>";
echo "ID :".$_GET['code']."<hr>";
echo "ชื่อไทย :".$_GET['Thainame']."<hr>";
echo "ชื่ออังกฤษ :".$_GET['Engname']."<hr>";
echo "หมายเหตุ :".$_GET['remark']."<hr>";
*/
$data = array (
	"levelID" => $_GET['title'],
	"code" => $_GET['code'],
	"thaiName" => $_GET['Thainame'],
	"engName" => $_GET['Engname'],
	"remark" => $_GET['remark']
	);
// json encode data
$myfile = fopen("setting/update.txt","r") or die("Unable to open file!");
$urlupdate = fgets($myfile);;
fclose($myfile);
$data_string = json_encode($data); 
// the token
$token = 'your token here';
// set up the curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$urlupdate);
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
//echo $output;

}


echo "<script>window.location='index.php'</script>";
?>