<?php include '../functions/functions.php';
include '../functions/change-auto.php';
if (isset($_POST))
{
    if (!empty($_POST) && !empty($_POST['ID']))
        {
            $info = getInfo($_POST['ID']);
        }
}
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
                    <a id="request" class="menu menu_blue" href="request.php">REQUEST</a>
					<a id="driverform" class="menu menu_blue" href="driverform.php">DRIVER</a>
				</header>
				
				<div id="content" style="width:160px;">
                    <div id="form">
					  <form class="form" id="change_form" method='POST' action='../functions/change.php'>
                        <span class="sign_title">Change Details</span><br>
                        <input id="text_input" type="hidden" name="ID" value="<?php if (isset($_POST))
                                {
                                    if (!empty($_POST) && !empty($_POST['ID']))
                                        {
                                            echo $_POST['ID'];}}?>"/>
                        <input id="text_input" type="text" name="pickUp" class="input_text" size="15" maxlength="10" autofocus placeholder="Pickup" required value="<?php echo $info['origin'];?>"/>
                        <input id="text_input" type="text" name="pickTime" min="09:00:00" max="17:00:00" class="input_text" size="15" maxlength="30" placeholder="Pickup time" onfocus="(this.type='time')" required value="<?php echo $info['pickupTime'];?>"/>
                        <input id="date_input" type="text" name="pickDate" min=<?php echo date('Y-m-d');?> class="input_text" size="15" maxlength="30" placeholder="Pickup date" onfocus="(this.type='date')" required value="<?php echo $info['pickupDate'];?>"/>
                        <input id="text_input" type="text" name="dropOff" class="input_text" size="15" maxlength="10" autofocus placeholder="Drop off" required value="<?php echo $info['destination'];?>"/>
                        <input id="text_input" type="text" name="dropTime" min="09:00:00" max="17:00:00" class="input_text" size="15" maxlength="30" placeholder="Dropoff time" onfocus="(this.type='time')" required value="<?php echo $info['dropTime'];?>"/>
                        <input id="date_input" type="text" name="dropDate" min=<?php echo date('Y-m-d', mktime(0, 0, 0,date('m'), date('d') + 1, date('Y')));?> class="input_text" size="15" maxlength="30" placeholder="dropoff date" onfocus="(this.type='date')" required value="<?php echo $info['dropDate'];?>"/>
                        <input id="text_input" type="text" name="recipient" class="input_text" size="15" maxlength="10" autofocus placeholder="Recipient" required value="<?php echo $info['name'];?>"/>
                        <textarea rows="4" cols="50" name="special" class="input_text textarea textarea_height" placeholder="Special instructions" onkeyup="this.className=' input_text textarea textarea_height text_long'" required><?php echo $info['special'];?></textarea>
                        </select><br><br><br>
                          
						<input id='submit_button' type="submit" value="SUBMIT" class="button">
						</form>
                    
				</div>
			</div>
                </div>
                        <footer id="footer">
                        <p>Done by Nicholas Bensein - 2016</p>
					</footer>
					</div>
    </body>
</html>


