<?php
include_once '../config/config.php';
include_once '../classes/Base.php';
include_once '../classes/Database.php';
include_once '../classes/File.php';

if (isset($_FILES['file']))
{
    if ($config['website']['upload_passwd'] && (!isset($_POST['passwd']) || $_POST['passwd'] != $config['website']['upload_passwd']))
        die("ERROR: Wrong password for 'passwd' POST field\n");
    if (!empty($config['website']['upload_whitelist']) && !in_array($_SERVER['REMOTE_ADDR'], $config['website']['upload_whitelist']))
        die("ERROR: IP is not whitelisted\n");
    $File->createFromUpload();
}
else
{
	echo "<pre>
THE NON NULL POINTER
====================

HTTP POST files here:
    curl -F'file=@yourfile.png' " . $config['website']['url'] . "

File URLs are valid for at least " . $config['file']['min_age'] . " days and up to a year (see below).

Maximum file size: " . $config['file']['max_size'] . " MiB
Not allowed: child pornography

If you run a server and like this site, clone it! Centralization is bad.
https://github.com/RaJiska/0x1

FILE RETENTION PERIOD
---------------------

retention = min_age + (-max_age + min_age) * pow((file_size / max_size - 1), 3)

   days
    365 |  \
        |   \
        |    \
        |     \
        |      \
        |       \
        |        ..
        |          \
  197.5 | ----------..-------------------------------------------
        |             ..
        |               \
        |                ..
        |                  ...
        |                     ..
        |                       ...
        |                          ....
        |                              ......
     30 |                                    ....................
          0                        256                        512
							      MiB


CREDITS
---------------------

lachs0r for the original idea (https://github.com/lachs0r/0x0), and this file
lachs0r's PayPal: l‍a‍c‍h‍s‍0r‍ ‍＠‍ ‍s‍r‍s‍f‍c‍k‍n‍.‍b‍i‍z (do not copy and paste)
	</pre>";
}
