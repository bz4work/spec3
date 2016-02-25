<?php
error_reporting(-1);
ini_set('display_errors',1);
header('Content-Type: text/html; charset=utf-8');
session_start();

// Конфиг сайта
include_once './config.php';
include_once './libs/default.php';
include_once './variables.php';

// Роутер
include './modules/'.$_GET['module'].'/'.$_GET['page'].'.php';
include './skins/'.SKIN.'/index.tpl';
