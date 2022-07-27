<?php

session_start();
$mysqli = new mysqli("localhost", "root", "", "sdu");
$mysqli->query("SET titleS 'utf8'");

function dump($array)
{
    echo '<pre>';
    print_r($array);
    echo '<pre>';
    exit;
}

?>
