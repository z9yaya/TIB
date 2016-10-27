<?php
//header.php by Yannick Mansuy

//This PHP file's function is to add the footer with appropriate links for each type of user
if (explode("/",$_SERVER['REQUEST_URI'])[2] != "pages")
{

    if (session_id() == '')
     {
         session_start();
     }
    if(isset($_SESSION['email']))
    {
        echo '<footer id="footer"><div id="footer_container">';
        if(isset($_SESSION['position']))
        {
            if ($_SESSION['position'] != 'driver')
            {
                echo '<a href="pages/request.php" class="menu footer_left">REQUEST</a>';
            }
        }
        if(isset($_SESSION['email']))
            echo '<a href="pages/login.php" class="menu footer_right">SIGN OUT</a>';
        else
        {
            echo '<a href="pages/login.php" class="menu footer_right">SIGN IN</a>';
        }
        if(isset($_SESSION['position']))
        {
            if ($_SESSION['position'] != 'driver')
            {
            echo '<a href="pages/tracking.php" class="menu footer_left">TRACKING</a>';
            }
        }
        if(!isset($_SESSION['email']))
        {
            echo '<a href="pages/login.php" class="menu footer_right">REGISTER</a>';
        }

        echo '<a href="pages/deliveries.php" class="menu footer_left">DELIVERIES</a>
        <a href="pages/findmanager.php" class="menu footer_right">CONTACT US</a>';
        if(isset($_SESSION['position']))
        {
            if ($_SESSION['position'] != 'driver')
            {
                  echo '<a href="pages/payment_page.php" class="menu footer_left">PAY</a>';
            }
            else if ($_SESSION['position'] == 'driver')
            {
                 echo '<a href="pages/driver.php" class="menu footer_left">LOG</a>';
            }
        }

        echo '<div id="header" class="intro">drop.it</div></div>
        </footer>';
    }
    else if(!isset($_SESSION['email']))
    {
        echo '<footer id="footer">
    <div id="footer_container"><a href="pages/request.php" class="menu footer_left">REQUEST</a>
    <a href="pages/login.php" class="menu footer_right">SIGN IN</a>
    <a href="pages/tracking.php" class="menu footer_left">TRACKING</a>
    <a href="pages/login.php" class="menu footer_right">REGISTER</a>
    <a href="pages/deliveries.php" class="menu footer_left">DELIVERIES</a>
    <a href="pages/findmanager.php" class="menu footer_right">CONTACT US</a>
    <a href="pages/payment_page.php" class="menu footer_left">PAY</a>
    <div id="header" class="intro">drop.it</div></div>
     </footer>';
    }

}
else if (explode("/",$_SERVER['REQUEST_URI'])[2] == "pages")
{
     
    if (session_id() == '')
     {
         session_start();
     }
     if(isset($_SESSION['email']))
    {
        echo '<footer id="footer"><div id="footer_container">';
        if(isset($_SESSION['position']))
        {
            if ($_SESSION['position'] != 'driver')
            {
                echo '<a href="request.php" class="menu footer_left">REQUEST</a>';
            }
        }
        if(isset($_SESSION['email']))
            echo '<a href="login.php" class="menu footer_right">SIGN OUT</a>';
        else
        {
            echo '<a href="login.php" class="menu footer_right">SIGN IN</a>';
        }
        if(isset($_SESSION['position']))
        {
            if ($_SESSION['position'] != 'driver')
            {
            echo '<a href="tracking.php" class="menu footer_left">TRACKING</a>';
            }
        }
        if(!isset($_SESSION['email']))
        {
            echo '<a href="login.php" class="menu footer_right">REGISTER</a>';
        }

         echo '<a href="deliveries.php" class="menu footer_left">DELIVERIES</a>
        <a href="findmanager.php" class="menu footer_right">CONTACT US</a>';
        if(isset($_SESSION['position']))
        {
            if ($_SESSION['position'] != 'driver')
            {
                  echo '<a href="payment_page.php" class="menu footer_left">PAY</a>';
            }
            else if ($_SESSION['position'] == 'driver')
            {
                 echo '<a href="driver.php" class="menu footer_left">LOG</a>';
            }
        }

        echo '<div id="header" class="intro">drop.it</div></div>
        </footer>';
     }
    else if(!isset($_SESSION['email']))
    {
        echo '<footer id="footer">
    <div id="footer_container"><a href="request.php" class="menu footer_left">REQUEST</a>
    <a href="login.php" class="menu footer_right">SIGN IN</a>
    <a href="tracking.php" class="menu footer_left">TRACKING</a>
    <a href="login.php" class="menu footer_right">REGISTER</a>
    <a href="deliveries.php" class="menu footer_left">DELIVERIES</a>
    <a href="findmanager.php" class="menu footer_right">CONTACT US</a>
    <a href="payment_page.php" class="menu footer_left">PAY</a>
    <div id="header" class="intro">drop.it</div></div>
     </footer>';
    }
}
?>