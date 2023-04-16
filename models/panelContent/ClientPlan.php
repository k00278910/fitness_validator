<?php
/**
 * This file contains the ClientPlan Class
 * 
 */


/**
 * UnderConstruction is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and content
 * for an 'under construction' page.  
 *
 * 
 * 
 */

class ClientPlan extends PanelModel
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
        $this->modelType = 'ClientPlan';
        parent::__construct($user, $db, $postArray, $pageTitle, $pageHead, $pageID);
    }


    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1()
    {

        switch ($this->pageID) {
            case "viewRunPlan":
                $selected_user = $this->user->getUserFirstName() . " " . $this->user->getUserlastName();
                $selected_client = $this->user->getID();
                $this->panelHead_1 = '<h3>Client Run Plan</h3>' . $selected_user . " (" . $selected_client . ")";
                break;
            case "updateRunPlan":
                $selected_user = $this->user->getUserFirstName() . " " . $this->user->getUserlastName();
                $selected_client = $this->user->getID();
                $this->panelHead_1 = '<h3>Select Week-Day for verification</h3>' . $selected_user . " (" . $selected_client . ")";
                break;
            default:
                $this->panelContent_1 = "Panel 1 content for <b>$this->pageHeading</b> menu item is under construction.";
                break;
        } //end switch 
    }

    /**
     * Set the Panel 1 text content 
     */
    public function setPanelContent_1()
    {
        //$this->panelContent_1="Panel 1 content for <b>$this->pageHeading</b> menu item is under construction.";


        switch ($this->pageID) {
            case "viewRunPlan":

                $runPlanTable = new RunPlanTable($this->db);
                $selected_user = $this->user->getUserFirstName() . " " . $this->user->getUserlastName();
                $selected_client = $this->user->getID();
                if ($rs = $runPlanTable->viewPlanClient($selected_client, $selected_user)) {
                    $this->panelContent_1 = HelperHTML::generateTABLE($rs, $this->pageID, 'Edit');
                } else { //session does not exist in DB
                    $this->panelContent_1 = 'Unable to Select session - check the session code is valid';
                }
                break;
            case "updateRunPlan":
                //$this->panelContent_1 = "Panel 1 content for <b>$this->pageHeading</b> menu item is under construction.";
                $selected_user = $this->user->getUserFirstName() . " " . $this->user->getUserlastName();
                $selected_client = $this->user->getID();
                $this->panelContent_1 = Form::form_update_runplan_client($this->pageID, $selected_client);

                break;
            default:

                break;
        } //end switch 
    }

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2()
    {
        switch ($this->pageID) {

            case "updateRunPlan":

                $this->panelHead_2 = '<h3>Mark Session as Complete</h3>';

                break;
            default:
                $this->panelContent_2 = "Panel 1 content for <b>$this->pageHeading</b> menu item is under construction.";
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

            case "updateRunPlan":




            default:
                $this->panelContent_1 = "Panel 1 content for <b>$this->pageHeading</b> menu item is under construction.";
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