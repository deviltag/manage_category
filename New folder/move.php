<!Doctype html>
<html>
<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/style.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <meta http-equiv=Content-Type content="text/html; charset=tis-620">
<form name="test" action="save.php" method="post">
<input type='text' name='data1' id="te1">
<input type='text' name='data2' id="te2">
<input type="submit">
</form>
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
<div>
<div id="header"><h1>header</h1></div>
<div id="treeview" class="col-md-4 treeview"></div>
<div id="beginmove" class="col-md-4 beginmove">

		<?php
		
		
		 $sqld =  "SELECT * FROM vw_IV_catdepartment"; 
   		 $depart = odbc_exec($connection, $sqld);
    	while(odbc_fetch_row($depart)){
			
			$depart_name = odbc_result($depart, 6);
			echo "<div>".$depart_name."</div>";
    		
    		/*$fdid = odbc_result($depart, 1);
			echo "<div>".$fdid."</div>";
    		$did = odbc_result($depart, 2);
		    $dname = odbc_result($depart, 6);
*/

								}

	?>

</div>
<div id="moveto" class="col-md-4 moveto">

	<?php
	$linkOld = "explode2.txt";
	$lopen = fopen($linkOld, 'r');     
    $linkO = fgets($lopen, 4096);  
    fclose($lopen); 
    	$arr = explode(",", $linkO);
    	$count=count($arr);
    	for($i=0;$i<$count;$i++){
    	echo "<div>".$arr[$i]."&nbsp;</div>";
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
</body>
</html>