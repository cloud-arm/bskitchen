<?php

function insert($table, $data, $path = "", $file = "")
{
    include($path . 'connect.php');

    $keys = implode(', ', array_keys($data['data']));
    $values = ':' . implode(', :', array_keys($data['data']));

    $sql = "INSERT INTO $table ($keys) VALUES ($values)";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($data['data']);

        $res = array(
            "status" => "success",
            "message" => "",
        );
        return $res;
    } catch (PDOException $e) {

        // create error json log
        $json = array(
            "file" => $file,
            "table" => $table,
            "message" => $e->getMessage(),
            "date" => date("Y-m-d"),
            "time" => date('H:i:s'),
        );

        $res = array(
            "status" => "failed",
            "message" => $e->getMessage(),
        );
        return $res;
    }
}
