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
<body>
<?php 
	require("connect_apicategory.php");
	
	

		
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

$b_out=json_decode($cate,true);
$b_result = array();
foreach ($b_out as $b_row) {
  $b_result[$b_row['code']]['code'] = $b_row['code'];
  $b_result[$b_row['code']]['thaiName'] = $b_row['thaiName'];
 
}
  $b_result = array_values($b_result);

      
$bnt=count($b_result);
$b_dd = array_values($b_result);
echo "เลือก Category ต้นทาง : <select class='form-control' onchange='return begin_id(this);'>";
echo "<option value=''>-- เลือก Category ต้นทาง --</option>";

for($b=0;$b<$bnt;$b++){
echo "<option value='".$b_result[$b]['code']."'>".$b_result[$b]['thaiName']." ".$b_result[$b]['code']."</option>";}
	
	echo "</select>";
echo"<div id=begin></div>";
require("connect_apisubcate.php");
?>
<script>
function begin_id(str){
var i=0;
var data = <?php echo $subcate?>;
var count = data.length;
var allt="";
while(i < count){
	if(data[i].parentCode == str.value){
	
	allt+="<div>" + data[i].code +" "+ data[i].thaiName+"</div>";}
	else{allt+=""}
i++;
}
	document.getElementById("begin").innerHTML = allt;			  
}
                    </script>

</div></div>

<div id="moveto" class="col-md-4 moveto">
<?php  	
$out=json_decode($cate,true);
$result = array();
foreach ($out as $row) {
  $result[$row['code']]['code'] = $row['code'];
  $result[$row['code']]['thaiName'] = $row['thaiName'];
 
}
  $result = array_values($result);

      
$cnt=count($result);
$dd = array_values($result);
echo "เลือก Category ปลายทาง : <select class='form-control' onchange='return to_id(this);'>";
echo "<option value=''>-- เลือก Category ปลายทาง --</option>";
for($t=0;$t<$cnt;$t++){
echo "<option value='".$result[$t]['code']."'>".$result[$t]['thaiName']." ".$result[$t]['code']."</option>";}
	
	echo "</select>";
echo"<div id=to></div>";
require("connect_apisubcate.php");
?>
<script>
function to_id(str){
var i=0;
var data = <?php echo $subcate?>;
var count = data.length;
var allt="";
while(i < count){
	if(data[i].parentCode == str.value){
	
	allt+="<div>" + data[i].code +" "+ data[i].thaiName+"</div>";}
	else{allt+=""}
i++;
}
	document.getElementById("to").innerHTML = allt;			  
}
                    </script>
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
</script>
</body>
</html>