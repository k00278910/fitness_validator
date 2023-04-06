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

class AdminManageRunSessions extends PanelModel {
  
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
    function __construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID){  
        $this->modelType='AdminManageRunSessions';
        parent::__construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID);
    } 

    
    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1(){
        $this->panelHead_1='<h3>Panel 1</h3>';      
    }
    
    /**
    * Set the Panel 1 text content 
    */ 
    public function setPanelContent_1(){
        $this->panelContent_1="Panel 1 content for <b>$this->pageHeading</b> menu item is under construction.";
    }        

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2(){ 
        $this->panelHead_2='<h3>Panel 2</h3>'; 
    }  
    
    /**
    * Set the Panel 2 text content 
    */ 
    public function setPanelContent_2(){
        $this->panelContent_2="Panel 2 content for <b>$this->pageHeading</b> menu item is under construction.";
    }

    /**
     * Set the Panel 3 heading 
     */
    public function setPanelHead_3(){ 
        $this->panelHead_3='<h3>Panel 3</h3>'; 
    } 
    
    /**
    * Set the Panel 3 text content 
    */ 
    public function setPanelContent_3(){
        $this->panelContent_3="Panel 3 content for <b>$this->pageHeading</b> menu item is under construction.";
    }        

        
        
}
        