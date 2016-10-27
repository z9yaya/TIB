<!DOCTYPE html>
<html>
    <head>
        <title>drop.it</title>
        <link rel="SHORTCUT ICON" href="images/icon.ico" />
        <link rel="icon" href="images/icon.ico" type="image/ico" />     
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
        <link async href="css/styles.css" rel="stylesheet" type="text/css"/>
        <link async href="css/services.css" rel="stylesheet" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
	</head>
    <body>
        <div id="back_nav">
            <div id="wrapper" style="margin-bottom: 0;">
				<header>
					<a id="login" class="menu" href="pages/login.php"><?php 
                                                                        if (session_id() == '')
                                                                        {
                                                                            session_start();
                                                                        }
                                                                        if(isset($_SESSION['email']))
                                                                            echo 'SIGN OUT</a>';
                                                                        else 
                                                                            echo 'SIGN IN</a>';?>
					<a id="header" class="intro" href="index.php">drop.it</a>
                       
					<a id="deliveries" class="menu" href="pages/deliveries.php">DELIVERIES</a>
                         <?php 
                            if(isset($_SESSION['position']))
                            {
                                if ($_SESSION['position'] != 'driver')
                                {
                                     echo '<a id="log" class="menu" href="pages/payment_page.php">PAY</a>
                                     <a id="tracking" class="menu" href="pages/tracking.php">TRACKING</a>
					                <a id="new" class="menu" href="pages/request.php">REQUEST</a>';	
                                }
                                else if ($_SESSION['position'] == 'driver')
                                {
                                    
                                     echo '<a id="log" class="menu" href="pages/driver.php">LOG</a>';
                                     echo '<a id="log" class="menu" href="pages/itinerary.php">ITINERARY</a>';
                                }
                            }
                            else
                                    {
                                         echo '<a id="tracking" class="menu" href="pages/tracking.php">TRACKING</a>
                                        <a id="new" class="menu" href="pages/request.php">REQUEST</a>';	
                                    }
                        ?>
                        </header>
                    <div id="content">
						<div id="content_start">
							<div id="text_start">
							GIVE YOUR CLIENTS THE EARLIEST DELIVERY CONSISTENT WITH QUALITY <br> - WHATEVER THE INCONVENIENCE TO US.
							</div>
							<p id="by_start">
							ARTHUR C. NIELSEN</p>
						</div>
                        <div id="scrollToServices" onclick='ScrollingToServices()'>&#x276D;</div>
                    </div>
            </div>
                <div id="serviceContainer" class="containerWidth">
                    <div id="services_1" class= "services">
                        <span class= "symbol"><a name="del" class="del" href="pages/request.php">&#9951;</a></span>
                        <p><i>Drop.it</i> offers a second to none package delivery service that will pick up from your doorstep and deliver to anywhere in Australia. We offer different levels of service based on both your budget and needs,  but endeavour to offer a quality service, no matter what.<br><br>
                        
                        Our standard, economic service will still pick up parcels from your door and offer a timely delivery, however, this is not an express service, nor does it come with parcel insurance.<br><br>

                        <i>Drop.it</i> takes great pride in offering our premium "first class" service, due to the high level of value and satisfaction it provides. The first class delivery service boasts not only express delivery times but provides parcel insurance as well, included in the price. Click on the link above to get started now.</p>
                            </div>
                        <div id="services_2" class= "services">
                            <span class= "symbol" ><a name="track" class="track" href="pages/tracking.php"> &#9735;</a></span>
                            <p> At <i>Drop.it</i>, we understand that is frustrating and inconvenient when a courier service cannot provide you with point-to-point location tracking of your deliveries. When you use <i>Drop.it</i>, you will have access to our point-to-point package tracking service with every delivery, free of charge.  One you have  signed in and have requested a delivery, please click the link seen above to see the current location of a delivery.</p>
                        </div>
                        <div id="services_3" class= "services">
                            <span class= "symbol"><a name="hist" class="hist" href="pages/deliveries.php"> &#9745;</a></span>
                            <p>Do you like to keep a log of your past deliveries? Are you interested in knowing how many packages we've delivered to you? If you click the link above you will find  a list of all our deliveries to you. From here, you are also able to submit complaints or provide us with a rating of our service. We would  greatly appreciate your feedback.</p>
                    </div>
                    </div>
                    
                
            <?php include "functions/functions.php"; 
            AddChat();
                include "functions/footer.php"?>
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
                        <script type="text/javascript" src="functions/chat/script.js"></script>';
            }?>
        <script async type="text/javascript" src="js/script.js"></script>
    </body>
</html>