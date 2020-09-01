<?php

# Site Config
# ================================================================= #
header('Content-Type: text/html; charset=UTF-8');
define('DEBUG', true);
define('URL','https://example.com/');
define('PATH', $_SERVER['DOCUMENT_ROOT'].'app/');
define('HASH','91@a9-d3[0eb_7b2>fa5!cff.a$fd64%07f&018?3+b8');

# Database
# ================================================================= #
define('DB_EXT','mysqli');
define('DB_HOST','localhost'); 
define('DB_NAME','db_name');
define('DB_USER','db_user');
define('DB_PASS','********');
define('DB_PORT','3306');