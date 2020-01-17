<?php
function clearFiles($filename){
    $fp = fopen($filename, 'w');
    fclose($fp);
}
session_start();
clearFiles('/json/profile.json');
clearFiles('/json/applications.json');
clearFiles('/json/replies.json');
clearFiles('/json/chat.json');
clearFiles('/json/role.json');
session_unset();
header('Location: ../../index.php');
