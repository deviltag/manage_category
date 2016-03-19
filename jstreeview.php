<!DOCTYPE html>
<head>
	<title>jstree basic demos</title>  
	<link rel="stylesheet" href="dist\themes\default\style.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">

</head>
<body>
	<?php 
	if(empty($_GET['id'])){ $get_id ="";}else{$get_id = $_GET['id'];} 		
	?>
<div id="header"><h1>header</h1></div>
<div id="left" class="col-md-3 jstreeleft">
    Search : <input class="search-input form-control search"></input>
    <div><b>ROOT</b></div>


<div id="jstreeleft">
   
</div>
</div>

<div id="jstreeright" class="col-md-7 jstreeright">
   
	<?php
	if($get_id != ""){
			$str = $_GET['id'];
			$arr = explode(";",$str);
			$data = explode(":",$arr[1]);
			
			$id= $data[1];
			$name= $arr[0];
			$data= $data[0];

			$data = trim($data);

		if($data == 'vw_IV_catsubcategory'){
			echo "Item in Subitem : $id Cate Name: $name";
			echo "<table border='1' width='100%'>";
			echo "<tr><th>ID</th><th>Name</th><th>Delete</th></tr>";

		 	$sqlitem =  "select * from bcitem where categorycode = '$id' ORDER BY 'ASC'"; 
			$item = odbc_exec($connection, $sqlitem);

			while(odbc_fetch_row($item)){
				$itemid = odbc_result($item, 2);
				$itemname = odbc_result($item, 3);

			echo "<tr><td>".$itemid."</td><td>".$itemname."</td><td align='center'><button id='delete' class='btn btn-danger btn-block' value='".$itemid."' onClick='return delete_item(this)'>delete</button></td></tr>";

			}

			echo "</table>";
		}else{

		echo "Category Name: $data";
		echo "<div id='table'>";
		echo "<table width=100%>";
		echo "<tr><th>ID</th><th>Name</th></tr>";

		echo "<tr><td colspan='2' align='center'><h1>Not item</h1></td></tr>";

		echo "</table>";
		echo "</div>";
		}
	}else{
		echo"<p>ไม่มีข้อมูล</p>";
	}
?>

</div>
<div id="menu" class="col-md-2 main">
	<br>
<from action='detail_insert.php' method='GET'>
	<div class="ltext">
	<input type='text' name='id' value='<?php echo $_GET['id']; ?>' class="form-control">
	</div>
	<div class="rtext"><button class="btn btn-primary btn-block"> Add </button></div>
</form>
<br><br>
<from action='detail_Move.php' method='GET'>
	<div class="ltext">
	<input type='text' name='id' value='<?php echo $_GET['id']; ?>' class="form-control">
	</div>
	<div class="rtext"><button class="btn btn-primary btn-block"> Move </button></div>
</form>
<br><br>
<from action='delete.php' method='GET'>
	<div class="ltext">
	<input type='text' name='id' value='<?php echo $_GET['id']; ?>' class="form-control">
	</div>
	<div class="rtext"><button class="btn btn-primary btn-block">delete</button></div>
</form>
</div>
<?php
//============================================ family ============================================================
echo "<div style='display:none;'>";
require("connect_apifamily.php");
$out_w=json_decode($end,true);
echo "</div>";

$result = array();
$cntf=0;
foreach ($out_w as $row) {
  $result[$row['code']]['code'] = $row['code'];
  $result[$row['code']]['thaiName'] = $row['thaiName'];
 
}
  $result = array_values($result);

      $fam = array();
      foreach ($result as $k => $v) {
      $fam['code'][$k] = $v['code'];
      $fam['thaiName'][$k] = $v['thaiName'];
      
    }
    array_multisort($fam['code'],SORT_ASC,$result);
    $cntf=count($result);
//==========================================================================================================///
//==================================================== Department =========================================////
    	echo "<div style='display:none;'>";
		require("connect_apiDepartment.php");
		$out_D=json_decode($Depart,true);
		echo "</div>";

		$rdepart = array();
		$cntD=0;
		foreach ($out_D as $row) {
		  $rdepart[$row['code']]['code'] = $row['code'];
		  $rdepart[$row['code']]['thaiName'] = $row['thaiName'];
		  $rdepart[$row['code']]['parentCode'] = $row['parentCode'];
		 
		}
		  $rdepart = array_values($rdepart);

		      $De = array();
		      foreach ($rdepart as $k => $v) {
		      $De['code'][$k] = $v['code'];
		      $De['thaiName'][$k] = $v['thaiName'];
		      $De['parentCode'][$k] = $v['parentCode'];
		      
		    	}
		    array_multisort($De['code'],SORT_ASC,$rdepart);
		    $cntD=count($rdepart);
//==============================================================================================================
//==================================================== category =========================================////
    	echo "<div style='display:none;'>";
		require("connect_apicategory.php");
		$out_C=json_decode($cate,true);
		echo "</div>";

		$rcate = array();
		$cntC=0;
		foreach ($out_C as $row) {
		  $rcate[$row['code']]['code'] = $row['code'];
		  $rcate[$row['code']]['thaiName'] = $row['thaiName'];
		  $rcate[$row['code']]['parentCode'] = $row['parentCode'];
		 
		}
		  $rcate = array_values($rcate);

		      $Ca = array();
		      foreach ($rcate as $k => $v) {
		      $Ca['code'][$k] = $v['code'];
		      $Ca['thaiName'][$k] = $v['thaiName'];
		      $Ca['parentCode'][$k] = $v['parentCode'];
		      
		    	}
		    array_multisort($Ca['code'],SORT_ASC,$rcate);
		    $cntC=count($rcate);
//==============================================================================================================
//==================================================== subcate =========================================////
    	echo "<div style='display:none;'>";
		require("connect_apisubcate.php");
		$out_S=json_decode($subcate,true);
		echo "</div>";

		$rsub = array();
		$cntS=0;
		foreach ($out_S as $row) {
		  $rsub[$row['code']]['code'] = $row['code'];
		  $rsub[$row['code']]['thaiName'] = $row['thaiName'];
		  $rsub[$row['code']]['parentCode'] = $row['parentCode'];
		 
		}
		  $rsub = array_values($rsub);

		      $Sub = array();
		      foreach ($rsub as $k => $v) {
		      $Sub['code'][$k] = $v['code'];
		      $Sub['thaiName'][$k] = $v['thaiName'];
		      $Sub['parentCode'][$k] = $v['parentCode'];
		      
		    	}
		    array_multisort($Sub['code'],SORT_ASC,$rsub);
		    $cntS=count($rsub);
//==============================================================================================================
?>


	<script src="dist\jstree.min.js"></script>
	<script >
$(function() {

    $(".search-input").keyup(function() {

        var searchString = $(this).val();
        console.log(searchString);
        $('#jstreeleft').jstree('search', searchString);
    });

    

    $('#jstreeleft').jstree({
        'core': {
        	'data': [
<?php
////============================================  family ======================================================
  for($i=0;$i<$cntf;$i++){
    echo '{ "id" : "'.$fam['code'][$i].'", "parent" : "#", "text" : "'.$fam['thaiName'][$i].'"},';
    ////================================================ Department =================================================
    	
		     for($d=0;$d<$cntD;$d++){
		     	if($De['parentCode'][$d]==$fam['code'][$i]){
			    echo '{ "id" : "'.$De['code'][$d].'", "parent" : "'.$fam['code'][$i].'", "text" : "'.$De['thaiName'][$d].'"},';
				//=============================================== Category  =====================================================	
					for($c=0;$c<$cntC;$c++){
				     	if($Ca['parentCode'][$c]==$De['code'][$d]){
					    echo '{ "id" : "'.$Ca['code'][$c].'", "parent" : "'.$De['code'][$d].'", "text" : "'.$Ca['thaiName'][$c].'"},';
						    //============================================= subCate =====================================================
						    for($s=0;$s<$cntS;$s++){
						     	if($Sub['parentCode'][$s]==$Ca['code'][$c]){
							    echo '{ "id" : "'.$Sub['code'][$s].'", "parent" : "'.$Ca['code'][$c].'", "text" : "'.$Sub['thaiName'][$s].'"},';
								}
							}
						}
					}
			 
				}
			}

  }

?>

        ] ,  

		"check_callback" : true,

        },
        "animation" : 0,
	    
	    "themes" : { "stripes" : true },

        "search": {

            "case_insensitive": true,
            "show_only_matches" : true

        },

        "plugins": ["search","dnd"]
        	
    });
    /*$("#jstreeleft").bind('loaded.jstree', function (event, data) { 
	$("#jstreeleft").jstree("open_all",id);

	//$("#jstreeleft").jstree("open_all","vw_IV_catfamily:00009");
	});*/


});

$('#jstreeleft')
  // listen for event
  .on('select_node.jstree', function (e, data) {

    var i, j, r = [], s = [];t = [];
    for(i = 0, j = data.selected.length; i < j; i++) {
     r.push(data.instance.get_node(data.selected[i]).text);
      r.push(data.instance.get_node(data.selected[i]).id);
	  s.push(data.instance.get_node(data.selected[i]).id);
	  
      //r.push(data.instance.get_node(data.selected[i]).parent);
    }
	//alert(r.join())
	//alert(s.join())
    //document.getElementById("xxx").value = r.join(', ');
   
  window.location="jstreeview.php?id="+r.join('; ')+"&pid="+s.join();  
  });

  function delete_item(str){
	alert(str.value)
	
	}
	</script>
</body>
</html>