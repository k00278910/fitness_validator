<?php
/**
* This file contains the ZoneCalculator Class
* 
*/


/**
 * Calculator is an extended PanelModel Class
 * 
 * The purpose of this class is to generate HTML view panel headings and content
 * for ZoneCalculator page view. It is accessible to all user accounts.  
 *
 * 
 * 
 */


class ZoneCalculator extends PanelModel{
    
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
        $this->modelType='ZoneCalculator';
        parent::__construct($user,$db,$postArray,$pageTitle,$pageHead,$pageID);
    } 



    /**
     * Set the Panel 1 heading 
     */
    public function setPanelHead_1(){
        $this->panelHead_1='<h3>Training Zone Calculator</h3>';      
    }  

     /**
     * Set the Panel 1 text content 
     */      
    public function setPanelContent_1(){
        $this->panelContent_1 = file_get_contents('forms/form_calculator.html');  //this reads an external form file into the string   
    }       

    /**
     * Set the Panel 2 heading 
     */
    public function setPanelHead_2(){ 
        $this->panelHead_2='<h3>Training Zones</h3>'; 
    }

    
     /**
     * Set the Panel 2 text content 
     */         
    public function setPanelContent_2(){//set the panel 2 content
      if(isset($this->postArray['btn'])){  //check that the user is logged on and a button is pressed

        $this->panelContent_2='';  //create an empty string 

        if(is_numeric($this->postArray['value1']) and is_numeric($this->postArray['value2'])){
                switch ($this->postArray['btn']) {  //process the selected button
                case "add":
                    $this->panelContent_2.= '<table class="table table-striped"><tbody>';
                    $this->panelContent_2.= '<tr><td>The SUM of '.$this->postArray['value1'];
                    $this->panelContent_2.= ' and '.$this->postArray['value2'];
                    $this->panelContent_2.= ' is = '.($this->postArray['value1']+$this->postArray['value2']).'</td></tr>';
                    $this->panelContent_2.= '</tbody></table>';
                    break;

                case "subtract":
                    $this->panelContent_2.= '<table class="table table-striped"><tbody>';
                    $this->panelContent_2.= '<tr><td>The DIFFERENCE of '.$this->postArray['value1'];
                    $this->panelContent_2.= ' and '.$this->postArray['value2'];
                    $this->panelContent_2.= ' is = '.($this->postArray['value1']-$this->postArray['value2']).'</td></tr>';
                    $this->panelContent_2.= '</tbody></table>';
                    break;

                case "table":
                    $this->panelContent_2.= '<table class="table table-striped"><tbody>';
                    for ($i=1;$i<=$this->postArray['value2'];$i++)
                            {
                            $this->panelContent_2.= '<tr><td>'.$this->postArray['value1'].'</td><td>Times</td><td> '.$i.'</td><td> = '.($this->postArray['value1']*$i).'</td></tr>';
                            }
                    $this->panelContent_2.= '</tbody></table>';
                    break;

                case "clear": //the Clear Result button has been pressed
                    $this->panelContent_2.= "Please enter some values in the form.";
                    break; 

                default : //the form has not been submitted yet
                    $this->panelContent_2.= "Please enter some values in the form.";
                    break;
                } //end SWITCH
            }
            else{

                if($this->postArray['btn']==='clear'){
                    $this->panelContent_2='Form cleared'; 
                }
                else{
                $this->panelContent_2='Non numeric values entered - Values entered must be numeric - please try again'; 
                }
            }
        }  
        else{   //button is not pressed    
            $this->panelContent_2='Result will appear here'; 
        }//end IF 
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
        $this->panelContent_3='Panel 3 content - not in use';
    }       

    
}
        