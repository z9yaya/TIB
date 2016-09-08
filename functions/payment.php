<?php
//generates a table of the inputted data
//Will work with data collected from GrabMoreData
//NOT tested for data collected from GrabData
function generateForm($data){
	$dat = $data;
	echo "<table border=2 width=100%><tr>";
	while ($id = current($dat[0])) {
		if($id){
			echo "<th>".key($data[0])."</th>";
		}
		next($data[0]);
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
	echo "</table>";
}
?>