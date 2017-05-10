<?php
session_start();

$_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"] = "";
$_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"] = "";
$_SESSION["a88b7dcd1a9e3e17770bbaa6d7515b31a2d7e85d"] = "";
$_SESSION["e0d6ae5cf2a2d0c1075943593a36cc5377382a05"] = "";
$_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"] = "";

session_destroy();
$insertGoTo = "../index.php";
header(sprintf("Location: %s", $insertGoTo));