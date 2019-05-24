<?php
include_once '../config/config.php';
include_once '../classes/Base.php';
include_once '../classes/Database.php';
include_once '../classes/File.php';

if (isset($_GET['file']))
{
	try
	{
		$File->loadFromDb($_GET['file']);
		$File->display();
	}
	catch (Exception $e)
	{

	}
}