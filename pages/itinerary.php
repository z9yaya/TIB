<?php 
include '../functions/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Itinerary - drop.it</title>
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
				<?php include "../functions/header.php";?>
					<div id="content"><!--REQUIRED-->
                         <div id="form"><!--REQUIRED-->
                             <form class="form" id="request_form" method='POST' action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                                <div class="sign_title">Itinerary</div>
                                
								<?php
									
									//require '../functions/functions.php';
									require '../functions/payment.php';
									require '../functions/itinerary_functions.php';
									
									if(isset($_SESSION['position']))
									{
										if($_SESSION['position'] != 'customer')
										{
											if($_SESSION['position'] == 'driver')
											{
												// Driver
												
												//Get their route for today
												$new_arr = makeArray($_SESSION['email']);
												
												//Display their route for today
												echo makeTable($new_arr);
												
											}else{
												// Manager
												
												$drivers = GrabMoreData("SELECT DISTINCT driver FROM delivery", array(array('', "" )));
												
												foreach($drivers as $arr){
													$temp = $arr['driver'];
													
													//Get their route for today
													$new_arr = makeArray($temp);
													if($temp){
														echo "<span class='menu menu_blue'>".$temp."</span><br/>";
													}else{
														echo "<span class='menu menu_blue'>"."Unassigned"."</span><br/>";
													}
													//Display their route for today
													echo makeTable($new_arr);
													
												}
												
											}
										}else{
											// a customer should not be allowed on this page
											// goto another page
											echo 'ERROR - Invalid User Type';
										}
									}else{
										echo 'ERROR - Whoops. You need to log in.';
										echo '<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
										<a id="new" class="menu menu_blue" href="request.php">REQUEST</a>';	
									}
								?>
								
                             </form>
                        </div><!--REQUIRED-->
					</div><!--REQUIRED-->
				</div><!--REQUIRED-->
                <?php AddChat(); include "../functions/footer.php"; ?>                
			</div>
            <?php if (session_id() == '')
            {
                session_start();
            }
            if(isset($_SESSION['position']) && $_SESSION['position'] != 'customer')
            {
                echo '<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
                        <meta http-equiv="Pragma" content="no-cache" />
                        <meta http-equiv="Expires" content="0" />
                        <script type="text/javascript" src="../functions/chat/scriptPages.js"></script>';
            }?>
    </body>
</html>