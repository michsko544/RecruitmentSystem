<?php


class HandleJson
{
    //fetch data from db
    function fetchData($query, &$data_push, &$array, $host, $db_user, $db_pass, $db_name) {
        $counter = 0;
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        }
        else {
            $table = $connection->query($query);
            if (!$table) {
                throw new Exception($connection->error);
            }
            $counter = $table->num_rows;
            while ($assoc = $table->fetch_assoc()) {
                foreach ($assoc as $key => $value) {
                    @array_push($data_push, $value);
                    $array = $data_push;
                }
            }
        }
        $table->free();
        $connection->close();
        return $counter;
    }

    // add counters
    function addCounters(&$array, $value)
    {
        $array = $value;
    }

    // save data to file
    function createJsonFile($filename, &$array)
    {
        $fp = fopen($filename, 'w');
        fwrite($fp, json_encode($array));
        fclose($fp);
    }

}