<?php
/**
* 
* 
*/

/**
 * 
 * ChatMsgTable entity class implements the table entity class for the 'user' table in the database. 
 * 
 * @author Gerry Guinane
 * 
 */

class UserTable extends TableEntity {

    /**
     * Constructor for the UserTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection){
        parent::__construct($databaseConnection,'user');  //the name of the table is passed to the parent constructor
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
        
        $userID=strtolower($userID);
        
        if($encryptPW){//encrypt the password
        $password = hash('ripemd160', $password);       
        }     
        
        $sql="SELECT * FROM user WHERE email='$userID' AND PassWord='$password'";
        
        $rs=$this->db->query($sql);

        
        if($rs->num_rows===1){
            return true;
        }
        else{
            return false;
        }
        
    }

    
    

    /**
     * Validates and implements password change for specified user.  
     * 
     * @param array $postArray containing data to be inserted
        * $postArray['pass1'] String New Password copy 1 
        * $postArray['pass2'] String New Password copy 2
        * $postArray['email'] String user ID/email address 
        * $postArray['password'] String user old Password
     * @param User $user The current user.
     * 
     * @return boolean TRUE if password is changes, else FALSE
     * 
     * 
     */   
    public function changePassword($postArray,$user){
        
        //get the values entered in the registration form contained in the $postArray argument      
        extract($postArray);
    
        //add escape to special characters      
        $pass1= addslashes($pass1);
        $pass2= addslashes($pass2);
        $password= addslashes($password);
        $ID=$user->getUserID();

        //check old password is valid before changing
        if($this->validate_login($ID, $password, $user->getPWEncrypted())){
                         
            //encrypt the password if required
            if($user->getPWEncrypted()){
                $pass1 = hash('ripemd160', $pass1);       
            }  
            
            //construct the UPDATE SQL 
            $sql="UPDATE user SET PassWord='$pass1' WHERE email='$ID'";   
            //execute the insert query
            $rs=$this->db->query($sql); 
            //check the insert query worked
            if ($this->db->affected_rows===1){return TRUE;}else{return FALSE;}
        }
        else{return FALSE;}  //user did not provide valid old password
    }

    

    /**
     * Returns a resultset record (FirstName and LastName only by ID
     * 
     * @param string $userID
     * @return mixed Returns false on failure. For successful SELECT returns a mysqli_result object $rs
     */ 
    public function getRecordByID($userID){
        $sql="SELECT ID,FirstName,LastName,email,mobile,userType FROM user WHERE email='$userID'";     
        $rs=$this->db->query($sql);
        
        if($rs){
           return $rs; //record found - return the resultset object
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
            $sql = "DELETE FROM user WHERE email='$userID'";
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
     * 
     * Adds a new record to the database table - user.
     * 
     * @param array $postArray Copy of $_POST array containing data to be inserted
     * @param boolean $encryptPW  TRUE if the password will be hashed in the database record
     * @param string $userType The current user type 
     * @return boolean
     */
    public function addRecord($postArray,$encryptPW){
        
        /* use extract() toget the values entered in the registration form contained in the $postArray argument
         * 
         * $postArray['ID'] string ID
         * $postArray['firstName'] string FirstName
         * $postArray['lastName'] string LastName
         * $postArray['pass1'] string PassWord
         * $postArray['email'] string email
         * $postArray['mobile'] string mobile
        
        */
        extract($postArray);
        

        
        //add escape to special characters
        $ID= strtoupper(addslashes($ID));
        $firstName= addslashes($firstName);
        $lastName= addslashes($lastName);
        $email=addslashes($email);
        $email=strtolower($email); //force all emails to lower case
        $mobile=addslashes($mobile);
        $password=addslashes($pass1);
       
        
        //check is password encryption is required
        if($encryptPW){//encrypt the password
        $password = hash('ripemd160', $pass1);       
        } 
        
        //construct the INSERT SQL
        //$sql="INSERT INTO user (ID,FirstName,LastName,PassWord,email,mobile,userType) VALUES ('$ID','$firstName','$lastName','$password','$email','$mobile','$userType')";   
$sql="INSERT INTO user (ID,FirstName,LastName,PassWord,email,mobile) VALUES ('$ID','$firstName','$lastName','$password','$email','$mobile')";

        //execute the insert query
        $rs=$this->db->query($sql); 
        //check the insert query worked
        if ($rs){return TRUE;}else{return FALSE;}
    }
  
    

    /**
     * Updates an existing record by ID. Does not change password or user type.  
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
        $sql="UPDATE user SET FirstName='$firstName',LastName='$lastName',mobile='$mobile' WHERE email='$email'";   
        
        //execute the insert query
        $rs=$this->db->query($sql); 
        //check the insert query worked
        if ($this->db->affected_rows===1){return TRUE;}else{return FALSE;}
    }

   
    
}

