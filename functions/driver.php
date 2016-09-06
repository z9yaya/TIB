<?php
function driverUpdate()
{ 
    if (session_id() == '')
    {
        session_start();
    }
    if(isset($_SESSION['email']))
    {      
        if (isset($_POST))
                {
                     if (!empty($_POST) && !empty($_POST['ID']))
                        {
                             $ID = $_POST['ID'];
                             $location = $_POST['location'];
                             $status = $_POST['status'];
                             $email = $_SESSION['email'];
                             $a = date_parse_from_format('Y-m-d', $_POST['date']);
                             $time = date_parse_from_format('H:i', $_POST['time']);
                             $date = mktime($time['hour'], $time['minute'], 0, $a['month'], $a['day'], $a['year']);
                         
                             try
                             {
                                 $pdo = connect();
                                 $query= "INSERT INTO history(delivery_id, time, location)
                                 VALUES(:ID, :time, :location);";
                                 $prepare = $pdo->prepare($query);
                                 $prepare -> bindValue(':ID', $ID);
                                 $prepare -> bindValue('time', $date);
                                 $prepare -> bindValue(':location', $location);
                                 $prepare -> execute();
                                 

                                 $query_driver= "UPDATE `delivery`   
                                           SET `driver` = :email,
                                               `status` = :status
                                         WHERE `ID` = :ID;";
                                 $prepare = $pdo->prepare($query_driver);
                                 $prepare -> bindValue(':email', $email);
                                 $prepare -> bindValue(':status', $status);
                                 $prepare -> bindValue(':ID', $ID);
                                 $prepare -> execute();
                                
                             }
                             catch (PDOException $e)
                             {
                                 echo $e -> getMessage();
                             }
                         header("Location: ../pages/tracking.php");
                     }
                }
            }
}
?>