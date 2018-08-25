<?php
/* Name of the website */
$config['website'] = "0x1 (Non-Null Pointer)";
$config['website_url'] = "http://website.com";

$config['nginx']['enabled'] = false; /* Turn on if you use Nginx */
$config['nginx']['x_accel_redirect'] = true; /* Recommended */
$config['nginx']['x_accel_limit'] = 0; /* Limit bandwidth to 2 MB/s (0 = disabled) */

$config['file']['min_age'] = 30; /* Days */
$config['file']['max_age'] = 365; /* Days */
$config['file']['max_size'] = 512; /* MB */
$config['urlsalt'] = "somesalt";
$config['shortenedurl_size'] = 4; /* May not be larger than SHA1 digest / 2 */
$config['uploads_dir'] = dirname(__DIR__) . "/uploads";
$config['logs_dir'] = dirname(__DIR__) . "/logs";

/* MySQL DB Credentials */
$config['db']['host'] = "localhost";
$config['db']['name'] = "nnullptr";
$config['db']['username'] = 'nnullptr_user';
$config['db']['password'] = 'passwd';
$config['db']['logfile'] = 'database.txt';

/* MIME List Association */
$config["mimesextensions"] = array(
	"text/html" => "html",
	"text/css" => "css",
	"text/xml" => "xml",
	"image/gif" => "gif",
	"image/jpeg" => "jpeg",
	"application/javascript" => "js",
	"application/atom+xml" => "atom",
	"application/rss+xml" => "rss",
	"text/mathml" => "mml",
	"text/plain" => "txt",
	"text/vnd.sun.j2me.app-descriptor" => "jad",
	"text/vnd.wap.wml" => "wml",
	"text/x-component" => "htc",
	"image/png" => "png",
	"image/tiff" => "tif",
	"image/vnd.wap.wbmp" => "wbmp",
	"image/x-icon" => "ico",
	"image/x-jng" => "jng",
	"image/x-ms-bmp" => "bmp",
	"image/svg+xml" => "svg",
	"image/webp" => "webp",
	"application/font-woff" => "woff",
	"application/java-archive" => "jar",
	"application/json" => "json",
	"application/mac-binhex40" => "hqx",
	"application/msword" => "doc",
	"application/pdf" => "pdf",
	"application/postscript" => "ps",
	"application/rtf" => "rtf",
	"application/vnd.apple.mpegurl" => "m3u8",
	"application/vnd.ms-excel" => "xls",
	"application/vnd.ms-fontobject" => "eot",
	"application/vnd.ms-powerpoint" => "ppt",
	"application/vnd.wap.wmlc" => "wmlc",
	"application/vnd.google-earth.kml+xml" => "kml",
	"application/vnd.google-earth.kmz" => "kmz",
	"application/x-7z-compressed" => "7z",
	"application/x-cocoa" => "cco",
	"application/x-java-archive-diff" => "jardiff",
	"application/x-java-jnlp-file" => "jnlp",
	"application/x-makeself" => "run",
	"application/x-perl" => "pl",
	"application/x-pilot" => "prc",
	"application/x-rar-compressed" => "rar",
	"application/x-redhat-package-manager" => "rpm",
	"application/x-sea" => "sea",
	"application/x-shockwave-flash" => "swf",
	"application/x-stuffit" => "sit",
	"application/x-tcl" => "tcl",
	"application/x-x509-ca-cert" => "der",
	"application/x-xpinstall" => "xpi",
	"application/xhtml+xml" => "xhtml",
	"application/xspf+xml" => "xspf",
	"application/zip" => "zip",
	"application/octet-stream" => "bin",
	"application/vnd.openxmlformats-officedocument.wordprocessingml.document" => "docx",
	"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" => "xlsx",
	"application/vnd.openxmlformats-officedocument.presentationml.presentation" => "pptx",
	"audio/midi" => "mid",
	"audio/mpeg" => "mp3",
	"audio/ogg" => "ogg",
	"audio/x-m4a" => "m4a",
	"audio/x-realaudio" => "ra",
	"video/3gpp" => "3gpp",
	"video/mp2t" => "ts",
	"video/mp4" => "mp4",
	"video/mpeg" => "mpeg",
	"video/quicktime" => "mov",
	"video/webm" => "webm",
	"video/x-flv" => "flv",
	"video/x-m4v" => "m4v",
	"video/x-mng" => "mng",
	"video/x-ms-asf" => "asx",
	"video/x-ms-wmv" => "wmv",
	"video/x-msvideo" => "avi"
);