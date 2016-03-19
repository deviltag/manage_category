<!Doctype html>
<html>
<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">

<script type="text/javascript">
	$(function(){
		$("#begin,#to").sortable({

			contanment:'document',tolerance:'pointer',cursor:'pointer',revert:'true',
			opacity:'0.60',connectWith:"#begin,#to",
			update: function(){
				div1 = $('#begin').text();
				document.test.data1.value= div1;
				$('#newlist1').text(div1);

				div2 = $('#to').text();
				document.test.data2.value = div2;
				$('#newlist2').text(div2);
			}
	
		});
	});
</script>
<title>move item in Category</title>
<form name="test" action="save.php" method="post">
<input type='text' name='data1' id="te1">
<input type='text' name='data2' id="te2">
</form>
</head>
<body onLoad="items()">
<?php 
if(!empty($_GET['t_select'])){
$t_select=$_GET['t_select'];}else{$t_select="";}

if(!empty($_GET['b_select'])){
$b_select=$_GET['b_select'];}else{$b_select="";}
	require("connect_apisubcate.php");
	
	?>
<div id="header"><h1>header</h1>
</div>
<div id="select">

</div>
<div id="treeview" class="col-md-3 treeview"><?php 
echo "<select  class='form-control'  onChange='return select_function(this)'>";
echo "<option value='1'>--  Family --</option>";
echo "<option value='2' >--  Department --</option>";
echo "<option value='3' selected='selected' >--  Category --</option>";
echo "<option value='4' >-- Sub Cate --</option>";
echo "</select>"; ?></div>

<div id="beginmove" class="col-md-4 beginmove">
<?php

$b_out=json_decode($subcate,true);
$b_result = array();
foreach ($b_out as $b_row) {
  $b_result[$b_row['code']]['code'] = $b_row['code'];
  $b_result[$b_row['code']]['thaiName'] = $b_row['thaiName'];
 
}
  $b_result = array_values($b_result);

      
$bnt=count($b_result);
$b_dd = array_values($b_result);
echo "เลือก Category ต้นทาง : <select class='form-control' id='sbegin' onchange='return be_select(this);'>";
echo "<option value='0'>-- เลือก Category ต้นทาง --</option>";

for($b=0;$b<$bnt;$b++){
	if($b_result[$b]['code']==$b_select){
echo "<option selected='selected' value='".$b_result[$b]['code']."'>".$b_result[$b]['thaiName']." ".$b_result[$b]['code']."</option>";
}else{
echo "<option value='".$b_result[$b]['code']."'>".$b_result[$b]['thaiName']." ".$b_result[$b]['code']."</option>";
	}
	}
	echo "</select>";
echo"<div id=begin></div>";

$b_data = array (
	"subCatCode" => $b_select
	);
$b_data_string = json_encode($b_data); 
$b_ch = curl_init();
curl_setopt($b_ch, CURLOPT_URL,"http://192.168.0.250:8080/NPCateWS/category/itemcatch");
curl_setopt($b_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($b_ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($b_ch, CURLOPT_POST, true);
curl_setopt($b_ch, CURLOPT_POSTFIELDS, $b_data_string);
curl_setopt($b_ch, CURLOPT_HEADER, true);
curl_setopt($b_ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($b_data_string)                                                                       
));       
$b_output = curl_exec($b_ch);
$b_item = "[";
$b_sub = explode(":[",$b_output);
$b_item .= substr($b_sub[1],0,-1);
//echo $b_item;


?>

</div></div>

<div id="moveto" class="col-md-4 moveto">
<?php  	
$out=json_decode($subcate,true);
$result = array();
foreach ($out as $row) {
  $result[$row['code']]['code'] = $row['code'];
  $result[$row['code']]['thaiName'] = $row['thaiName'];
 
}
  $result = array_values($result);

      
$cnt=count($result);
$dd = array_values($result);
echo "เลือก Category ปลายทาง : <select class='form-control' id='sto' onchange='return to_select(this);'>";

echo "<option value='0'>-- เลือก Category ปลายทาง --</option>";
for($t=0;$t<$cnt;$t++){
if($result[$t]['code']==$t_select){
echo "<option selected='selected' value='".$result[$t]['code']."'>".$result[$t]['thaiName']." ".$result[$t]['code']."</option>";
}else{
echo "<option value='".$result[$t]['code']."'>".$result[$t]['thaiName']." ".$result[$t]['code']."</option>";

	}
}
	echo "</select>";
echo"<div id=to></div>";

$t_data = array (
	"subCatCode" => $t_select
	);
$t_data_string = json_encode($t_data); 
$t_ch = curl_init();
curl_setopt($t_ch, CURLOPT_URL,"http://192.168.0.250:8080/NPCateWS/category/itemcatch");
curl_setopt($t_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($t_ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($t_ch, CURLOPT_POST, true);
curl_setopt($t_ch, CURLOPT_POSTFIELDS, $t_data_string);
curl_setopt($t_ch, CURLOPT_HEADER, true);
curl_setopt($t_ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($t_data_string)                                                                       
));       
$t_output = curl_exec($t_ch);
$t_item = "[";
$t_sub = explode(":[",$t_output);
$t_item .= substr($t_sub[1],0,-1);
//echo $t_item;

?>

	</div></div>
	<p>


<div id="newlist1" style="clear:both;"></div><br>
<div id="newlist2" style="clear:both;"></div>

	
	<p>
<div style='clear:both'>
	<br><hr>
<form name="show" action="save.php" method="post">
<div style='display:none'>
<input type='text' name='data1'>
<input type='text' name='data2'></div>
<input type='submit' value="save"  class="btn btn-success">
</form>
</div>
</div>
<script>
	function select_function(str){
		if(str.value==1){
		window.location="move_family.php";
		}else if(str.value==2){
		window.location="move_department.php";
		}else if(str.value==3){
		window.location="move_cate.php";
		}else if(str.value==4){
		window.location="move_subcate.php";
		}
		}
		
		function be_select(be){
			var to = document.getElementById("sto").value
			window.location="test.php?b_select="+be.value+"&t_select="+to;
			}
			function to_select(to){
			var be = document.getElementById("sbegin").value
			window.location="test.php?t_select="+to.value+"&b_select="+be;
			}
</script>

<script>
function items(){

var b_str = <?php echo $b_select?>;
var b=0;
var b_data = <?php echo $b_item?>;
var b_count = b_data.length;
var b_all="";
while(b < b_count){
	
	b_all+="<div>" + b_data[b].itemCode +" "+ b_data[b].itemName+"</div>";
b++;
}
	document.getElementById("begin").innerHTML = b_all;	
	
	if(b_str){
		 $("#sto option[value="+b_str+"]").hide();
		 $("#sto option[value!="+b_str+"]").show();
	}
		
		
		
var t_str = <?php echo $t_select?>;
var t=0;
var t_data = <?php echo $t_item?>;
var t_count = t_data.length;
var t_all="";
while(t < t_count){
	
	t_all+="<div>" + t_data[t].itemCode +" "+ t_data[t].itemName+"</div>";
t++;
}
	document.getElementById("to").innerHTML = t_all;	
	
	if(t_str){
		 $("#sbegin option[value="+t_str+"]").hide();
		 $("#sbegin option[value!="+t_str+"]").show();
	}

	}	  

                    </script>
</body>
</html>