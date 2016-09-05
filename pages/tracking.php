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
                                                                            echo 'SIGN IN</a>';?>
					<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>
					<a id="tracking" class="menu menu_blue selected" href="tracking.php">TRACKING</a>
                    <a id="request" class="menu menu_blue" href="request.php">REQUEST</a>
					<a id="driverform" class="menu menu_blue" href="driverform.php">DRIVER</a>
					
				</header>
					<div id="content">                 
				       <?php include '../functions/functions.php';
	  $results = GrabData('history', 'delivery_ID, time, location', 'delivery_ID', '1');
      ?>
	  <h1>Package Tracking</h1>
      <table border="3" width="500" style= "background-color: #ffb3b3; color: black; margin: 0 auto;">
      <thead>
        <tr>
          <th>Package ID</th>
          <th>Location</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
		if ($results) 
		{
          foreach($results as $row){
            echo
            "<tr>
              <td>$row[delivery_ID]</td>
			  <td>$row[location]</td>
			  <td>" . date('d-m-Y',$row[time]) . "</td>
            </tr>\n";
          }
		}
		else {
				echo "No Results Found";} 
        ?>
      </tbody>
    </table>
    <?php $conn->close(); ?>				 
<h1><?php echo '<center><b></b></center>'; ?></h1> 
                        <footer id="footer">
                        <p> Done by Elias Gebre - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>


