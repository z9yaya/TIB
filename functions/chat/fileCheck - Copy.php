<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); 
$fileTime = filemtime("ze_yaya@msn.com-ze_yaya@gmail.com.xml");
$time = time() - 10;
if ($fileTime >= $time)
{
    echo "data: {$fileTime}\n\n";
    flush();
}
?>