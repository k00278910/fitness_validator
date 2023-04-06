<?php
/**
* This file contains the CountyTable Class
* 
*/

/**
 * 
 * ChatMsgTable entity class implements the table entity class for the 'CountyTable' table in the database. 
 * 
 * @author Gerry Guinane
 * 
 */


class StudentTable extends TableEntity {


    /**
     * Constructor for the CountyTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'StudentTable');
    }

   

    /**
     * Performs validation of user login credentials
     * 
     * @param string $userID
     * @param string $password
     * @param boolean $encryptPW True if Password is hashed
     * @return boolean Returns TRUE if validation is successful. FALSE for invalid credentials.
     */
    public function validate_login($userID,$password,$encryptPW){  
        
        if($encryptPW){//encrypt the password
        $password = hash('ripemd160', $password);       
        }      
        
        $sql="SELECT FirstName,LastName FROM user WHERE ID='$userID' AND PassWord='$password'";
        $rs=$this->db->query($sql);
       
        if($rs->num_rows===1){
            return true;
        }
        else{
            return false;
        }
        
    }

    

    /**
     * Returns a partial record (FirstName and LastName only by ID)
     * 
     * @param string $userID
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
     */ 
    public function getRecordByID($userID){
        $sql="SELECT ID,FirstName,LastName FROM user WHERE ID='$userID'";
        $rs=$this->db->query($sql);
        if($rs->num_rows===1){
            return $rs;
        }
        else{
            return false;
        }        
        
    }

    

    /**
     * Returns a full record (ID,FirstName,LastName,email,mobile) by ID
     * 
     * @param string $userID
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
     */ 
    public function getFullRecordByID($userID){
        
        $sql="SELECT s.ID,s.FirstName,s.LastName,s.email,s.mobile, c.countyName FROM user s, county c WHERE s.ID='$userID' AND s.idcounty=c.idcounty";
        $rs=$this->db->query($sql);
        if($rs->num_rows===1){
            return $rs;
        }
        else{
            return false;
        }        
        
    }

    
     /**
     * Performs a DELETE query for a single record ($userID).  Verifies the
     * record exists before attempting to delete
     * 
     * @param $userID  String containing ID of user record to be deleted
     * 
     * @return boolean Returns FALSE on failure. For successful DELETE returns TRUE
     */
    public function deleteRecordbyID($userID){
        
        if($this->getRecordByID($userID)){ //confirm the record exists before deletig
            $sql = "DELETE FROM user WHERE ID='$userID'";
            $this->db->query($sql); //delete the record
            return true;
        }
        else{
            return false;
        }       
    }

    
    
    /**
     * Performs a SELECT query to returns all records from the table. 
     * ID,Firstname and Lastname columns only.
     *
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
     */
     public function getAllRecords(){
        $sql = 'SELECT ID,FirstName,LastName FROM user';
        $rs=$this->db->query($sql);
        if($this->db->affected_rows){
            return $rs;
        }
        else{
            return false;
        }        
        
    }   

    
    
    /**
     * Inserts a new record in the table. 
     * 
     * @param array $postArray containing data to be inserted
         * $postArray['ID'] string StudentID
         * $postArray['firstName'] string FirstName
         * $postArray['lastName'] string LastName
         * $postArray['pass1'] string PassWord
         * $postArray['email'] string email
         * $postArray['mobile'] string mobile
     * 
     * @param boolean $encryptPW IF TRUE the password will be hashed in the database record
     * @return boolean
     * 
     * 
     */   
    public function addRecord($postArray,$encryptPW){
        
        //get the values entered in the registration form contained in the $postArray argument      
        extract($postArray);
        
        //add escape to special characters
        $ID= strtoupper(addslashes($ID)); //make sure the student ID is saved in uppercase only 
        $firstName= addslashes($firstName);
        $lastName= addslashes($lastName);
        $email=addslashes($email);
        $mobile=addslashes($mobile);
        $password=addslashes($pass1);
        $idcounty=(integer)$county;  //cast to integer
        
        //check is password encryption is required
        if($encryptPW){//encrypt the password
        $password = hash('ripemd160', $pass1);       
        } 
        
        //construct the INSERT SQL
        //$sql="INSERT INTO user (ID,FirstName,LastName,PassWord,email,mobile,idcounty) VALUES ('$ID','$firstName','$lastName','$password','$email','$mobile',$idcounty)";   
       $sql="INSERT INTO user (ID,FirstName,LastName,PassWord,email,mobile) VALUES ('$ID','$firstName','$lastName','$password','$email','$mobile')";   
        //execute the insert query
        $rs=$this->db->query($sql); 
        //check the insert query worked
        if ($rs){return TRUE;}else{return FALSE;}
    }

    
    
    /**
     * Updates an existing record by ID. Does not change password.  
     * 
     * @param array $postArray containing data to be inserted
         * $postArray['ID'] string StudentID
         * $postArray['firstName'] string FirstName
         * $postArray['lastName'] string LastName
         * $postArray['mobile'] string mobile
     * 
     * @return boolean
     * 
     * 
     */   
    public function updateRecord($postArray){
        
        //get the values entered in the registration form contained in the $postArray argument      
        extract($postArray);
        
        //add escape to special characters
        $firstName= addslashes($firstName);
        $lastName= addslashes($lastName);
        $email=addslashes($email);
        $mobile=addslashes($mobile);
                
        //construct the INSERT SQL                    
        $sql="UPDATE user SET FirstName='$firstName',LastName='$lastName',email='$email',mobile='$mobile' WHERE ID='$ID'";   
        //execute the insert query
        $rs=$this->db->query($sql); 
        //check the insert query worked
        if ($this->db->affected_rows===1){return TRUE;}else{return FALSE;}
    }

   
    
}

