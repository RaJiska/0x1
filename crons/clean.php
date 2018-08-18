<?php
include_once '../config/config.php';
include_once '../classes/Base.php';
include_once '../classes/Database.php';
include_once '../classes/File.php';

try
{
	$stmt = $Database->query("SELECT id, name FROM files WHERE creation_date >= deletion_date AND active = '1';");
	$rows = $stmt->fetchAll();
	foreach ($rows as $row)
	{
		$Database->query("UPDATE files SET active = '0' WHERE id = " . $row['id'] . ";");
		unlink($config['uploads_dir'] . "/" . $row['name']);
	}
}
catch (Exception $e)
{
	/* Write something in logs */
}