<?php
include_once '../config/config.php';
include_once '../classes/Base.php';
include_once '../classes/Database.php';
include_once '../classes/File.php';

if (isset($_FILES['file']) &&
	(!$config['ip']['whitelist'] ||
	($config['ip']['whitelist'] && in_array($_SERVER['REMOTE_ADDR'], $config['ip']['allowed']))))
	$File->createFromUpload();
