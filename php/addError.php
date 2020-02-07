<?php
function addError($e){
    $a = array();
    $a['serverError'] = strval($e);
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/json/log.json', 'w');
    fwrite($fp, json_encode($a));
    fclose($fp);
}