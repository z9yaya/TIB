<?php
function deliveryUpdate()
{ 
    if (session_id() == '')
    {
        session_start();
    }
    if(isset($_SESSION['email']))
    {      
        if (isset($_POST))
                {
                     if (!empty($_POST) && !empty($_POST['pickUp']))
                        {
                             $ID = $_POST['ID'];
                             $pickUp = $_POST['pickUp'];
                             $dropOff = $_POST['dropOff'];
                             $recipient = $_POST['recipient'];
                             $special = $_POST['special'];
                         
                             $a = date_parse_from_format('Y-m-d', $_POST['PpckDate']);
                             $pickTime = date_parse_from_format('H:i', $_POST['pickTime']);
                             $pickDate = mktime($time['hour'], $time['minute'], 0, $a['month'], $a['day'], $a['year']);
                         
                             $a = date_parse_from_format('Y-m-d', $_POST['dropDate']);
                             $dropTime = date_parse_from_format('H:i', $_POST['dropTime']);
                             $dropDate = mktime($time['hour'], $time['minute'], 0, $a['month'], $a['day'], $a['year']);
                         
                             try
                             {
                                 $pdo = connect();
                                 $query_driver= "UPDATE `delivery`   
                                           SET `origin` = :pickUp,
                                               `destination` = :dropOff,
                                               `recipient` = :name,
                                               `pickDate` = :pickup,
                                               `dropDate` = :dropoff,
                                               `special` = :special
                                         WHERE `ID` = :ID;";
                                 $prepare = $pdo->prepare($query_driver);
                                 $prepare -> bindValue(':pickUp', $pickUp);
                                 $prepare -> bindValue(':dropOff', $dropOff);
                                 $prepare -> bindValue(':recipient', $recipient);
                                 $prepare -> bindValue(':pickDate', $pickDate);
                                 $prepare -> bindValue(':dropDate', $dropDate);
                                 $prepare -> bindValue(':special', $special);
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