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
					<a id="request" class="menu menu_blue" href="history.php">HISTORY</a>
				</header>
					<div id="content">
					
<<<<<<< HEAD
      <?php
	  $servername = "localhost";
	  $username = "edit";
	  $password = "editme";
	  $dbname = "tib";

	  $conn = new mysqli($servername, $username, $password, $dbname);
	  
	  if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);}	  

=======

					
      <?php
	  $servername = "localhost";
	  $username = "edit";
	  $password = "editme";
	  $dbname = "tib";

	  $conn = new mysqli($servername, $username, $password, $dbname);
	  
	  if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);}	  

>>>>>>> bda89006b273e819eb5bd8813f73d254cc756f88
      //execute the SQL query and return records
	  $sql = "SELECT delivery_id, time, location FROM history";
	  $result = $conn->query($sql);
      ?>
	  <h1>Package History</h1>
<<<<<<< HEAD
      <table border="2" style= "background-color: #84ed86; color: black; margin: 0 auto;" >
      <thead>
        <tr>
          <th>Delivery ID</th>
          <th>Time Arrived</th>
=======
      <table border="2" style= "background-color: #84ed86; color: #761a9b; margin: 0 auto;" >
      <thead>
        <tr>
          <th>Delivery ID</th>
          <th>Time</th>
>>>>>>> bda89006b273e819eb5bd8813f73d254cc756f88
          <th>Location</th>
        </tr>
      </thead>
      <tbody>
        <?php
<<<<<<< HEAD
		if ($result->num_rows > 0) 
		{
=======
>>>>>>> bda89006b273e819eb5bd8813f73d254cc756f88
          while( $row = $result->fetch_assoc()){
            echo
            "<tr>
              <td>$row[delivery_id]</td>
			  <td>$row[time]</td>
			  <td>$row[location]</td>
            </tr>\n";
          }
<<<<<<< HEAD
		}
		else {
				echo "No Results Found";} 
=======
>>>>>>> bda89006b273e819eb5bd8813f73d254cc756f88
        ?>
      </tbody>
    </table>
     <?php $conn->close(); ?>
					

                    <footer id="footer">
                        <p> Designed by Michael Phong - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>