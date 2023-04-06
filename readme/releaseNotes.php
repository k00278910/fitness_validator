<?php
/**
 * This file contains release notes for this MVC framework
 */

/**
 * 
 * @author gerry.guinane
 * 
 * Version 0.2 Date 15 Feb 2021 Initial framework release
 * 
 * Version 0.3 Date 17 Feb 2021 Removed un-neccessary code from User class. Added sample dummy menu item for Customer 
 * 
 * Version 0.4 Date 19 Feb 2021 Modified Model Base Class 
 * 
 * Version 0.5 Date 08 Mar 2021 Modified 
 *          index.php - force logout for unknown user types 
 *          Model constructors modified to take $user as argument
 *          Improved logout process
 *          .htaccess files added to provide sub folder security
 * 
 * Version 0.6 Date 10 Mar 2021 Bug Fix HelperHTML class 
 * 
 * Version 0.7 Date 22 Mar 2021 
 *          Form Generator class (Form.php) added to generate all required static and dynamic forms  
 *          HelperHTML class (HelperHTML.php) - generateSelectTABLE helper function added
 *          ChatMsgTable Entity class (ChatMsgTable.php) added
 *          Simple messaging functionality (view/send/delete) added for CUSTOMER user type
 * 
 * Version 0.8 Date 20 April 2021
 *          Added in AJAX CHAT functionality for CUSTOMER USER
 *          --All views modified to include CHAT Javasceipt
 *          --Customer CHAT message functionality added to NavigationCustomer and CustomerController
 *          --config.php modified to add AJAX specific setup
 *          --Form.php class modified to include form_add_msg() method
 * 
 * Version 0.9 Date 30 January 2022
 *          Changes to config.php to make AJAX configuration work better
 *          Some minor bug fixes
 * 
 * Version 0.10 Date 01 February 2022
 *          Changes to the readme/installation to be more informative
 * 
 * Version 0.11 07/02/2022
 *          Implemented interfaces for controllers and for panel content and navbar models
 *          Implement abstract parent classes.
 * 
 * Version 0.12 22/02/2022
 *          Implemented single user table to simplify login
 *          Fully documented using phpDocumentor
 * 
 * Version 0.13
 *    
 * 
 * File Changed             Changes Made   
 * ===============          ============================================= 
 * GeneralHome.php          Typo correction
 * 
 * Controller.php           Tidied up diagnostics section to make it look more readable
 * 
 * Login.php                Removed inaccessible code
 * 
 * NavigationManager.php    Typo corrected in getDiagnosticInfo()
 * 
 * NavigationAdmin.php      Typo corrected in getDiagnosticInfo()
 * 
 * NavigationCustomer.php   Typo corrected in getDiagnosticInfo()
 * 
 * ManagerController.php    Change the push order of the navigation and content models into the controller object array
 * 
 * AdminController.php      Change the push order of the navigation and content models into the controller object array
 * 
 * GeneralController.php    Change the push order of the navigation and content models into the controller object array
 * 
 * CustomerController.php   Change the push order of the navigation and content models into the controller object array
 * 
 * PanelModel.php           Change - Set Panel2 content before Panel 1
 * 
 * Bug Reports:
 *  Bug fix HTMLhelper class
 *  Bug fix Messages using email as msgAuthorID for new messages added. Needs to change to PK user ID. 
 * 
 */

/*
 * echo the current version
 */
echo 'Current version is 0.13';
