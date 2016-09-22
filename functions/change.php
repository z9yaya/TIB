<?php
include '../functions/functions.php';
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
                         if (!empty($_POST) && !empty($_POST['ID']))
                            {
                             
                             // Sets ID from $_POST from deliveries and uses that to query the DB into an array.
                             
                             $ID = $_POST['ID'];
                             $deliveryStatus = GrabData('delivery', 'status', 'ID', $ID);
                                }
                                
                                //If the package is not in transit as determined by the grabdataa query user can change delivery details
                                if ($deliverStatus = 'Awaiting Pick Up')
                                {
                                    
                                 //Sets variables based on form input.
                                    
                                 $pickUp = $_POST['pickUp'];

                                 $dropOff = $_POST['dropOff'];

                                 $recipient = $_POST['recipient'];

                                 $special = $_POST['special'];
                                    
                                 //Converts date to unix format.
                                 $a = date_parse_from_format('Y-m-d', $_POST['pickDate']);
                                 $pickTime = date_parse_from_format('H:i', $_POST['pickTime']);
                                 $pickDate = mktime($pickTime['hour'], $pickTime['minute'], 0, $a['month'], $a['day'], $a['year']);
                                    
                                 $b = date_parse_from_format('Y-m-d', $_POST['dropDate']);
                                 $dropTime = date_parse_from_format('H:i', $_POST['dropTime']);
                                 $dropDate = mktime($dropTime['hour'], $dropTime['minute'], 0, $b['month'], $b['day'], $b['year']);
                                 try
                                 {
                                     //Prepares query to update details for change form.
                                     $pdo = connect();
                                     $query= "UPDATE `delivery`   
                                               SET `origin` = :pickUp,
                                                   `destination` = :dropOff,
                                                   `name` = :recipient,
                                                   `pickup` = :pickup,
                                                   `dropoff` = :dropoff,
                                                   `special` = :special
                                             WHERE `ID` = :ID;";
                                     $prepare = $pdo->prepare($query);
                                     $prepare -> bindValue(':pickUp', $pickUp);
                                     $prepare -> bindValue(':dropOff', $dropOff);
                                     $prepare -> bindValue(':recipient', $recipient);
                                     $prepare -> bindValue(':pickup', $pickDate);
                                     $prepare -> bindValue(':dropoff', $dropDate);
                                     $prepare -> bindValue(':special', $special);
                                     $prepare -> bindValue(':ID', $ID);
                                     $prepare -> execute();


                                 }
                                 catch (PDOException $e)
                                 {
                                     echo $e -> getMessage();
                                 }
                        
                         //Redirect
                         header("Location: ../pages/deliveries.php");
                     }

                                }
                }
            }
?>