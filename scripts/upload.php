<?php
include_once '../config/config.php';
include_once '../classes/Base.php';
include_once '../classes/Database.php';
include_once '../classes/File.php';

if (isset($_FILES['file']))
	$File->createFromUpload();
