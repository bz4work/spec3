<?php
error_reporting (-1);
header ('Content-type: text/html; charset=utf-8;');
session_start();

include "./config.php";
include "./var.php";
include "./libs/all.php";



include_once "./controller/".$_GET['mod']."/".$_GET['page'].".php";
include_once "./template/".TEMPLATE."/index.tpl";
?>