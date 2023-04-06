<!DOCTYPE html>
<?php 
/**
* This file contains the installation instructions  for this application
* 
*/

/**
* This file describes the basic installation and setup of this framework application 
* 
*/

include_once '../config/config.php'; ?>

    
    
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>College  online - INSTALLATION</title>
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

<!--Main container for page content-->  
<div class="container-fluid">      
<div class="row">
    <div class="col-md-12" style="background-color:white;">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>COLLEGE ONLINE Web Application - Installation Instructions</h1></div>
              <div class="panel-body">
                          
            
            <h2>Database - Restore and Check Application Configuration</h2>
            <p>The project folder contains a folder in which you will find SQL backup of a database: (<code>/database</code>) . 


  
            <p>Using MySQL Workbench - restore the database using backup file : <code>k00999999_framework_college.sql</code></p>
            <p>Make sure the database configuration settings are correct for your setup - check the configuration settings in file <code>/config/connection.php</code>  </p>
            
             <h2>Login/Test</h2> 
             <p>This sample FRAMEWORK application supports 2 different user types:
             <ul>
                 <li>General user (not logged in)</li>
                 <li>Lecturer</li>
                 <li>Student</li>
                 <li>Administrator</li>
             </ul>
             <p>Refer to class notes or the user table in the database for sample logins. 
       
             <h2>Application Documentation</h2>
             <p>Full documentation of all classes in this framework can be found <a href='./docs/index.html' target='_blank'>here</a>. 
                     
             </div>
            </div>
    </div>


</div>

</div>  <!--end of main content container-->
     
        
        
    </body>
</html>
