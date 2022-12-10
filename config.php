<?php
require 'environment.php';

global $config;
global $db;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/rota7/");
	$config['dbname'] = 'rota7';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'M0nkey_615243';
} else {
	define("BASE_URL", "http://rota7.net.br/");
	$config['dbname'] = 'u320113050_rota7';
	$config['host'] = 'rota7.net.br';
	$config['dbuser'] = 'u320113050_root';
	$config['dbpass'] = 'KakkoSX21280075*';
}

$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);