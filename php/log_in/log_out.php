<?php
session_start();
function clearFiles($filename){
    $fp = fopen($filename, 'w');
    fclose($fp);
}

clearFiles('/json/profile.json');
clearFiles('/json/applications.json');
clearFiles('/json/replies.json');
clearFiles('/json/chat.json');
clearFiles('/json/role.json');
session_unset();
header('Location: ../../index.php');
