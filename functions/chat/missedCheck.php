<?php include "../functions.php";
if (session_id() == '')
    {
        session_start();
    }
    if(isset($_SESSION['email']))
    {
        $user = $_SESSION['email']; 
        $lastOnline= GrabMoreData("SELECT file FROM chat WHERE user=:user AND online < lastmodified", array(array(':user', $user)));
        echo json_encode($lastOnline);
    }

?>