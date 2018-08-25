# The Non-Null Pointer
This project is a PHP implementation of "The Null Pointer" (0x0) by lachs0r (https://github.com/lachs0r/0x0).  
The purpose of this tool is to seamlessly upload files to a webserver.

## Setup
Clone the repository in your web root, your nginx configuration shall include:
```
location / {
	rewrite ^/$ /scripts/upload.php last;
	rewrite ^/([^/]*)$ /scripts/read.php?file=$1 last;
}

location ~ /(classes|config|crons|logs|sql|uploads) {
	internal;
}
```
Further restrictions will also be required to avoid having files larger than the limit to be uploaded. You can achieve that by editing your PHP configuration or restricting Nginx's request maximum body size.  

You'll also need to setup the cronjob which will delete files after their expiration date:
```
contab -e
0 */1 * * * (cd /path/to/website/root/crons && php clean.php)
```

Finally you'll need to edit the configuration file found in `/config/config.php` to suit your needs.

## Credits
[lachs0r](https://github.com/lachs0r) for the original idea.
