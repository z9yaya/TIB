<?php include "../functions.php";
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');  
if (session_id() == '')
{
    session_start();
}
if(isset($_SESSION['email']))
{
    $user = $_SESSION['email']; 
}
$file = $_GET['file'];
$timeuser= time();
try
     {
        $pdo = connect();
        $query= "UPDATE chat SET online=:time WHERE file=:file AND user=:user";
        $prepare = $pdo->prepare($query);
        $prepare -> bindValue(':file', $file);
        $prepare -> bindValue(':user', $user);
        $prepare -> bindValue(':time', $timeuser);
        $prepare->execute();
    }
catch (PDOException $e)
     {
         echo "data:{$e -> getMessage()}\n\n";
     }
$fileTime = filemtime($file);
$time = time() - 10;
if ($fileTime >= $time)
{
    echo "data: {$fileTime}\n\n";
    flush();
}
?>