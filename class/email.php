<?php

function email($mail, $text, $url = '')
{
    $response = array('message' => 'Invalid Host', 'status' => 'error');
    if ($_SERVER['SERVER_NAME'] == 'mami.colorbiz.org') {
    }
    $response = $response['status'];
    return $response;
}
