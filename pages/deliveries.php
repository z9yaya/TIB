<?php 
include '../functions/functions.php';
include '../functions/change.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>****TITLE**** - drop.it</title>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
         <link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
		 <link async href="../css/deliveriescss.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
		<script type="text/javascript">

</script>
    </head>
    <body>
        <div id="back_nav">
			<div id="wrapper">
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
					<a id="tracking" class="menu menu_blue selected" href="tracking.php">TRACKING</a>
                    <a id="request" class="menu menu_blue" href="request.php">REQUEST</a>
				
				</header>
					<div id="content">
					
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
	  $delivery = "SELECT * FROM delivery, package WHERE user = '" . $_SESSION['email'] . "' 
									AND status != 'Delivered' AND delivery.ID = package.delivery_ID "; 
	  $deliveryresult = $conn->query($delivery);	
	  
	  $status = "SELECT * FROM delivery, package WHERE user = '" . $_SESSION['email'] . "' 
									AND status = 'Delivered' AND delivery.ID = package.delivery_ID ";	  
	  $statusresult = $conn->query($status);
	  ?>	
	  
	  <h1>Ongoing Deliveries</h1>
	  
      <table border="2" style= "background-color: #FBF5E6; color: black; margin: 0 auto;" >
      <thead>
        <tr>
          <th>Delivery ID</th>
          <th>User</th>
     	  <th>Origin</th>
		  <th>Destination</th>
		  <th>Recipient</th>
		  <th>Pick Up</th>
		  <th>Drop Off</th>
		  <th>Cost($)</th>
		  <th>Package Content</th>
		  <th>Type</th>
		  <th>Date Paid</th>
		  <th>Fragile</th>
		  <th>Special Instructions</th>
		  <th>Status</th>		  
        </tr>
      </thead>
      <tbody>
        <?php
		if ($deliveryresult->num_rows > 0) 
		{
          while( $row = $deliveryresult->fetch_assoc()){
            echo
            "<tr>
              <td>$row[delivery_ID]</td>
			  <td>$row[user]</td>
			  <td>$row[origin]</td>
			  <td>$row[destination]</td>
			  <td>$row[name]</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[pickup]) . "</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[dropoff]) . "</td>
			  <td>$row[cost]</td>
			  <td>$row[content]</td>
			  <td>$row[type]</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[date_paid]) . "</td>
			  <td>$row[fragile]</td>
			  <td>$row[special]</td>
			  <td>$row[status]</td>
			  <td><a href='#' onclick=\"toggle_visibility('moreinfo');\">More Info</a></td>
			  <td><a href='complaints.php?id=".$row['ID']."'>Report an Issue</a></td>
              <td><a href='deliverychange.php?id=".$row['ID']."'>Change delivery details</a></td>
			</tr>\n";
          }
		}
		else {
				echo "No Results Found";} 
        ?>
      </tbody>
    </table><br>	
	
	<h1>Completed Deliveries</h1>

      <table border="2" style= "background-color: #FBF5E6; color: black; margin: 0 auto;" >
      <thead>
        <tr>
          <th>Delivery ID</th>
          <th>User</th>
     	  <th>Origin</th>
		  <th>Destination</th>
		  <th>Recipient</th>
		  <th>Pick Up</th>
		  <th>Drop Off</th>
		  <th>Cost($)</th>
		  <th>Package Content</th>
		  <th>Type</th>
		  <th>Date Paid</th>
		  <th>Fragile</th>
		  <th>Special Instructions</th>
		  <th>Status</th>		  
        </tr>
      </thead>
      <tbody>
        <?php
		if ($deliveryresult->num_rows > 0) 
		{
          while( $row = $statusresult->fetch_assoc()){
            echo
            "<tr>
              <td>$row[delivery_ID]</td>
			  <td>$row[user]</td>
			  <td>$row[origin]</td>
			  <td>$row[destination]</td>
			  <td>$row[name]</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[pickup]) . "</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[dropoff]) . "</td>
			  <td>$row[cost]</td>
			  <td>$row[content]</td>
			  <td>$row[type]</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[date_paid]) . "</td>
			  <td>$row[fragile]</td>
			  <td>$row[special]</td>
			  <td>$row[status]</td>
			  <td><a href='#' onclick=\"toggle_visibility('moreinfo');\">More Info</a></td>
			  <td><a href='complaints.php?id=".$row['ID']."'>Report an Issue</a></td>
              <td><a href='deliverychange.php?id=".$row['ID']."'>Change delivery details</a></td>
			</tr>\n";
          }
		}
		else {
				echo "No Results Found";} 
        ?>
      </tbody>
    </table>	
	

    <?php $conn->close(); ?>
	
<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementByClassName(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>

	<br>            
					</div>
					        <footer id="footer">
                        <p> Designed by Michael Phong - 2016</p>
					</footer>
				</div>
			</div>
    </body>
</html>