<?php
function registerRequest()
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
                         
                             $pickUp = $_POST['pickUp'];
                             $dropOff = $_POST['dropOff'];
                             $recipient = $_POST['recipient'];
                             if (isset($_POST['fragile']))
                                 {
                                    $fragile = $_POST['fragile'];
                                 }
                             else
                                 {
                                    $fragile = 0; 
                                 }
                             if (isset($_POST['premium']))
                                 {
                                     $premium = $_POST['premium'];
                                 }
                             else
                                 {
                                      $premium = 'standard';
                                 }
                             if (isset($_POST['special']))
                                 {
                                     $special = $_POST['special'];
                                 }
                             else
                                 {
                                      $special = 'None.';
                                 }
                             $email = $_SESSION['email'];
                             $contents = $_POST['contents'];
                             $weight = $_POST['weight'];
                             $track = count($weight);
                             $a = date_parse_from_format('Y-m-d', $_POST['pickDate']);
                             $pickTime = date_parse_from_format('H:i', $_POST['pickTime']);

                             $pickDate = mktime($pickTime['hour'], $pickTime['minute'], 0, $a['month'], $a['day'], $a['year']);
                             $b = date_parse_from_format('Y-m-d', $_POST['dropDate']);
                             $dropTime = date_parse_from_format('H:i', $_POST['dropTime']);

                             $dropDate = mktime($dropTime['hour'], $dropTime['minute'], 0, $b['month'], $b['day'], $b['year']);
                             try
                             {
                                 $pdo = connect();
                                 $query= "INSERT INTO delivery(origin, destination, user, name, pickup, dropoff, type, fragile, special)
                                 VALUES(:pickUp, :dropOff, :user, :recipient, :pickTime, :dropTime, :first, :fragile, :special);";
                                 $prepare = $pdo->prepare($query);
                                 $prepare -> bindValue(':pickUp', $pickUp);
                                 $prepare -> bindValue(':pickTime', $pickDate);
                                 $prepare -> bindValue(':dropOff', $dropOff);
                                 $prepare -> bindValue(':dropTime', $dropDate);
                                 $prepare -> bindValue(':recipient', $recipient);
                                 $prepare -> bindValue(':first', $premium);
                                 $prepare -> bindValue(':fragile', $fragile);  
                                 $prepare -> bindValue(':special', $special);
                                 $prepare -> bindValue(':user', $email);
                                 $prepare -> execute();
                                 $ID = $pdo->lastInsertId();
                                 
                                 for($i=0; $i < $track; $i++)
                                 {
                                 $query= "INSERT INTO package(delivery_ID,weight, content)
                                 VALUES(:delivery_ID, :weight, :contents);";
                                 $prepare = $pdo->prepare($query);
                                 $prepare -> bindValue(':delivery_ID', $ID);
                                 $prepare -> bindValue(':contents', $contents[$i]);
                                 $prepare -> bindValue(':weight', $weight[$i]);
                                 $prepare -> execute();
                                    }
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