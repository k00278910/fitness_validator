<?php
/**
 * This file contains the AdminManageRunPlans Class
 * 
 */


/**
 * AdminManageRunPlans is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and content
 * for an 'under construction' page.  
 *
 * 
 * 
 */

class AdminManageRunPlans extends PanelModel
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
        $this->modelType = 'AdminManageRunPlans';
        parent::__construct($user, $db, $postArray, $pageTitle, $pageHead, $pageID);
    }


    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1()
    {
        //$this->panelHead_1='<h3>Panel 1</h3>';
        switch ($this->pageID) {
            case "manageRunPlans":
                $this->panelHead_1 = '<h3>Manage Run Plans </h3>';
                break;
            case "addRunPlans":
                $this->panelHead_1 = '<h3>Add Run Plans (Complete Form)</h3>';
                break;
            case "viewRunPlans":
                $this->panelHead_1 = '<h3>View Run Plans (Complete Form)</h3>';
                break;
            case "editRunPlans":
                $this->panelHead_1 = '<h3>Edit Run Plans (Complete Form)</h3>';
                break;
            case "deleteRunPlans":
                $this->panelHead_1 = '<h3>Delete Run Plans (Complete Form)</h3>';
                break;

            default:
                $this->panelHead_1 = '<h3>Manage Run Plans</h3>';
                break;
        } //end switch          
    }

    /**
     * Set the Panel 1 text content 
     */
    public function setPanelContent_1()
    {
        //$this->panelContent_1 = "Panel 1 content for <b>$this->pageHeading</b> menu item is under construction.";
        switch ($this->pageID) {
            case "manageRunPlans":
                $this->panelContent_1 = "Panel 1 content for <b>$this->pageHeading</b> menu item is under construction.";
                break;
            case "addRunPlans":
                $this->panelContent_1 = Form::form_add_runplan($this->pageID);
                break;
            case "viewRunPlans":
                $this->panelContent_1 = Form::form_select_runplan($this->pageID);
                break;

            case "editRunPlans":
                $this->panelContent_1 = Form::form_select_runplan_edit($this->pageID);
                break;
            case "deleteRunPlans":
                $this->panelContent_1 = Form::form_select_runplan_edit($this->pageID);
                break;


            default:
                $this->panelHead_1 = '<h3>Manage Run Plans</h3>';
                break;
        } //end switch 



    }

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2()
    {
        //$this->panelHead_2 = '<h3>Panel 2</h3>';
        switch ($this->pageID) {
            case "manageRunPlans":
                $this->panelHead_2 = '<h3>Manage Run Plans</h3>';
                break;
            case "addRunPlans":
                $this->panelHead_2 = '<h3>Result of Add Run Plan</h3>';
                break;
            case "viewRunPlans":
                //$this->panelContent_1=Form::form_select_runsession($this->pageID);
                $this->panelHead_2 = '<h3>Selected Run Plan</h3>';
                break;
            case "editRunPlans":
                //$this->panelContent_1=Form::form_select_runsession($this->pageID);
                $this->panelHead_2 = '<h3>Edited Run Plan</h3>';
                break;
            case "deleteRunPlans":
                //$this->panelContent_1=Form::form_select_runsession($this->pageID);
                $this->panelHead_2 = '<h3>Result of Delete Run Plan</h3>';
                break;
            default:
                $this->panelHead_2 = '<h3>Manage Run Plans</h3>';
                break;
        } //end switch   
    }

    /**
     * Set the Panel 2 text content 
     */
    public function setPanelContent_2()
    {
        //$this->panelContent_2 = "Panel 2 content for <b>$this->pageHeading</b> menu item is under construction.";
        switch ($this->pageID) {
            case "manageRunPlans":
                $this->panelContent_2 = "Panel 2 content for <b>$this->pageHeading</b> menu item is under construction.";
                break;
            case "addRunPlans":
                if (isset($this->postArray['btnAddRunPlan'])) {

                    $runPlanTable = new RunPlanTable($this->db);
                    $selected_user = $this->user->getUserFirstName() . " " . $this->user->getUserlastName();
                    if ($runPlanTable->addRecord($this->postArray, $selected_user)) {
                        $this->panelContent_2 = 'New run plan added';
                    } else {
                        $this->panelContent_2 = 'Unable to add new run plan - it may already exist';
                    }
                    break;
                }
            case "viewRunPlans":

                if (isset($this->postArray['btnSelectRunPlan'])) {
                    $runPlanTable = new RunPlanTable($this->db);
                    if ($rs = $runPlanTable->getRecordByIDView($this->postArray['ID'])) { // exists
                        $this->panelContent_2 = HelperHTML::generateTABLE($rs, 'ID', $this->pageID, 'Edit');
                    } else { //session does not exist in DB
                        $this->panelContent_2 = 'Unable to Select plan - check the plan code is valid';
                    }
                } else {
                    $this->panelContent_2 = "Enter a valid plan name";
                }
                break;

            case "editRunPlans":
                if (isset($this->postArray['btnSelectRunPlan'])) {
                    $runPlanTable = new runPlanTable($this->db);
                    if ($rs = $runPlanTable->getRecordByID($this->postArray['ID'], $this->postArray['typeRun'])) {
                        $this->panelContent_2 = Form::form_edit_runplan($rs, $this->pageID);
                    } else {
                        $this->panelContent_2 = 'Oops! Something went wrong getting the selected record.';
                    }
                } elseif (isset($this->postArray['btnUpdateRunPlan'])) {
                    $runPlanTable = new RunPlanTable($this->db);
                    if ($runPlanTable->updateRecord($this->postArray)) {
                        $this->panelContent_2 = 'Record updated successfully';
                    } else {
                        $this->panelContent_2 = 'Unable to update selected record';
                    }
                } else {
                    $this->panelContent_2 = "Enter a valid runsession code";
                }
                break;

            case "deleteRunPlans":
                if (isset($this->postArray['btnSelectRunPlan'])) {

                    $runPlanTable = new RunPlanTable($this->db);

                    if ($runPlanTable->deleteRecordbyID($this->postArray['ID'], $this->postArray['typeRun'])) {
                        $this->panelContent_2 = 'Session Deleted';
                    } else {
                        $this->panelContent_2 = 'Unable to Delete session - it may already be deleted or not exist ';
                    }
                } else {
                    $this->panelContent_2 = "Enter values in the form";
                }
                break;


            default:
                $this->panelContent_2 = "Panel 2 content for <b>$this->pageHeading</b> *this menu item is under construction.";
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