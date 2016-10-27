<?php include '../functions/functions.php';
include '../functions/change-auto.php';
if (isset($_POST))
{
    if (!empty($_POST) && !empty($_POST['ID']))//If the ID is psted from delivery page run a function.
        {
            $info = getInfo($_POST['ID']);//Calls getInfo function and passes ID which is required for                               queries.
        }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Delivery Change - drop.it</title>
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
            <!-- In this for every "value=" is filled from the get info array so customers know what they entered previously and ID is placed into an invisible feild so that it cannot be incorrectly entered, this also makes it easier to set in functions based on this form -->
                    
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
                        <?php include "../functions/footer.php"?>
					</div>
    </body>
</html>


