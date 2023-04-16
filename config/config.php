<?php
/**
 * This file contains the configuration settings  for this application
 * 
 */

/**
 * This file contains settings that are required by the framework and to control
 * how it operates.  
 * 
 */

//configure site wide constant values
define('DEBUG_MODE', TRUE); //True for DEBUG mode turned on
define('ENCRYPT_PW', TRUE); //True if Passwords are hash encrypted
define('PAGE_TITLE', 'DDA Framework'); //site wide page title (tab label at top of web page)

//AJAX Configuration - read the SETUP INSTRUCTIONS
define('CHAT_ENABLED', false); //True if AJAX Chat  is enabled
$serverIP_address = '127.0.0.1'; //network IP address of the Apache Server
$root_path = 'hr_training_validator_1.6/'; //path from htdocs folder to the default page (usually index.php) of this web application
define('__THIS_URI_ROOT', 'http://' . $serverIP_address . '/' . $root_path); //Define root URL folder for this website


//Note - no PHP end tag in this file : 
//If a file contains only PHP code, it is preferable to omit the PHP closing tag at the end of the file.
//This prevents accidental whitespace or new lines being added after the PHP closing tag
