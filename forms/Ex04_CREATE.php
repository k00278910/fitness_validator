<?php
/**
* Ex04_CREATE.php is a sample TEST file for table entity classes
* 
*/


/**
 * 
 * Topic 02 Lecture 02 CRUD Application - Non MVC
 * 
 * Ex04_CREATE.php implements adding a new record to the STUDENT table
 * 
 * @author gerry.guinane
 * @copyright 2022 Gerry Guinane
 * 
 * 
 */

include ('CONFIG/config.php');
include ('CONFIG/database.php');
include ('classlib/baseClasses/TableEntity.php');
include ('classlib/Entities/StudentTable.php');


//get the the DB connection
include_once './CONFIG/connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CRUD</title>
<!--
<!--
<!--
--Load the bootstrap scripts by reference
--Note the use of the 'integrity' property
--More info on that property here: https://blog.compass-security.com/2015/12/subresource-integrity-html-attribute/
-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

<!--apply any local styles if required -->
<style type="text/css">
    body{
        padding-top: 70px;
    }
</style>
</head> 

<body>
    
<div class="container">

<!--Main SECTION--> 

<!--Top of page Navigation menus-->    
<nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">CRUD</a>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="Ex04_CREATE_LOOKUP.php">REGISTER(lookup)</a></li>
                    <li><a href="Ex04_READ.php">QUERY</a></li>
                    <li><a href="Ex04_UPDATE.php">UPDATE</a></li>
                    <li><a href="Ex04_DELETE.php">DELETE</a></li>
            </ul>
        </div>
    </div>
</nav>

<!--Main container for page content-->  
<div class="container-fluid"> 

     
<div class="row">
    <!-- content panel--> 
    <div class="col-md-6" style="background-color:white;">
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo '<h4>REGISTER STUDENT</h4>'; ?></div>
              <div class="panel-body">
                    <?php echo file_get_contents('forms/form_register_student.html');?>
              </div>
            </div>
    </div>

    <!-- content panel--> 
    <div class="col-md-6" style="background-color:white;">
            <div class="panel panel-default">
              <div class="panel-heading"><?php echo '<h4>RESULT</h4>'; ?></div>
              <div class="panel-body">
              <?php 
                    if (isset($_POST['btnRegister'])){
                        //create a student table entity object
                        $studentTable= new StudentTable($db);
                        
                        //get the ID entered in the form
                        $userID=addslashes($_POST['ID']); //add slashes 
                        $userID=strtoupper($userID); //make sure ID is ippercase only
                        
                        
                        if($studentTable->getRecordByID($userID)) { //check if ID is already registered
                            echo 'This ID is already registered';
                            
                            }
                        elseif($studentTable->addRecord($_POST, FALSE)){ //add the new record
                            echo 'New student registered';
                            }
                        else{
                            echo 'Registration NOT successful - something went wrong!'; //add new record has failed
                            }
                        }
                    else{  //the  btnRegister button has not been pressed yet
                        echo 'Enter values in the form - use "Password1" as password<br><br>';
                        echo 'Note that the county drop down menu in this form is hardcoded into the form - ie STATIC CODE!!<br><br>';
                    }     

            ?>
              </div>
            </div>
    </div>
    
</div>
    

<?php if (DEBUG_MODE){
    echo '<h4>Debug info:</h4>';
    echo '$_POST array:</br>';
    echo '<table border="3" style="background-color:#00FF00" >';
    echo '<tr><th>Key</th><th>Value</th></tr>';
    foreach ($_POST as $key=>$value){
        echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
    }
    echo '</table>';
    }
?>  

</div>  <!--end of main content container-->
</div>  <!--end of main container-->
                             		