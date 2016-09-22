<?php 
include '../functions/functions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Deliveries - drop.it</title>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
         <link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
		 <link async href="../css/deliveriescss.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
		
<style>
    .Hide
{
    //display: none;
}
</style>
<script type="text/javascript">
    function toggle_visibility(id, Object) {
		console.log("stuff");
       var Td = Object.parentElement;
	   console.log(Td);
       var Parent = Td.parentElement;
	   console.log(Parent);
	   var sibling = Parent.nextSibling;
	   console.log(sibling);
       var e = sibling.getElementsByClassName(id);
	   
        for (var i = 0; i < e.length; i++)
            {
				console.log(e[i]);
       if(e[i].style.display == 'table-row')
          e[i].style.display = 'none';
       else
          e[i].style.display = 'table-row';
            }
	}
</script>
    </head>
    <body>
        <div id="back_nav">
			<div id="wrapper" style='min-height: 0px;'>
				<header>
					<a id="login_blue" class="menu menu_blue" href="login.php"><?php 
																			if (session_id() == '')
																			{
																				session_start();
																			}
																			if(isset($_SESSION['email']))
																				echo 'SIGN OUT</a>';
																			else
																			{
																				header("Location: login.php?error=deliveries");
																				echo 'SIGN IN</a>';
																			}?>
					
						<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
                       
					<a id="deliveries" class="menu menu_blue selected" href="deliveries.php">DELIVERIES</a>
                         <?php 
                            if(isset($_SESSION['position']))
                            {
                                if ($_SESSION['position'] != 'driver')
                                {
                                     echo '<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
					                <a id="new" class="menu menu_blue" href="request.php">REQUEST</a>';	
                                }
                                else if ($_SESSION['position'] == 'driver')
                                {
                                     echo '<a id="log" class="menu menu_blue" href="driver.php">LOG</a>';
                                }
                            }
                            else
                                    {
                                         echo '<a id="tracking" class="menu menu_blue" href="pages/tracking.php">TRACKING</a>
                                        <a id="new" class="menu menu_blue" href="pages/request.php">REQUEST</a>';	
                                    }
                        ?>
				
				</header>
			</div>
<div id="deliverieswrapper">			
					<div id="content">
					<div id="form">
					
      <?php
	  $servername = "localhost";
	  $username = "edit";
	  $password = "editme";
	  $dbname = "tib";

	  $conn = new mysqli($servername, $username, $password, $dbname);
	  
	  if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);}	  
	  ?>
	  
	  <?php
      $deliveryresult = GrabMoreData("SELECT * FROM delivery WHERE user = :email AND status != 'Delivered'", array(array(":email", $_SESSION['email'])));
	  foreach($deliveryresult as $data)
	  {
		  $package = GrabData("package", "delivery_ID, content, weight", "delivery_ID", $data['ID']);
		  foreach ($package as $pack)
		  $packageresult[]= $pack;
	  }
	  
	  
	  
	  $statusresult = GrabMoreData("SELECT * FROM delivery WHERE user = :email AND status = 'Delivered'", array(array(":email", $_SESSION['email'])));	  	
	  foreach($statusresult as $data)
	  {
		  $statuspackage = GrabData("package", "delivery_ID, content, weight", "delivery_ID", $data['ID']);
		  foreach ($statuspackage as $pack)
		  $statuspack[]= $pack;
	  }  
	  
	  
		if ($deliveryresult != false) 
		{
            echo '<span class="sign_title">Ongoing Deliveries</span><br>
	  <div id="table_deliveries">
      <table>
      <thead>
        <tr>
          <th>Delivery ID</th>
     	  <th>Origin</th>
		  <th>Destination</th>
		  <th>Recipient</th>
		  <th>Pick Up</th>
		  <th>Drop Off</th>
		  <th>Cost($)</th>
		  <th>Type</th>
		  <th>Date Paid</th>
		  <th>Fragile</th>
		  <th>Special Instructions</th>
		  <th>Status</th>		  
        </tr>
      </thead>
      <tbody>';
          for($i = 0; $i < count ($deliveryresult); $i++){
            echo
            "<tr>
              <td>" . $deliveryresult[$i][ID] . "</td>
			  <td>" . $deliveryresult[$i][origin] . "</td>
			  <td>" . $deliveryresult[$i][destination] . "</td>
			  <td>" . $deliveryresult[$i][name] . "</td>
			  <td>" . date('h:i\ d-m-Y',$deliveryresult[$i][pickup]) . "</td>
			  <td>" . date('h:i\ d-m-Y',$deliveryresult[$i][dropoff]) . "</td>
			  <td>" . $deliveryresult[$i][cost] . "</td>
			  <td>" . $deliveryresult[$i][content] . "</td>
			  <td>" . $deliveryresult[$i][type] . "</td>
			  <td>" . date('h:i:s\ d-m-Y',$deliveryresult[$i][date_paid]) . "</td>
			  <td>";
			  if ($deliveryresult[$i][fragile] == 1)
			  {
				  echo "☑";
			  }
			  else{
				  echo "&#9744;";
			  }
     		  echo "</td><td>" . $deliveryresult[$i][special] . "</td>
			  <td>" . $deliveryresult[$i][status] . "</td>
			  <td><input type='submit' class='button' value='More Info' onclick=\"toggle_visibility('Hide', this);\"/></td>
			  <td><form action='complaints.php' method='POST'><input type='hidden' name='delivery' value='". $deliveryresult[$i]['delivery_ID'] ."'><input type='submit' class='button' value='Report Issue'></form></td>";
              if ($deliveryresult[$i]['status'] == "Awaiting Pick Up")
              {
              echo "<td><form action='deliverychange.php' method='POST'><input type='hidden' name='ID' value='".$deliveryresult[$i]['ID']."'><input type='submit' class='button' value='Change Details'></form></td>";
              }
			  
			 echo"</tr>";
			 foreach ($packageresult as $package)
			 {
			 if ($package["delivery_ID"] == $deliveryresult[$i]["ID"])
			 {
				echo "<tr class='Hide' ><td colspan='13'>Contents: " . $package[content] . " Weight: " . $package[weight] . "kg </td></tr>";
			 }
			 }
          }
		  echo "</tbody>
    </table></div>";
		}
		else {
				echo "<br/>You have not requested a delivery yet..<br/><br/><br/><input type='button' onclick='(window.location.href = \"request.php\")' value='REQUEST A DELIVERY' class='button'/> ";
        }
        ?>
	 <!-- <tr id='row1'><td colspan='13'>test</td></tr>  This goes between </tr> and </tbody> up a couple lines -->
		</br></br></br></br></br>
		
		
		
        <?php
		if ($statusresult != false) 
		{
            echo '<span class="sign_title">Ongoing Deliveries</span><br>
	  <div id="table_deliveries">
      <table>
      <thead>
        <tr>
          <th>Delivery ID</th>
     	  <th>Origin</th>
		  <th>Destination</th>
		  <th>Recipient</th>
		  <th>Pick Up</th>
		  <th>Drop Off</th>
		  <th>Cost($)</th>
		  <th>Type</th>
		  <th>Date Paid</th>
		  <th>Fragile</th>
		  <th>Special Instructions</th>
		  <th>Status</th>		  
        </tr>
      </thead>
      <tbody>';
          for($i = 0; $i < count ($statusresult); $i++){
            echo
            "<tr>
              <td>" . $statusresult[$i][ID] . "</td>
			  <td>" . $statusresult[$i][origin] . "</td>
			  <td>" . $statusresult[$i][destination] . "</td>
			  <td>" . $statusresult[$i][name] . "</td>
			  <td>" . date('h:i\ d-m-Y',$statusresult[$i][pickup]) . "</td>
			  <td>" . date('h:i\ d-m-Y',$statusresult[$i][dropoff]) . "</td>
			  <td>" . $statusresult[$i][cost] . "</td>
			  <td>" . $statusresult[$i][content] . "</td>
			  <td>" . $statusresult[$i][type] . "</td>
			  <td>" . date('h:i:s\ d-m-Y',$statusresult[$i][date_paid]) . "</td>
			  <td>";
			  if ($statusresult[$i][fragile] == 1)
			  {
				  echo "☑";
			  }
			  else{
				  echo "&#9744;";
			  }
     		  echo "</td><td>" . $statusresult[$i][special] . "</td>
			  <td>" . $statusresult[$i][status] . "</td>
			  <td><input type='submit' class='button' value='More Info' onclick=\"toggle_visibility('Hide', this);\"/></td>
			  <td><form action='complaints.php' method='POST'><input type='hidden' name='delivery' value='". $statusresult[$i]['delivery_ID'] ."'><input type='submit' class='button' value='Report Issue'></form></td>";
              if ($statusresult[$i]['status'] == "Awaiting Pick Up")
              {
              echo "<td><form action='deliverychange.php' method='POST'><input type='hidden' name='ID' value='".$statusresult[$i]['ID']."'><input type='submit' class='button' value='Change Details'></form></td>";
              }
			  
			 echo"</tr>";
			 foreach ($statuspack as $statuspackage)
			 {
			 if ($statuspackage["delivery_ID"] == $statusresult[$i]["ID"])
			 {
				echo "<tr class='Hide'><td colspan='13'>Contents: " . $statuspackage[content] . " Weight: " . $statuspackage[weight] . "kg </td></tr>";
			 }
			 }
          }
		  echo "</tbody>
    </table></div>";
		}
		else {
				echo "";} 
        ?>
      	

    <?php $conn->close(); ?>
	


	<br></div></div></div>
	<footer id="footer">
                        <p> Designed by Michael Phong - 2016</p>
					</footer>
			</div>
				   	     			
    </body>
</html>