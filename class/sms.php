<?php

function sms($number, $text)
{
    $response = array('message' => 'Invalid Host', 'status' => 'error');
    if ($_SERVER['SERVER_NAME'] == 'mami.colorbiz.org') {
    }

    $response = $response['status'];
    return $response;
}
