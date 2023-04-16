<?php
/**
 * This file contains the RunPlanTable Class
 * 
 */

/**
 * 
 * RunPlanTable entity class implements the table entity class for the 'runplan' table in the database. 
 *  @param User $user  The current user
 *  @param array $postArray Copy of $_POST array containing data to be inserted
 *  @param string $userType The current user type 
 *  @return boolean
 */

class RunPlanTable extends TableEntity
{

    /**
     * Constructor for Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection)
    {
        parent::__construct($databaseConnection, 'runplan'); //the name of the table is passed to the parent constructor
    }
    //END METHOD: Construct






    /**
     * Inserts a new record in the table. 
     * 
     * @param array $postArray containing data to be inserted
     * @param string $user containing the user ID
     * 
     * @return boolean
     * 
     * 
     */
    public function addRecord($postArray, $user) // ADD RECORD ON RUNPLAN
    {

        //get the values entered in the registration form contained in the $postArray argument      
        extract($postArray);


        $ID = strtoupper(addslashes($ID));


        $user = strtoupper(addslashes($user));
        //$idRunPlan = (integer) $idRunPlan;
        $typeRun = addslashes($typeRun);
        $runSessionId = (integer) $runSessionId;
        //$clientUserId = addslashes($clientUserId);
        //$sessionCompleted = (boolean) $sessionCompleted;
        //$sessionCompleted = (bool) $sessionCompleted;
        //$sessionScore = (integer) $sessionScore;



        //construct the INSERT SQL 
        //$sql = "INSERT INTO runplan (idRunPlan,typeRun,runSessionId,clientUserId) VALUES ('$idRunPlan','$typeRun','$runSessionId','$clientUserId')";
        $sql = "INSERT INTO runplan (typeRun,runSessionId,clientUserId,adminUserId) VALUES ('$typeRun','$runSessionId','$ID','$user')";


        //execute the insert query
        $rs = $this->db->query($sql);
        //check the insert query worked
        if ($rs) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getRecordByID($ID, $typeRun) // GET RECORD ON RUNPLAN for EDIT
    {
        $ID = strtoupper(addslashes($ID));
        $typeRun = strtoupper(addslashes($typeRun));
        //$sql = "SELECT * FROM runplan WHERE clientUserId='$ID'";
        $sql = "SELECT * FROM runplan WHERE clientUserId='$ID' AND typeRun='$typeRun' ";

        try { //try to run the SQL query
            $rs = $this->db->query($sql);
            if ($rs->num_rows) { //check the resultset is not empty
                return $rs;
            } else {
                return false;
            }
        } catch (Exception $ex) { //query has failed for some reason
            return false;
        }

    }

    public function getRecordByIDView($ID) // GET RECORD ON RUNPLAN for VIEW
    {
        $ID = strtoupper(addslashes($ID));

        //$sql = "SELECT * FROM runplan WHERE clientUserId='$ID'";
        $sql = "SELECT * FROM runplan WHERE clientUserId='$ID' ";

        try { //try to run the SQL query
            $rs = $this->db->query($sql);
            if ($rs->num_rows) { //check the resultset is not empty
                return $rs;
            } else {
                return false;
            }
        } catch (Exception $ex) { //query has failed for some reason
            return false;
        }

    }

    public function updateRecord($postArray)
    {

        //get the values entered in the  form contained in the $postArray argument      
        extract($postArray);


        $ID = strtoupper(addslashes($ID));
        $idRunPlan = (integer) $idRunPlan;
        $typeRun = addslashes($typeRun);
        $runSessionId = (integer) $runSessionId;
        //$sessionCompleted = (boolean) $sessionCompleted;
        //$sessionCompleted = (bool) $sessionCompleted;
        //$sessionScore = (integer) $sessionScore;

        //construct the INSERT SQL 
        //$sql = "UPDATE runplan SET idRunPlan = '$idRunPlan',typeRun ='$typeRun',runSessionId='$runSessionId'  WHERE typeRun = '$typeRun' AND clientUserId='$ID'";
        //$sql = "UPDATE runplan SET idRunPlan = '$idRunPlan',typeRun ='$typeRun',runSessionId='$runSessionId'";
        $sql = "UPDATE runplan SET runSessionId='$runSessionId'  WHERE typeRun = '$typeRun' AND clientUserId='$ID'";
        //$sql = "UPDATE runplan SET runSessionId='$runSessionId'  WHERE typeRun = '$typeRun'";
        //execute the insert query
        $rs = $this->db->query($sql);
        //check the insert query worked
        if ($rs) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function viewPlanClient($user, $name)
    {
        $user = strtoupper(addslashes($user));
        $name = strtoupper(addslashes($name));
        //echo $name;
        //echo " (" . $user . ")";
        //$sessionName = strtoupper(addslashes($sessionName));
        $sql = "SELECT * FROM runplan WHERE clientUserId='$user'";

        try { //try to run the SQL query
            $rs = $this->db->query($sql);
            if ($rs->num_rows) { //check the resultset is not empty
                return $rs;
            } else {
                return false;
            }
        } catch (Exception $ex) { //query has failed for some reason
            return false;
        }

    }

    public function deleteRecordbyID($ID, $typeRun)
    {
        $ID = strtoupper(addslashes($ID));
        $typeRun = strtoupper(addslashes($typeRun));
        //if ($this->getRecordByID($typeRun) && $this->getRecordByID($ID)) { //confirm the record exists before deleting
        $sql = "DELETE FROM runplan WHERE typeRun='$typeRun' AND clientUserId='$ID'";

        try {
            $this->db->query($sql); //successfully deleted
            return true;
        } catch (Exception $ex) { //records with FK references to child records cannot be deleted
            return false;
        }
        //} else {
        //    return false; //record does not exist
        //}
    }


}