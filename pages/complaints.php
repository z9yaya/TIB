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
      ?>
	  <h1>Submit a Complaint</h1>
	  
	<br>
	<form method="get" action="complaints.php">
	    Full Name: <input id="text_input" type="text" name="DESCRIPTION OF INFORMATION (1 WORD)" class="input_text" size="15" maxlength="30" autofocus placeholder=""/><br>
		Date: <input id="date_input" type="date" name="DESCRIPTION OF INFORMATION (1 WORD)" class="input_text" size="15" maxlength="30" autofocus placeholder=""/><br>
		Delivery ID: <input type="number" name="DESCRIPTION OF INFORMATION (1 WORD)" size="12" maxlength="10" class="input_text" placeholder=""/><br>
		<textarea rows="5" cols="40" placeholder="What is your comaplint?" required></textarea><br><br>
		<button type="submit">Submit</button>
	</form>
	
                    <footer id="footer">
                        <p> Designed by Michael Phong - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>