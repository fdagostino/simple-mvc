<?php

# Session Start
# ================================================
session_start();

# Load Config
# ================================================
$whitelist = [ '127.0.0.1', '::1', 'localhost' ];
if(in_array($_SERVER['REMOTE_ADDR'], $whitelist))
  require 'app/local-config.php';
else
  require 'app/config.php';

# Load requires
# ================================================
require 'vendor/autoload.php';

# Routes
# ================================================
require 'app/routes.php';

# Start aplication
# ================================================
$route = $router->run();

# Unset Flash
# ================================================
unset($_SESSION['flash']);

/*
function __( $string ){
	return  $string;
}
*/
