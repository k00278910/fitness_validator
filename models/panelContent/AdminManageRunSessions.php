<?php
/**
 * This file contains the AdminManageRunSessions Class
 * 
 */


/**
 * AdminManageRunSessions is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and content
 * for an 'under construction' page.  
 *
 * 
 * 
 */

class AdminManageRunSessions extends PanelModel
{

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
    function __construct($user, $db, $postArray, $pageTitle, $pageHead, $pageID)
    {
        $this->modelType = 'AdminManageRunSessions';
        parent::__construct($user, $db, $postArray, $pageTitle, $pageHead, $pageID);
    }


    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1()
    {
        //$this->panelHead_1='<h3>Panel 1</h3>';   
        switch ($this->pageID) {
            case "manageRunSessions":
                $this->panelHead_1 = '<h3>Manage Run Sessions </h3>';
                break;
            case "addRunSessions":
                $this->panelHead_1 = '<h3>Add Run Session (Complete Form)</h3>';
                break;
            case "viewRunSessions":
                $this->panelHead_1 = '<h3>Current Run Sessions </h3>';
                break;
            case "editRunSessions":
                $this->panelHead_1 = '<h3>Edit Run Session (Complete Form)</h3>';
                break;
            case "deleteRunSessions":
                $this->panelHead_1 = '<h3>Delete Run Session (Complete Form)</h3>';
                break;

            default:
                $this->panelHead_1 = '<h3>Manage Run Sessions</h3>';
                break;
        } //end switch    
    }


    /**
     * Set the Panel 1 text content 
     */
    public function setPanelContent_1()
    {
        switch ($this->pageID) {
            case "manageRunSessions":
                $this->panelContent_1 = "Panel 1 content for <b>$this->pageHeading</b> menu item is under construction.";
                break;
            case "addRunSessions":
                $this->panelContent_1 = Form::form_add_runsession($this->pageID);
                break;
            case "viewRunSessions":

                $runTable = new RunSessionTable($this->db);

                if ($rs = $runTable->viewAll()) { //session exists
                    $this->panelContent_1 = HelperHTML::generateTABLE($rs, $this->pageID, 'Edit');
                } else { //session does not exist in DB
                    $this->panelContent_1 = 'Unable to Select session - check the session code is valid';
                }


                break;
            case "editRunSessions":
                $this->panelContent_1 = Form::form_select_runsession($this->pageID);
                break;
            case "deleteRunSessions":
                $this->panelContent_1 = Form::form_select_runsession($this->pageID);
                break;


            default:
                $this->panelContent_1 = "Panel 1 content for <b>$this->pageHeading</b> menu item is under construction.";
                break;
        } //end switch 

    }

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2()
    {
        //$this->panelHead_2='<h3>Panel 2</h3>'; 
        switch ($this->pageID) {
            case "manageRunSessions":
                $this->panelHead_2 = '<h3>Manage Run Sessions</h3>';
                break;
            case "addRunSessions":
                $this->panelHead_2 = '<h3>Add Run Sessions</h3>';
                break;
            case "viewRunSessions":
                //$this->panelContent_1=Form::form_select_runsession($this->pageID);
                $this->panelHead_2 = '<h3>Run Sessions</h3>';
                break;
            case "editRunSessions":
                //$this->panelContent_1=Form::form_select_runsession($this->pageID);
                $this->panelHead_2 = '<h3>Edit Run Sessions</h3>';
                break;
            case "deleteRunSessions":
                //$this->panelContent_1=Form::form_select_runsession($this->pageID);
                $this->panelHead_2 = '<h3>Delete Run Sessions</h3>';
                break;
            default:
                $this->panelHead_2 = '<h3>Delete Run Sessions</h3>';
                break;
        } //end switch   

    }

    /**
     * Set the Panel 2 text content 
     */
    public function setPanelContent_2()
    {
        switch ($this->pageID) {
            case "manageRunSessions":
                $this->panelContent_2 = "Panel 2 content for <b>$this->pageHeading</b> menu item is under construction.";
                break;
            case "addRunSessions":
                if (isset($this->postArray['btnAddRunSession'])) {

                    $runTable = new RunSessionTable($this->db);

                    if ($runTable->addRecord($this->postArray)) {
                        $this->panelContent_2 = 'New module added';
                    } else {
                        $this->panelContent_2 = 'Unable to add new module - it may already exist';
                    }
                    break;

                }
            case "viewRunSessions":

            // $runTable = new RunSessionTable($this->db);

            // if ($rs = $runTable->viewAll()) { //session exists
            //     $this->panelContent_2 = HelperHTML::generateTABLE($rs, $this->pageID, 'Edit');
            //} else { //session does not exist in DB
            //     $this->panelContent_2 = 'Unable to Select session - check the session code is valid';
            //  }

            //  break;

            case "editRunSessions":
                if (isset($this->postArray['btnSelectRunSession'])) {
                    $runTable = new runSessionTable($this->db);
                    if ($rs = $runTable->getRecordByID($this->postArray['sessionName'])) {
                        $this->panelContent_2 = Form::form_edit_runsession($rs, $this->pageID);
                    } else {
                        $this->panelContent_2 = 'Oops! Something went wrong getting the selected record.';
                    }
                } elseif (isset($this->postArray['btnUpdateRunSession'])) {
                    $runTable = new RunSessionTable($this->db);
                    if ($runTable->updateRecord($this->postArray)) {
                        $this->panelContent_2 = 'Record updated successfully';
                    } else {
                        $this->panelContent_2 = 'Unable to update selected record';
                    }
                } else {
                    $this->panelContent_2 = "Enter a valid runsession code";
                }
                break;
            case "deleteRunSessions":
                if (isset($this->postArray['btnSelectRunSession'])) {

                    $runTable = new RunSessionTable($this->db);

                    if ($runTable->deleteRecordByID($this->postArray['sessionName'])) {
                        $this->panelContent_2 = 'Session Deleted';
                    } else {
                        $this->panelContent_2 = 'Unable to Delete session - it may already be deleted or not exist ';
                    }
                } else {
                    $this->panelContent_2 = "Enter values in the form";
                }
                break;




            default:
                $this->panelContent_2 = "Panel 2 content for <b>$this->pageHeading</b> menu item is under constructionzz.";
                break;
        } //end switch

    }

    /**
     * Set the Panel 3 heading 
     */
    public function setPanelHead_3()
    {
        $this->panelHead_3 = '<h3>Panel 3</h3>';
    }

    /**
     * Set the Panel 3 text content 
     */
    public function setPanelContent_3()
    {
        $this->panelContent_3 = "Panel 3 content for <b>$this->pageHeading</b> menu item is under construction.";
    }



}