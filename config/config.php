<?php
/* Name of the website */
$config['website'] = "0x1 (Non-Null Pointer)";

$config['file']['min_age'] = 30; /* Days */
$config['file']['max_age'] = 365; /* Days */
$config['file']['max_size'] = 512; /* MB */
$config['urlsalt'] = "somesalt";
$config['shortenedurl_size'] = 4; /* May not be larger than SHA1 digest / 2 */
$config['uploads_dir'] = __DIR__ . "/../uploads";
$config['logs_dir'] = __DIR__ . "/../logs";

/* IP Whitelisting for upload */
$config['ip']['whitelist'] = false;
$config['ip']['allowed'] = [ "127.0.0.1" ];

/* MySQL DB Credentials */
$config['db']['host'] = "localhost";
$config['db']['name'] = "nnullptr";
$config['db']['username'] = 'nnullptr_user';
$config['db']['password'] = 'passwd';
$config['db']['logfile'] = 'database.txt';