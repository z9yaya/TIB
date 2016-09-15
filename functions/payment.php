<?php
//generates a table of the inputted data
//Will work with data collected from GrabMoreData
//NOT tested for data collected from GrabData
function generateForm($data){
	echo "<div id='table_holder'>";
	echo "<table><tr>";
	
	$arrKey = $data[0];
	
	while (current($arrKey)) {
		echo "<th>".key($arrKey).'</th>';
		next($arrKey);
	}
	foreach($data as $arr1){
		echo "</tr><tr>";
		foreach($arr1 as &$arr){
			echo "<td>";
			if($arr > 1000000000){
				echo date("d-m-Y", $arr)."<br/>".date("h:i A", $arr);
			}else{
				echo $arr;
			}
			echo "</td>";
		}
	}
	echo "</tr>";
	echo "</table></div>";
}
?>