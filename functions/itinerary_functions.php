<?php

function makeArray($driver){
	
	$date = time();
	
	$origin = GrabMoreData("SELECT  pickup, origin FROM delivery WHERE pickup<".($date+28800)." AND pickup>".($date-3600)." AND driver= :email", array(array(':email', $driver)));
	$dest = GrabMoreData("SELECT dropoff, destination FROM delivery WHERE dropoff<".($date+28800)." AND dropoff>".($date-3600)." AND driver= :email", array(array(':email', $driver)));
	if($origin || $dest){
		array_multisort($origin);
		array_multisort($dest);
		$total = count($origin) + count($dest);
		$origin_count = 0;
		$dest_count = 0;
		$new_arr = array(array());
		for ($i =0; $i < $total; $i++)
		{
			if($origin_count == count($origin))
			{
				$new_arr[] = $dest[$dest_count];
				$dest_count++;
			}elseif($dest_count == count($dest))
			{
				$new_arr[] = $origin[$origin_count];
				$origin_count++;
			}elseif($origin[$origin_count]['pickup'] < $dest[$dest_count]['destination'])
			{
				$new_arr[] = $origin[$origin_count];
				$origin_count++;
			}elseif($origin[$origin_count]['pickup'] > $dest[$dest_count]['destination'])
			{
				$new_arr[] = $dest[$dest_count];
				$dest_count++;
			}
		}
		return $new_arr;
	}else{
		return NULL;
	}
	
}


function makeTable($arr){
	if($arr == NULL){
		return;
	}
	$htmlData = "<div id='table_holder'><table><tr>";
	$htmlData = $htmlData.'<th>Time</th>';
	$htmlData = $htmlData.'<th>Location</th>';
	$htmlData = $htmlData.'<th>Action</th>';
	
	$keys = [[]];
	$num = count($arr);
	
	for ($i = 1; $i < count($arr); $i++){
		$keys[] = array_keys($arr[$i]);
		
		$htmlData = $htmlData."<tr>";
		
		$htmlData = $htmlData."<td>";
		$htmlData=$htmlData.date("h:i A ", $arr[$i][$keys[$i][0]]);
		$htmlData = $htmlData."</td><td>";
		$htmlData = $htmlData.$arr[$i][$keys[$i][1]];
		$htmlData = $htmlData."</td><td>";
		$htmlData = $htmlData.$keys[$i][0];
		
		$htmlData = $htmlData."</tr>";
	}
	$htmlData = $htmlData."</table></div>";
	
	return $htmlData;
}



?>