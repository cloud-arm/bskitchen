<?php

function select($table, $columns = "*", $where = "")
{
    include('connect.php');

    $sql = "SELECT $columns FROM $table";

    if (!empty($where)) {
        $sql .= " WHERE " . $where;
    }

    try {
        $result = $db->prepare($sql);
        $result->execute();
        return $result;
    } catch (PDOException $e) {
        echo "Selection failed: " . $e->getMessage();
        return false;
    }
}

function select_item($table, $columns, $where = "", $path = "")
{
    include($path . 'connect.php');

    $sql = "SELECT $columns FROM $table";

    if (!empty($where)) {
        $sql .= " WHERE " . $where;
    }

    try {
        $result = $db->prepare($sql);
        $result->execute();
        for ($i = 0; $row = $result->fetch(); $i++) { $retun=$row[$columns]; }
        return $retun;
    } catch (PDOException $e) {
        echo "Selection failed: " . $e->getMessage();
        return false;
    }
}

function select_query($sql){
    include('connect.php');

    try {
        $result = $db->prepare($sql);
        $result->execute();
        return $result;
    } catch (PDOException $e) {
        echo "Selection failed: " . $e->getMessage();
        return false;
    }
}