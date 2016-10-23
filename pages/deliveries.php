
<!-- This code allows for functions to be included in this file. -->
<?php 
include '../functions/functions.php'; 
?>

<!DOCTYPE html>
<html>
    <head>
		<!-- This is the title of the web page as well as links to the CSS and Javascript files -->
        <title>Deliveries - drop.it</title>  	
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
         <link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
		 <link async href="../css/deliveriescss.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">

<!-- This is functions specific to deliveries.php. This function allows table rows for 'more info' to be hidden and shown with a button -->
<script type="text/javascript">  
    function toggle_visibility(Number, Artifact) {
        console.log(Artifact);
       var e = document.getElementsByClassName(Number);
        for (var i = 0; i < e.length; i++)
            {  
            if (e[i].style.display != "table-row")
              {
                e[i].style.display = 'table-row';
                document.getElementById(Artifact).innerHTML = "LESS";
              }
            else if(e[i].style.display == 'table-row')
            {
                e[i].style.display = "none";
                document.getElementById(Artifact).innerHTML = "MORE";
                    
                }
                
            }
       
	}
</script>
    </head>
    <body>
        <div id="back_nav"> <!-- This div holds the navigation menu -->
			<div id="wrapper"> <!-- This wrapper allows for positioning of the navigation menu. -->
				<header>
					<a id="login_blue" class="menu menu_blue" href="login.php"><?php  //This code checks to see if a user has logged in correctly and starts a session. If not, will display errors.
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
					
						<a id="header" class="intro intro_blue" href="../index.php">drop.it</a> <!-- This is the logo of the project and if clicked on will link to the homepage -->
                       
					<a id="deliveries" class="menu menu_blue selected" href="deliveries.php">DELIVERIES</a> <!-- Menu link to deliveries.php page -->
					
						<!-- php code that checks what type of user is logged in and displays the appropriate menu links -->
                         <?php 
                            if(isset($_SESSION['position']))
                            {
                                if ($_SESSION['position'] != 'driver')
                                {
                                    echo '<a id="log" class="menu menu_blue" href="payment_page.php">PAY</a>
                                     <a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
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
					<div id="content" class="nowidth"> <!-- Content Div that holds all the unique content on the page -->
					<div id="form">
					
      <?php
	  $servername = "localhost"; //This is login details to connect to the databse
	  $username = "edit";
	  $password = "editme";
	  $dbname = "tib";

	  $conn = new mysqli($servername, $username, $password, $dbname); //This code allows the the website to connect a specific database in mysql workbench.
	  
	  if ($conn->connect_error) {   //If the connection fails, an error message will pop up
		die("Connection failed: " . $conn->connect_error);}	  
	  ?>
	  
	  <?php 
	  
	  //This grabs all the ongoing delivery details from the database for the user logged in.
      $deliveryresult = GrabMoreData("SELECT * FROM delivery WHERE user = :email AND status != 'Delivered'", array(array(":email", $_SESSION['email'])));
	   if ($deliveryresult != false)
        {
           foreach($deliveryresult as $data)
          {
              //Uses a function from functions.php that grabs specific data from a table in the database
              $package = GrabData("package", "delivery_ID, content, weight", "delivery_ID", $data['ID']);
              foreach ($package as $pack)
              {
                  $packageresult[]= $pack;
              }
              
          }
        }
	  
	  
	  //This grabs all the completed delivery details from the database for the user logged in.
	  $statusresult = GrabMoreData("SELECT * FROM delivery WHERE user = :email AND status = 'Delivered'", array(array(":email", $_SESSION['email'])));	 
      if ($statusresult != false)
      {
          foreach($statusresult as $data)
          {
              //Uses a function from functions.php that grabs specific data from a table in the database
              $statuspackage = GrabData("package", "delivery_ID, content, weight", "delivery_ID", $data['ID']);
              foreach ($statuspackage as $pack)
              $statuspack[]= $pack;
          }
      }
	  
	  //This php code display the user's ongoing deliveries in a table format.
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
          for($i = 0; $i < count ($deliveryresult); $i++){	//This for loop goes through all the returned results and populates the table
            echo
            "<tr>
              <td><a id=" . $deliveryresult[$i]['ID'] . ">" . $deliveryresult[$i]['ID'] . "</a></td>
			  <td>" . $deliveryresult[$i]['origin'] . "</td>
			  <td>" . $deliveryresult[$i]['destination'] . "</td>
			  <td>" . $deliveryresult[$i]['name'] . "</td>
			  <td>" . date('h:i\ d-m-Y',$deliveryresult[$i]['pickup']) . "</td>
			  <td>" . date('h:i\ d-m-Y',$deliveryresult[$i]['dropoff']) . "</td>
			  <td>" . $deliveryresult[$i]['cost'] . "</td>
			  <td>" . $deliveryresult[$i]['type'] . "</td>
			  <td>" . date('h:i:s\ d-m-Y',$deliveryresult[$i]['date_paid']) . "</td>
			  <td>";
			  if ($deliveryresult[$i]['fragile'] == 1)
			  {
				  echo "☑";
			  }
			  else{
				  echo "&#9744;";
			  }
     		  echo "</td><td>" . $deliveryresult[$i]['special'] . "</td>
			  <td>" . $deliveryresult[$i]['status'] . "</td>";
 			 echo"</tr>";
             $packageNumber=0;
             echo "<tr class='Hide BUTTONS ".$deliveryresult[$i]['ID']."'><td colspan='12' id='buttons_holder'>";
              if ($deliveryresult[$i]['status'] == "Awaiting Pick Up")
              {
              echo "<form action='complaints.php' method='POST'><input type='hidden' name='delivery' value='". $deliveryresult[$i]['ID'] ."'><input type='submit' class='button' value='Report Issue'></form>"; 
              echo "<form action='deliverychange.php' method='POST'><input type='hidden' name='ID' value='".$deliveryresult[$i]['ID']."'><input type='submit' class='button' value='Change Details'></form>";
              echo "<form action='rating.php' method='GET'><input type='hidden' name='delivery' value='". $deliveryresult[$i]['ID'] ."'><input type='submit' class='button' value='Leave Feedback'></form>";
              }
              else
              {
              echo "<form action='complaints.php' method='POST' class='two_buttons_wide'><input type='hidden' name='delivery' value='". $deliveryresult[$i]['ID'] ."'><input type='submit' class='button' value='Report Issue'></form>";
              echo "<form action='rating.php' method='GET' class='two_buttons_wide'><input type='hidden' name='delivery' value='". $deliveryresult[$i]['ID'] ."'><input type='submit' class='button' value='Leave Feedback'></form>";
              }
              
              echo "</tr>";
			 foreach ($packageresult as $package)
			 {
			 if ($package["delivery_ID"] == $deliveryresult[$i]["ID"])
			 {
                $packageNumber++;
				echo "<tr class='Hide ".$deliveryresult[$i]['ID']."'>
                <td colspan='12'>
                <div class='package_details'>
                <div class='package_content single_line'>
                <span class='active'>Content:</span> " . $package['content'] . "
                </div>
                <div id='package_weight' class='single_line'>
                <span class='active'>Weight:</span> " . $package['weight'] . "kg
                </div>
                </div>
                <div class='package_number'>PACKAGE ".$packageNumber."</div></td></tr>";
			 }
			 }
              echo "<tr><td colspan='12' class='noborder'><input id='more_infoCheck".$deliveryresult[$i]['ID']."' class='more_infoCheck' type='checkbox' onclick=\"toggle_visibility(".$deliveryresult[$i]['ID'].", 'Label".$deliveryresult[$i]['ID']."');\"><label id='Label".$deliveryresult[$i]['ID']."' for='more_infoCheck".$deliveryresult[$i]['ID']."' class='more_info'>MORE</label></td></tr>";
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
		
		//This php code display the user's completed deliveries in a table format.
		if ($statusresult != false) 
		{
            echo '<span class="sign_title">Completed Deliveries</span><br>
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
          for($i = 0; $i < count ($statusresult); $i++){	//This for loop goes through all the returned results and populates the table
            echo
            "<tr>
              <td><a id=" . $statusresult[$i]['ID'] . ">" . $statusresult[$i]['ID'] . "</td>
			  <td>" . $statusresult[$i]['origin'] . "</td>
			  <td>" . $statusresult[$i]['destination'] . "</td>
			  <td>" . $statusresult[$i]['name'] . "</td>
			  <td>" . date('h:i\ d-m-Y',$statusresult[$i]['pickup']) . "</td>
			  <td>" . date('h:i\ d-m-Y',$statusresult[$i]['dropoff']) . "</td>
			  <td>" . $statusresult[$i]['cost'] . "</td>
			  <td>" . $statusresult[$i]['type'] . "</td>
			  <td>" . date('h:i:s\ d-m-Y',$statusresult[$i]['date_paid']) . "</td>
			  <td>";
			  if ($statusresult[$i]['fragile'] == 1)
			  {
				  echo "☑";
			  }
			  else{
				  echo "&#9744;";
			  }
     		  echo "</td><td>" . $statusresult[$i]['special'] . "</td>
			  <td>" . $statusresult[$i]['status'] . "</td>";
			   $packageNumber=0;
              echo "<tr/>";
             echo "<tr class='Hide BUTTONS ". $statusresult[$i]['ID']."'><td colspan='12' id='buttons_holder'>";
              if ($statusresult[$i]['status'] == "Awaiting Pick Up")
              {
              echo "<form action='complaints.php' method='POST'><input type='hidden' name='delivery' value='". $statusresult[$i]['ID'] ."'><input type='submit' class='button' value='Report Issue'></form>"; 
              echo "<form action='deliverychange.php' method='POST'><input type='hidden' name='ID' value='".$statusresult[$i]['ID']."'><input type='submit' class='button' value='Change Details'></form>";
              echo "<form action='rating.php' method='GET'><input type='hidden' name='delivery' value='". $statusresult[$i]['ID'] ."'><input type='submit' class='button' value='Leave Feedback'></form>";
              }
              else
              {
              echo "<form action='complaints.php' method='POST' class='two_buttons_wide'><input type='hidden' name='delivery' value='". $statusresult[$i]['ID'] ."'><input type='submit' class='button' value='Report Issue'></form>";
              echo "<form action='rating.php' method='GET' class='two_buttons_wide'><input type='hidden' name='delivery' value='". $statusresult[$i]['ID'] ."'><input type='submit' class='button' value='Leave Feedback'></form>";
              }
              
			  
			 echo"</tr>";
			 foreach ($statuspack as $statuspackage)
			 {
			 if ($statuspackage["delivery_ID"] == $statusresult[$i]["ID"])
			 {
				$packageNumber++;
				echo "<tr class='Hide ".$statuspackage['delivery_ID']."'>
                <td colspan='12'>
                <div class='package_details'>
                <div class='package_content single_line'>
                <span class='active'>Content:</span> " . $statuspackage['content'] . "
                </div>
                <div id='package_weight' class='single_line'>
                <span class='active'>Weight:</span> " . $statuspackage['weight'] . "kg
                </div>
                </div>
                <div class='package_number'>PACKAGE ".$packageNumber."</div></td></tr>";
			 }
			 }
              echo "<tr><td colspan='12' class='noborder'><input id='more_infoCheck".$statusresult[$i]["ID"]."' class='more_infoCheck' type='checkbox' onclick=\"toggle_visibility(".$statusresult[$i]["ID"].", 'Label".$statusresult[$i]["ID"]."');\"><label id='Label".$statusresult[$i]["ID"]."' for='more_infoCheck".$statusresult[$i]["ID"]."' class='more_info'>MORE</label></td></tr>";
          }
		  echo "</tbody>
    </table></div>";
		}
		else {
				echo "";} 
        ?>
      	
	<!-- This php closes the connection to the database -->
    <?php $conn->close(); ?>
	


        <br></div></div></div>
	<footer id="footer"> <!-- This is the footer for the page -->
                        <p> Designed by Michael Phong - 2016</p>
					</footer>
			</div>
				   	     			
    </body>
</html>
