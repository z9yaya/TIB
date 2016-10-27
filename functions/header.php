<?php
function SelectedButtons(Link)
{
    if(explode("/",$_SERVER['REQUEST_URI'])[3] == Link)
    {
        echo " selected";
    }
}
if (explode("/",$_SERVER['REQUEST_URI'])[2] != "pages")
{

    echo '<header>
					<a id="login_blue" class="menu menu_blue" href="pages/login.php">';
   if (session_id() == '')
    {
        session_start();
    }
    if(isset($_SESSION['email']))
        echo 'SIGN OUT</a>';
    else
    {
        header("Location: pages/login.php?error=request");
        echo 'SIGN IN</a>';
    }
    echo '<a id="header" class="intro intro_blue" href="index.php">drop.it</a>
                       
					<a id="deliveries" class="menu menu_blue" href="pages/deliveries.php">DELIVERIES</a>';
    if(isset($_SESSION['position']))
    {
        if ($_SESSION['position'] != 'driver')
        {
              echo '<a id="log" class="menu menu_blue" href="pages/payment_page.php">PAY</a>
             <a id="tracking" class="menu menu_blue" href="pages/tracking.php">TRACKING</a>
            <a id="new" class="menu menu_blue selected" href="pages/request.php">REQUEST</a>';	
        }
        else if ($_SESSION['position'] == 'driver')
        {
             header("Location: index.php");
             echo '<a id="log" class="menu menu_blue" href="pages/driver.php">LOG</a>';
        }
    }
    else
    {
         echo '<a id="tracking" class="menu menu_blue" href="pages/tracking.php">TRACKING</a>
        <a id="new" class="menu menu_blue selected" href="pages/request.php">REQUEST</a>';	
    }
    echo '</header>'

}
else if (explode("/",$_SERVER['REQUEST_URI'])[2] == "pages")
{
     
   echo '<header>
					<a id="login_blue" class="menu menu_blue'.SelectedButtons(Link).'" href="login.php">';
   if (session_id() == '')
    {
        session_start();
    }
    if(isset($_SESSION['email']))
        echo 'SIGN OUT</a>';
    else
    {
        header("Location: login.php?error=request");
        echo 'SIGN IN</a>';
    }
    echo '<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
                       
					<a id="deliveries" class="menu menu_blue'.SelectedButtons(Link).'" href="deliveries.php">DELIVERIES</a>';
    if(isset($_SESSION['position']))
    {
        if ($_SESSION['position'] != 'driver')
        {
              echo '<a id="log" class="menu menu_blue'.SelectedButtons(Link).'" href="payment_page.php">PAY</a>
             <a id="tracking" class="menu menu_blue'.SelectedButtons(Link).'" href="tracking.php">TRACKING</a>
            <a id="new" class="menu menu_blue'.SelectedButtons(Link).'" href="request.php">REQUEST</a>';	
        }
        else if ($_SESSION['position'] == 'driver')
        {
             echo '<a id="log" class="menu menu_blue'.SelectedButtons(Link).'" href="driver.php">LOG</a>';
        }
        if ($_SESSION['position'] != 'customer')
        {
            echo '<a id="itinerary" class="menu menu_blue'.SelectedButtons(Link).'" href="itinerary.php">ITINERARY</a>';
        }
    }
    else
    {
         echo '<a id="tracking" class="menu menu_blue'.SelectedButtons(Link).'" href="pages/tracking.php">TRACKING</a>
        <a id="new" class="menu menu_blue'.SelectedButtons(Link).'" href="pages/request.php">REQUEST</a>';	
    }
    echo '</header>'
}
?>