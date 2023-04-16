<?php
/**
 * This is the entry point for this web application
 * 
 */


/**
 * 
 * Model View Controller FRAMEWORK Application
 * 
 * This framework application is intended for educational use. 
 * 
 * This is the main entry point for this MVC application
 * 
 * 
 * 
 * 
 */

//join/start a session between the browser client and Apache web server
session_start();

//load application configuration
include_once 'config/config.php';
include_once 'config/database.php';

//load class library
//Interfaces
include_once 'classlib/interfaces/PanelModelInterface.php';
include_once 'classlib/interfaces/NavigationInterface.php';
include_once 'classlib/interfaces/ControllerInterface.php';

//Base Classes
include_once 'classlib/baseClasses/Controller.php';
include_once 'classlib/baseClasses/PanelModel.php';
include_once 'classlib/baseClasses/TableEntity.php';


//System Classes
include_once 'classlib/system/Session.php';
include_once 'classlib/system/User.php';
include_once 'classlib/system/Installer.php';


//helper classes
include('classlib/helperClasses/HelperHTML.php');

//Database Table Entities
include_once 'classlib/entities/UserTable.php';
include_once 'classlib/entities/RunSessionTable.php';
include_once 'classlib/entities/RunPlanTable.php';
include_once 'classlib/entities/ChatMsgTable.php';


//Controller Clases for specific user types
include_once 'controllers/GeneralController.php';
include_once 'controllers/ClientController.php';
include_once 'controllers/AdminController.php';



//Navigation models
include_once 'models/navigationBarContent/NavigationGeneral.php';
include_once 'models/navigationBarContent/NavigationClient.php';
include_once 'models/navigationBarContent/NavigationAdmin.php';



//Page models - Common
include_once 'models/panelContent/GeneralHome.php';
include_once 'models/panelContent/UnderConstruction.php';
//include_once 'models/panelContent/ZoneCalculator.php';
include_once 'models/panelContent/Login.php';
include_once 'models/panelContent/Register.php';

//forms
include_once 'forms/Form.php';

//Page models - ADMIN user
include_once 'models/panelContent/AdminHome.php';
include_once 'models/panelContent/AdminManageClients.php';
include_once 'models/panelContent/AdminManageRunPlans.php';
include_once 'models/panelContent/AdminManageRunSessions.php';

//Page models - CLIENT user
include_once 'models/panelContent/ClientHome.php';
include_once 'models/panelContent/ClientManageProfile.php';
include_once 'models/panelContent/ZoneCalculator.php';
include_once 'models/panelContent/ClientPlan.php';




//initialise connection error flags
$errorNo = 0000;
$errorMsg = '';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $db = new mysqli($DBServer, $DBUser, $DBPass, $DBName, $DBportNr);
} catch (\mysqli_sql_exception $e) {
    $errorNo = $e->getCode();
    $errorMsg = $e->getMessage();
}

//Diagnose and fix MySQL database and MySQL connection related problems if DEBUG mode is turned on 
if ($errorNo) {
    if (DEBUG_MODE) {
        $msg = '<h2>Unable to make Database Connection</h2>';


        $msg .= '<h3>Diagnostics and possible fixes</h3>';
        switch ($errorNo) {
            case '1049':
                //DB installer form
                $form = '<br>';
                $form .= '<form method="post" action="index.php">';
                $form .= '<button type="submit" class="btn btn-default" value="TRUE" name="btnInstall">Install Framework Database</button>';
                $form .= '</form>';

                $msg .= 'MySQLi ERROR Encountered:<ul>';
                $msg .= '<li>MySQLi Error Number  : ' . $errorNo . '</li>';
                $msg .= '<li>MySQLi Error Message : ' . $errorMsg . '</li>';
                $msg .= '</ul>';
                $msg .= 'Possible Solutions/Fixes : <ul>';
                $msg .= '<li>Database is being reported by the MySQL server - a number of things need to be checked here</li>';
                $msg .= '<li>Check the database configuration parameters (<code>$DBServer, $DBportNr & $DBName</code>) are set up correctly in <code>../config/database.php</code></li>';
                $msg .= '<li>Check the database exists on the MySQL server you are using</li>';
                $msg .= '<li>If the database has not been installed in the MySQL server - Install the database - click button below: </li>' . $form;
                $msg .= '</ul>';
                break;

            case '2002':
                $msg .= 'MySQLi ERROR Encountered:<ul>';
                $msg .= '<li>MySQLi Error Number  : ' . $errorNo . '</li>';
                $msg .= '<li>MySQLi Error Message : ' . $errorMsg . '</li>';
                $msg .= '</ul>';
                $msg .= 'Possible Solutions/Fixes : <ul>';
                $msg .= '<li>Unable to make a connection to the MySQL server -  a number of things need to be checked here</li>';
                $msg .= '<li>Check that your MySQL Server is running in XAMPP </li>';
                $msg .= '<li>Check the database configuration parameters (<code>$DBServer, $DBportNr & $DBName</code>) are set up correctly in <code>../config/database.php</code></li>';
                $msg .= '</ul>';
                break;

            case '1045':
                $msg .= 'MySQLi ERROR Encountered:<ul>';
                $msg .= '<li>MySQLi Error Number  : ' . $errorNo . '</li>';
                $msg .= '<li>MySQLi Error Message : ' . $errorMsg . '</li>';
                $msg .= '</ul>';
                $msg .= 'Possible Solutions/Fixes : <ul>';
                $msg .= '<li>Access denied for user may be as a result of incorrect user credentials (username and password).</li>';
                $msg .= '<li>Check the username (<code>$DBUser</code>) and password (<code>$DBPass</code>) are set up correctly in <code>../config/database.php</code></li>';
                $msg .= '</ul>';
                break;

            default:
                $msg .= 'MySQLi ERROR Encountered:<ul>';
                $msg .= '<li>MySQLi Error Number  : ' . $errorNo . '</li>';
                $msg .= '<li>MySQLi Error Message : ' . $errorMsg . '</li>';
                $msg .= '</ul>';
                $msg .= 'Possible Solutions/Fixes : <ul>';
                $msg .= '<li>This error code is not handled by this diagnostic function - you will find a full list of MarisDB codes <a href="https://mariadb.com/kb/en/mariadb-error-codes/" target="_blank">here</a></li>';
                $msg .= '</ul>';
                break;
        }
        if (isset($_POST['btnInstall'])) { //install the database
            $form = '<br>';
            $form .= '<form method="post" action="index.php">';
            $form .= '<button type="submit" class="btn btn-default" value="TRUE" name="btnInstallDone">Restart this application</button>';
            $form .= '</form>';
            $msg .= Installer::installDB($DBServer, $DBUser, $DBPass, $DB_backup_file) . $form;
        }
    } else { //DEBUG mode is turned off
        $msg = '<h4>Oops - something is not working! - Turn on DEBUG mode to get more information</h4>';
    }

    exit($msg); //the script exits here if no valid database connection can be made    
}

$db->query("SET NAMES 'utf8'"); //make sure database connection is set to support UTF8 characterset

//Create the new session object
$session = new Session();
$session->setChatEnabledState(CHAT_ENABLED);
$user = new User($session, $db, ENCRYPT_PW);


if ($user->getLoggedInState()) {

    //load the appropriate controller depending on the user type

    switch ($user->getUserType()) {


        case "CLIENT": //create new  CLIENT controller
            $controller = new ClientController($user, $db, PAGE_TITLE);
            break;

        case "ADMIN": //create new ADMIN controller
            $controller = new AdminController($user, $db, PAGE_TITLE);
            break;

        default: //create new general/not logged in controller
            //unidentified user type  - force logout to reset system state
            $user->logout();
            $controller = new GeneralController($user, $db, PAGE_TITLE);
            break;
    }
} else {
    //user is not logged in
    //create new general/not logged in controller
    $controller = new GeneralController($user, $db, PAGE_TITLE);
}




//run the application
$controller->run();



//Debug information
if (DEBUG_MODE) {
    //Comment out whichever info you dont want to use.


    echo '<section>';
    echo '<!-- The Debug SECTION  of index.php-->';
    echo '<div class="container-fluid"   style="background-color: #AA44AA">'; //outer DIV

    echo '<h2>Index.php - Debug information</h2><br>';

    echo '<section style="background-color: #AAAAAA">';
    echo '<pre><h5>SESSION Class</h5>';
    $session->getDiagnosticInfo();
    echo '</pre>';
    echo '</section>';

    echo '<section style="background-color: #AAAAAA">';
    echo '<pre><h5>USER Class</h5>';
    $user->getDiagnosticInfo();
    echo '</pre>';
    echo '</section>';

    echo '<section style="background-color: #AAAAAA" >';
    echo '<!-- $_COOKIE ARRAY SECTION  -->';
    echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV  
    echo '<h3>$_COOKIE Array values</h3>';
    echo '<table border=1  style="background-color: #EEEEEE" >';
    foreach ($_COOKIE as $key => $value) {
        echo '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
    }
    echo '</table><hr>';
    echo '<!-- END $_COOKIE ARRAY SECTION  -->';
    echo '</section>';

    echo '<section style="background-color: #AAAAAA" >';
    echo '<!-- $_SESSION ARRAY SECTION  -->';
    echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV  
    echo '<h3>$_SESSION Array values</h3>';
    echo '<table border=1  style="background-color: #EEEEEE" >';
    foreach ($_SESSION as $key => $value) {
        echo '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
    }
    echo '</table><hr>';
    echo '<!-- END $_SESSION ARRAY SECTION  -->';
    echo '</section>';

    echo '<section style="background-color: #AAAAAA" >';
    echo '<!-- $_POST ARRAY SECTION  -->';
    echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV  
    echo '<h3>$_POST Array values</h3>';
    echo '<table border=1  style="background-color: #EEEEEE" >';
    foreach ($_POST as $key => $value) {
        echo '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
    }
    echo '</table><hr>';
    echo '<!-- END $_POST ARRAY SECTION  -->';
    echo '</section>';

    echo '<section style="background-color: #AAAAAA" >';
    echo '<!-- $_GET ARRAY SECTION  -->';
    echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV  
    echo '<h3>$_GET Array values</h3>';
    echo '<table border=1  style="background-color: #EEEEEE" >';
    foreach ($_GET as $key => $value) {
        echo '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
    }
    echo '</table><hr>';
    echo '<!-- END $_GET ARRAY SECTION  -->';
    echo '</section>';

    echo '<section style="background-color: #AAAAAA" >';
    echo '<!-- config.php GLOBAL variables  -->';
    echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV  
    echo '<h3>GLOBAL variables (config/config.php) </h3>';
    echo '<table border=1  style="background-color: #EEEEEE" >';
    echo '<tr><td>ENCRYPT_PW</td><td>' . ENCRYPT_PW . '</td></tr>';
    echo '<tr><td>CHAT_ENABLED</td><td>' . CHAT_ENABLED . '</td></tr>';
    echo '<tr><td>__THIS_URI_ROOT</td><td>' . __THIS_URI_ROOT . '</td></tr>';
    echo '</table><hr>';
    echo '<!-- END config.php GLOBAL variables  -->';
    echo '</section>';

    echo '<section style="background-color: #AAAAAA" >';
    echo '<!-- DATABASE Configuration (config/database.php)  -->';
    echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV  
    echo '<h3>DATABASE Configuration (config/database.php) </h3>';
    echo '<table border=1  style="background-color: #EEEEEE" >';
    echo '<tr><td>MySQL Server IP Address</td><td>' . $DBServer . '</td></tr>';
    echo '<tr><td>MySQL Server PORT Number</td><td>' . $DBportNr . '</td></tr>';
    echo '<tr><td>User ID</td><td>' . $DBUser . '</td></tr>';
    echo '<tr><td>Password</td><td>' . $DBPass . '</td></tr>';
    echo '<tr><td>Database Name</td><td>' . $DBName . '</td></tr>';
    echo '</table><hr>';
    echo '<!-- END DATABASE Configuration (config/database.php)  -->';
    echo '</section>';

    echo '</section>';

    echo '</section>';
    echo '</br>';
    echo '</div>';
    //controller class debug info        
    $controller->debug();

}
;
echo '</body></html>'; //end of HTML Document

//close or release any open connections/resources
//close the DB Connection
$db->close();