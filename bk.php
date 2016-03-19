<!Doctype html>
<html>
<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/style.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <meta http-equiv=Content-Type content="text/html; charset=tis-620">

<script type="text/javascript">
	$(function(){
		$("#beginmove,#moveto").sortable({

			contanment:'document',tolerance:'pointer',cursor:'pointer',revert:'true',
			opacity:'0.60',connectWith:"#beginmove,#moveto",
			update: function(){
				div1 = $('#beginmove').text();
				document.test.data1.value= div1;
				$('#newlist1').text(div1);

				div2 = $('#moveto').text();
				document.test.data2.value = div2;
				$('#newlist2').text(div2);
			}
	
		});
	});
</script>
</head>
<body>
<?php 
	require("connect_nebula2.php");
	

		
	?>
<div id="header"><h1>header</h1>
<?php

?>

</div>
<div id="select">

</div>
<div id="treeview" class="col-md-4 treeview"></div>
<div id="beginmove" class="col-md-4 beginmove">

		<?php
		if(empty($_GET['begin_id'])){$be_id="";}
		else{$be_id=$_GET['begin_id'];}
		
echo "<select onChange='return begin_id(this)'>";
 $beginfamily =  "SELECT * FROM vw_IV_catfamily ORDER BY 'ASC'";
	 $b_family = odbc_exec($connection, $beginfamily);
    	while(odbc_fetch_row($b_family)){
			$family_id = odbc_result($b_family,1);
			$family_name = odbc_result($b_family,6);
			if($be_id==$family_id){
			echo "<option value=".$family_id." selected='selected'>".$family_name."</option>";
		}else{echo "<option value=".$family_id." >".$family_name."</option>";}
		}
		echo"</select>";
		if($be_id!=""){
		
		 $sql =  "SELECT * FROM vw_IV_catdepartment WHERE vw_IV_catdepartment.familycode = $be_id ORDER BY 'ASC'"; 
   		 $depart = odbc_exec($connection, $sql);
    	while(odbc_fetch_row($depart)){
			
			$depart_id= odbc_result($depart, 1);
			$depart_name = odbc_result($depart, 6);
			echo "<div>".$depart_name,$depart_id."</div>";
		}
		}
	?>

</div>
<div id="moveto" class="col-md-4 moveto">

	<?php
	if(empty($_GET['to_id'])){$to_id="";}
		else{$to_id=$_GET['to_id'];}
		
echo "<select onChange='return to_id(this)'>";
 $to_family =  "SELECT * FROM vw_IV_catfamily ORDER BY 'ASC'";
	 $t_family = odbc_exec($connection, $to_family);
    	while(odbc_fetch_row($t_family)){
			$to_family_id = odbc_result($t_family,1);
			$to_family_name = odbc_result($t_family,6);
			if($to_id==$to_family_id){
			echo "<option value=".$to_family_id." selected='selected'>".$to_family_name."</option>";
		}else{echo "<option value=".$to_family_id." >".$to_family_name."</option>";}
		}
		echo"</select>";
		if($to_id!=""){
		
		 $sql2 =  "SELECT * FROM vw_IV_catdepartment WHERE vw_IV_catdepartment.familycode = $to_id ORDER BY 'ASC'"; 
   		 $to_depart = odbc_exec($connection, $sql2);
    	while(odbc_fetch_row($to_depart)){
			
			$to_depart_id= odbc_result($to_depart, 1);
			$to_depart_name = odbc_result($to_depart, 6);
			echo "<div>".$to_depart_name,$to_depart_id."</div>";
		}
		}
	?>

	</div>
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
<input type='submit' value="save">
</form>
</div>
</div>
<script>
function begin_id(str){
	//alert(str.value)
	 window.location="move_cat.php?begin_id="+str.value+"&to_id=<?php echo $to_id;?>";
	}
function to_id(str){
	alert(str.value)
	  window.location="move_cat.php?to_id="+str.value+"&begin_id=<?php echo $be_id;?>";
	}
</script>
</body>
</html>