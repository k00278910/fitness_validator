<?php

//connect using object oriented method - use MySQLi class
//MySQLi class : http://php.net/manual/en/class.mysqli.php

//initialise connection error flags
$errorNo=0000;
$errorMsg='';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $db = new mysqli($DBServer, $DBUser, $DBPass, $DBName, $DBportNr);
} catch (\mysqli_sql_exception $e) {
     $errorNo=$e->getCode();
     $errorMsg=$e->getMessage(); 
}


//check if there is an error in the connection
if($errorNo){  
    if (DEBUG_MODE){
        $msg = '<h3>Unable to make Database Connection</h3>';
        //report on connection issue
        $msg.= '<p>There has been a proble making connection to MySQL Server - MySQLi Error message:';
        $msg.= '<ul>';
        $msg.= '<li>MySQLi Error Number  : ' . $errorNo. '</li>';
        $msg.= '<li>MySQLi Error Message : '.$errorMsg. '</li>';
        $msg.= '</ul>';
    }
    else{
        $msg= '<h4>Oops - something is not working!</h4>';
    }
    exit($msg);  //the script exits here if no database connection can be made
}

//make sure database connection is set to support UTF8 characterset
$db->query("SET NAMES 'utf8'"); 

//DB connection is successful

