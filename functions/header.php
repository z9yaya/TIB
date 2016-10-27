<?php
//header.php by Yannick Mansuy


//INPUT $Link: the name of the file currently being accessed.
//This function inserts a string " selected" when the variable $Link matches the last portion of the url of the page being accessed.
function SelectedButtons($Link)
{
    if(explode(".", explode("/",$_SERVER['REQUEST_URI'])[3])[0] == $Link)
    {
        return " selected";
    }
}
//This PHP file function is to add the header to all pages with the appriopriate links for each type of user
if (explode("/",$_SERVER['REQUEST_URI'])[2] != "pages")
{

    echo '<header>
					<a id="login" class="menu" href="pages/login.php">';
   if (session_id() == '')
    {
        session_start();
    }
    if(isset($_SESSION['email']))
        echo 'SIGN OUT</a>';
    else
    {
        echo 'SIGN IN</a>';
    }
    echo '<a id="header" class="intro" href="index.php">drop.it</a><a id="deliveries" class="menu" href="pages/deliveries.php">DELIVERIES</a>';
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
        }
        if ($_SESSION['position'] != 'customer')
        {
             echo '<a id="itin" class="menu" href="pages/itinerary.php">ITINERARY</a>';
        }
    }
    else
    {
         echo '<a id="tracking" class="menu" href="pages/tracking.php">TRACKING</a>
        <a id="new" class="menu" href="pages/request.php">REQUEST</a>';	
    }
    echo '</header>';

}
else if (explode("/",$_SERVER['REQUEST_URI'])[2] == "pages")
{
     $location = explode(".", explode("/",$_SERVER['REQUEST_URI'])[3])[0];
   echo '<header>
					<a id="login_blue" class="menu menu_blue'.SelectedButtons('login').'" href="login.php">';
   if (session_id() == '')
    {
        session_start();
    }
    if(isset($_SESSION['email']))
        echo 'SIGN OUT</a>';
    else if($location != "findmanager" && $location != "login")
    {
        if ($location == "request")
            header("Location: login.php?error=request");
        else if ($location == "deliveries")
            header("Location: login.php?error=deliveries");
        else if ($location == "tracking")
            header("Location: login.php?error=tracking");
        else if ($location == "payment_page")
            header("Location: login.php?error=payment_page");
        else if ($location == "driver")
            header("Location: login.php?error=driver");
    }
    else
    {
        echo 'SIGN IN</a>';
    }
    echo '<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
                       
					<a id="deliveries" class="menu menu_blue'.SelectedButtons('deliveries').'" href="deliveries.php">DELIVERIES</a>';
    if(isset($_SESSION['position']))
    {
        if ($_SESSION['position'] != 'driver')
        {
              echo '<a id="log" class="menu menu_blue'.SelectedButtons('payment_page').'" href="payment_page.php">PAY</a>
             <a id="tracking" class="menu menu_blue'.SelectedButtons('tracking').'" href="tracking.php">TRACKING</a>
            <a id="new" class="menu menu_blue'.SelectedButtons('request').'" href="request.php">REQUEST</a>';	
        }
        else if ($_SESSION['position'] == 'driver')
        {
             echo '<a id="log" class="menu menu_blue'.SelectedButtons('driver').'" href="driver.php">LOG</a>';
        }
        if ($_SESSION['position'] != 'customer')
        {
            echo '<a id="itinerary" class="menu menu_blue'.SelectedButtons('itinerary').'" href="itinerary.php">ITINERARY</a>';
        }
    }
    else
    {
         echo '<a id="tracking" class="menu menu_blue'.SelectedButtons('tracking').'" href="tracking.php">TRACKING</a>
        <a id="new" class="menu menu_blue'.SelectedButtons('request').'" href="request.php">REQUEST</a>';	
    }
    echo '</header>';
}
?>