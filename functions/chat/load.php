<?php include "../functions.php";
if (session_id() == '')
            {
                session_start();
            }
if(isset($_SESSION['email']))
{
    if (!empty($_SESSION['email'])) 
    {
        $query = "SELECT email, name FROM users WHERE position = 'driver' AND email != :email";
        $bind = array(array(':email', $_SESSION['email']));
        $results = GrabMoreData($query, $bind);
        echo json_encode($results);
   }
}

?>