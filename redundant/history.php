<?php include '../functions/functions.php';?>

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
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
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
                                                                            //header("Location: login.php");
                                                                            echo 'SIGN IN</a>';}?>
					
					<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>
					<a id="tracking" class="menu menu_blue selected" href="tracking.php">TRACKING</a>
                    <a id="request" class="menu menu_blue" href="request.php">REQUEST</a>
					<a id="request" class="menu menu_blue" href="history.php">HISTORY</a>
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

      //execute the SQL query and return records
	  $sql = "SELECT delivery_id, time, location FROM history";
	  $result = $conn->query($sql);
	  $time = "SELECT time FROM history";
	  $timeresult = $conn->query($time); 
	  $timestamp = date("Y-m-d\H:i:s", $timeresult)
      ?>
	  <h1>Package History</h1>
      <table border="2" style= "background-color: #84ed86; color: black; margin: 0 auto;" >
      <thead>
        <tr>
          <th>Delivery ID</th>
          <th>Time Arrived</th>
          <th>Location</th>
        </tr>
      </thead>
      <tbody>
        <?php
		if ($result->num_rows > 0) 
		{
          while( $row = $result->fetch_assoc()){
            echo
            "<tr>
              <td>$row[delivery_id]</td>
			  <td>" . date('h:i:s\ d-m-Y',$row[time]) . "</td>
			  <td>$row[location]</td>
			  <td><a href='complaints.php?id=".$row['delivery_id']."'>Report an Issue</a></td>
            </tr>\n";
          }
		}
		else {
				echo "No Results Found";} 
        ?>
      </tbody>
    </table>
    <?php $conn->close(); ?>
	
	<br>

                    <footer id="footer">
                        <p> Designed by Michael Phong - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>