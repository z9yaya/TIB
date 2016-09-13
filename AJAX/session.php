<?php
if (session_id() == '')
            {
                session_start();
            }
if(isset($_SESSION['email']))
{
    if (!empty($_SESSION['email'])) {
        $data = $_SESSION['email'];

    }
}
else
{
    $data = false;
}
echo $data;
?>