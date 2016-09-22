<?php 

//Creates an array based on a select query and converts time to 12 hour format for display on delivery change page

function getInfo($ID)
{
   $result = GrabMoreData("SELECT origin, destination, name, pickup, dropoff, special FROM delivery WHERE ID = :ID", array(array("ID", $ID)));
    $result[0]['pickupDate'] = date('Y-m-d', $result[0]['pickup']);
    $result[0]['dropDate'] = date('Y-m-d', $result[0]['dropoff']);
    $result[0]['pickupTime'] = date('h:i A', $result[0]['pickup']);
    $result[0]['dropTime'] = date('h:i A', $result[0]['dropoff']);
    return $result[0];
    
    
}


?>