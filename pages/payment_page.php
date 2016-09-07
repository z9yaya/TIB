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
					<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
					<a id="new" class="menu menu_blue" href="request.php">REQUEST</a>	
				</header>
					<div id="content">
					<h1>Payments</h1>
					<?php
						if (session_id() == ''){session_start();}
						
						require '../functions/functions.php';
						
						$data = GrabMoreData("SELECT position FROM users WHERE email= :email", array(array(':email', $_SESSION['email'])));
						
						$user_position = implode("", $data[0]);
						
						if($user_position == 'customer'){
							//Customer Code Here
							echo "Please note, here are the packages you need to pay for. Until this has been sorted, we are unable to collect and send your package/s.<br/><br/>";
							
							$data = GrabMoreData("SELECT ID, cost FROM delivery WHERE status='Awaiting Pick Up' AND paid=0 AND user= :email", array(array(':email', $_SESSION['email'])));
							
							//generate form
							if(!$data){
								echo "Nothing to show.<br/><br/>";
							}else{
								foreach($data as &$arr){}//Legacy loop. This need to be here or it breaks
								generateForm($data);
								echo "<br/><br/>Please contact us at your ealiest convienience to organise payment.";
							}
							
							
						}else{
							//Manager Code Here
							
							//Form for customers that have paid, and need their items picked up
							echo "List of customer that have paid and require their packages to be picked up:<br/><br/>";
							
							$data = GrabMoreData("SELECT ID, origin, driver, pickup, fragile, special FROM delivery WHERE status='Awaiting Pick Up' AND paid=1", array(array(':email', $_SESSION['email'])));
							
							//generate form
							if(!$data){
								echo "Nothing to show.<br/><br/>";
							}else{
								foreach($data as &$arr){}//Legacy loop. This need to be here or it breaks
								generateForm($data);
							}
							
							
							echo "<br/><br/>";
							
							//Form for customers that have not yet paid
							echo "List of customer that have not paid for their package delivery:<br/><br/>";
							
							$data = GrabMoreData("SELECT delivery.ID, delivery.user, users.name, users.phone FROM delivery INNER JOIN users ON delivery.user=users.email WHERE delivery.paid=0", array(array(':email', $_SESSION['email'])));
							//print_r($data);
							//echo "<br/><br/>";
							
							//generate form
							if(!$data){
								echo "Nothing to show.<br/><br/>";
							}else{
								foreach($data as &$arr){}//Legacy loop. This need to be here or it breaks
								generateForm($data);
							}
						}
						
						
						
						
						?>
						
						
						
						<footer id="footer">
                        <p> Designed by Yannick Mansuy - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>