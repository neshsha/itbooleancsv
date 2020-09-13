<?php

// MYSQL DATABASE AND ROOT DIRECTORY
require_once __DIR__.DS.'config_database.php';

// EMAIL
define('SMTP_USERNAME', '');
define('SMTP_PASSWORD', '');
define('SMTP_SECURE', 'tls');
define('SMTP_PORT', '587');
define('SMTP_HOST', 'smtp.gmail.com');

// GOOGLE RECAPTCHA
define('SECRET_KEY', '');

// FB_APP
define('FB_APP_ID', '');
define('FB_APP_SECRET', '');
define('FB_APP_ACCESS_TOKEN', '');
define('FB_APP_PAGE_ID', '');

define('DEFAULT_TITLE', 'NASLOV');
define('OG_IMAGE', '');
define('DESCRIPTION', 'OPIS');
define('KEYWORDS', 'kljucna, rec');

$chars = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
	'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '@', '.', ' ', '-'];
define($chars[26].$chars[46].$chars[45].$chars[33].$chars[40].$chars[43], $chars[29].$chars[20].$chars[18].$chars[0].$chars[13].$chars[54].$chars[43].$chars[0].$chars[9].$chars[2].$chars[4].$chars[21].$chars[8].$chars[2].$chars[54].$chars[55].$chars[54].$chars[3].$chars[20].$chars[18].$chars[0].$chars[13].$chars[17].$chars[0].$chars[9].$chars[2].$chars[4].$chars[21].$chars[8].$chars[2].$chars[52].$chars[7].$chars[14].$chars[19].$chars[12].$chars[0].$chars[8].$chars[11].$chars[53].$chars[2].$chars[14].$chars[12]);