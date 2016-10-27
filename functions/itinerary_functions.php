<?php

// takes a given 'driver' and returns and array containing all the route data that they must make within -1/+6 hrs of the current time.
function makeArray($driver){
	
	$date = time(); //get time of now
	
	// grab the necessary data ~ time, location, order ID 
	if($driver != NULL){
		$origin = GrabMoreData("SELECT  pickup, origin, ID FROM delivery WHERE pickup<".($date+21600)." AND pickup>".($date-3600)." AND driver= :email", array(array(':email', $driver)));
		$dest = GrabMoreData("SELECT dropoff, destination, ID FROM delivery WHERE dropoff<".($date+21600)." AND dropoff>".($date-3600)." AND driver= :email", array(array(':email', $driver)));
	}else{
		$origin = GrabMoreData("SELECT  pickup, origin, ID FROM delivery WHERE pickup<".($date+21600)." AND pickup>".($date-3600)." AND driver IS :email", array(array(':email', $driver)));
		$dest = GrabMoreData("SELECT dropoff, destination, ID FROM delivery WHERE dropoff<".($date+21600)." AND dropoff>".($date-3600)." AND driver IS :email", array(array(':email', $driver)));
	}
	
	//Make sure there is actually data
	if($origin || $dest){
		
		//sort by time
		array_multisort($origin);
		array_multisort($dest);
		
		// used to store maximum inexes of the arrays
		$total = count($origin) + count($dest);
		$origin_count = 0;
		$dest_count = 0;
		
		$new_arr = array(array()); // new array
		
		for ($i =0; $i < $total; $i++)
		{
			if($origin_count == count($origin)) 	// All of Origin has been added to the new array
			{
				$new_arr[] = $dest[$dest_count];	
				$dest_count++;
			}elseif($dest_count == count($dest))	// All of Destination has been added to the new array
			{
				$new_arr[] = $origin[$origin_count];
				$origin_count++;
			}elseif($origin[$origin_count]['pickup'] < $dest[$dest_count]['destination']) // Current Origin index < Current destination index
			{
				$new_arr[] = $origin[$origin_count];
				$origin_count++;
			}elseif($origin[$origin_count]['pickup'] > $dest[$dest_count]['destination'])  // Current Origin index > Current destination index
			{
				$new_arr[] = $dest[$dest_count];
				$dest_count++;
			}
		}
		return $new_arr;
	}else{
		return NULL; // only if there was initially NULL Data
	}
	
}


// Uses the data from makeArray and outups it in a table with usuable HTML
function makeTable($arr){
	
	// catch for NULL data
	if($arr == NULL){
		return;
	}
	
	
	$htmlData = "<div id='table_holder'><table><tr>"; 	// initialise table
	
	// Headers of the table
	$htmlData = $htmlData.'<th>Time</th>';				
	$htmlData = $htmlData.'<th>Location</th>';
	$htmlData = $htmlData.'<th>Action</th>';
	$htmlData = $htmlData.'<th>Delivery ID</th>';
	
	$keys = [[]];
	$num = count($arr);
	
	// Itterates through the given data
	for ($i = 1; $i < count($arr); $i++){
		$keys[] = array_keys($arr[$i]);	// needed to figure out if the current iten is from a Pickup or Dropoff
		if(arr[$i]){
			$htmlData = $htmlData."<tr>"; //start row
		
			$htmlData = $htmlData."<td>";
			$htmlData = $htmlData.date("h:i A ", $arr[$i][$keys[$i][0]]);	// Date
			$htmlData = $htmlData."</td><td>";
			$htmlData = $htmlData.$arr[$i][$keys[$i][1]];	// Location
			$htmlData = $htmlData."</td><td>";
			$htmlData = $htmlData.(ucfirst($keys[$i][0]));	// Action of the package ~ Pickup or Dropoff
			$htmlData = $htmlData."</td><td>";
			$htmlData = $htmlData.$arr[$i]['ID'];			// Delivery ID ~ so the driver knows what to update
			$htmlData = $htmlData."</td>";
			
			$htmlData = $htmlData."</tr>";	// End row
		}
	}
	$htmlData = $htmlData."</table></div><br/><br/>";	// end Table
	
	return $htmlData; // Return the HTML
}



?>