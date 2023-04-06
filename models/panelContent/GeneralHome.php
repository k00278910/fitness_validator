<?php

/**
 * This file contains the GeneralHome Class
 * 
 */

/**
 * GeneralHome is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and content
 * for not logged in  user home page.  
 *
 * 
 * 
 */
class GeneralHome extends PanelModel {

    /**
     * Constructor Method
     * 
     * The constructor for the PanelModel class. The ManageSystems class provides the 
     * panel content for up to 3 page panels.
     * 
     * @param User $user  The current user
     * @param MySQLi $db The database connection handle
     * @param Array $postArray Copy of the $_POST array
     * @param String $pageTitle The page Title
     * @param String $pageHead The Page Heading
     * @param String $pageID The currently selected Page ID
     */
    function __construct($user, $db, $postArray, $pageTitle, $pageHead, $pageID) {
        $this->modelType = 'GeneralHome';
        parent::__construct($user, $db, $postArray, $pageTitle, $pageHead, $pageID);
    }

    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1() {
        $this->panelHead_1 = '<h3>Heart Rate Training Validator</h3>';
    }

    /**
     * Set the Panel 1 text content 
     */
    public function setPanelContent_1() {
        //User is not logged in
        $this->panelContent_1 .= '<p>Heart rate training is a highly effective approach to improving cardiovascular fitness and overall health. By monitoring and controlling your heart rate during exercise, you can optimize the intensity and duration of your workouts.

One of the key benefits of heart rate training is that it enables you to train more efficiently. By keeping your heart rate within a specific range, you can ensure that you are working hard enough to challenge your cardiovascular system, but not so hard that you risk injury or burnout. ';
    
        $this->panelContent_1 .= '<p> Regular cardiovascular exercise has been shown to reduce the risk of heart disease, stroke, and other chronic illnesses. By optimizing your workouts through heart rate training, you can maximize the health benefits of exercise and improve your overall well-being.By monitoring your heart rate during workouts, you can ensure that you are giving your body enough time to recover between sessions. This can help reduce the risk of injury and fatigue, and allow you to maintain a consistent workout routine over the long term.';
        
        $this->panelContent_1 .= '<p>The aim of this application is to provide a client with appropriate options to progress from walking to running a 5km distance. This is in the form of a 3 step plan; (1) 8 week walking plan (2) 8 week "couch to 5km" run-walk plan (3) 8 week 5km running plan. Heart rate metrics are introduced for the running plan only, this involves validation of the client heart rate against the advised heart rate zone for the main phase of each session. It will be necessary for the client to complete a 20 minute threshold Heart Rate fitness test as a guide to establish zones.  ';
        
    }

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2() {
        $this->panelHead_2 = '<h3>Please Login or Register to proceed</h3>';
    }

    /**
     * Set the Panel 2 text content 
     */
    public function setPanelContent_2() {
        //set the Middle panel content    

        if ($this->pageID === 'unknownUserType') {  //the user Type is not valid
            $this->panelContent_2 = 'Your login credentials are not recognised.Please use the link above to login. This login page supports login for 2 user types: ADMIN and CLIENT. <br><br> Refer to the set up instructions for some sample logins. ';
        } else {
            $this->panelContent_2 = 'You are required to login - Please use the link above to login. This login page supports login for 2 user types: ADMIN and CLIENT. <br><br> Refer to the set up instructions for some sample logins. ';
        }
        $this->panelContent_2 = '<img src="images/xfocas_logo.jpg" alt="logo"> ';
    }

    /**
     * Set the Panel 3 heading 
     */
    public function setPanelHead_3() {
        $this->panelHead_3 = '<h3>Application Setup</h3>';
    }

    /**
     * Set the Panel 3 text content 
     */
    public function setPanelContent_3() {
        $this->panelContent_3 = "<p>To set up this application read the following <a href='readme/installation.php' target='_blank' >SETUP INSTRUCTIONS</a></p>";
    }

}
