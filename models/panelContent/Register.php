<?php
/**
* This file contains the Registration Class
* 
*/


/**
 * UnderConstruction is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and content
 * for an 'registration' page.  
 *
 * @author gerry.guinane
 * 
 */


class Register extends PanelModel {
  
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
        $this->modelType='Register';
        parent::__construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID);
    } 

    
    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1(){
        $this->panelHead_1='<h3>Registration Form</h3>';       
    }
    
    /**
    * Set the Panel 1 text content 
    */ 
    public function setPanelContent_1(){
         
       
        //$this->panelContent_1 = Form::form_register('register');  //this reads an external form file into the string
       $this->panelContent_1=Form::form_register($this->pageID);
        
    }        

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2(){ 
        $this->panelHead_2='<h3>Instructions</h3>'; 
   
    }  
    
    /**
    * Set the Panel 2 text content 
    */ 
    public function setPanelContent_2(){
            //process the login details from the login form if the button has been pressed
        //if(isset($this->postArray['btnRegister'])){  //check that the login button is pressed
        
        if(isset($this->postArray['btnRegister'])){

                            $userTable=new userTable($this->db);

                            //if ($userTable->addRecord($this->postArray, $this->user->getUserCollegeID())){
                            if ($userTable->addRecord($this->postArray, TRUE)){
                                $this->panelContent_2='New user added';
                            }
                            else {
                                $this->panelContent_2='Unable to add new user - they may already exist';
                            }
                       }
                    else{
                        $this->panelContent_2="Enter values in the form";
                    }

         
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
        