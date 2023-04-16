<?php
/**
 * This file contains the ModulesTable Class
 * 
 */

/**
 * 
 * ModulesTable entity class implements the table entity class for the 'ModulesTable' table in the database. 
 * 
 * 
 * 
 */

class RunSessionTable extends TableEntity
{

    /**
     * Constructor for the CountyTable Class
     * 
     * @param MySQLi $databaseConnection  The database connection object. 
     */
    function __construct($databaseConnection)
    {
        parent::__construct($databaseConnection, 'runsession'); //the name of the table is passed to the parent constructor
    }
    //END METHOD: Construct






    /**
     * Inserts a new record in the table. 
     * 
     * @param array $postArray containing data to be inserted
     * @param string $ID containing the user ID
     * 
     * @return boolean
     * 
     * 
     */
    public function addRecord($postArray)
    {

        //get the values entered in the registration form contained in the $postArray argument      
        extract($postArray);



        $idRunSession = (integer) $idRunSession;
        $sessionName = addslashes($sessionName);
        $totalDuration = (integer) $totalDuration;
        $setQty = (integer) $setQty;
        $repQty = (integer) $repQty;
        $repTime = (integer) $repTime;
        $recoveryTimeReps = (integer) $recoveryTimeReps;
        $recoveryTimeSets = (integer) $recoveryTimeSets;
        $hrLower = (double) $hrLower;
        $hrUpper = (double) $hrUpper;
        $hrRecovery = (double) $hrRecovery;

        //construct the INSERT SQL 
        $sql = "INSERT INTO runsession (idRunSession,sessionName,totalDuration,setQty,repQty,repTime,recoveryTimeReps,recoveryTimeSets,hrLower,hrUpper,hrRecovery) VALUES ('$idRunSession','$sessionName','$totalDuration','$setQty','$repQty','$repTime','$recoveryTimeReps','$recoveryTimeSets','$hrLower','$hrUpper','$hrRecovery')";
        //$sql = "INSERT INTO runsession (sessionName,totalDuration,setQty,repQty,repTime,recoveryTimeReps,recoveryTimeSets,hrLower,hrUpper,hrRecovery) VALUES ('$sessionName','$totalDuration','$setQty','$repQty','$repTime','$recoveryTimeReps','$recoveryTimeSets','$hrLower','$hrUpper','$hrRecovery')";

        //execute the insert query
        $rs = $this->db->query($sql);
        //check the insert query worked
        if ($rs) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getRecordByID($sessionName)
    {
        $sessionName = strtoupper(addslashes($sessionName));
        $sql = "SELECT * FROM runsession WHERE sessionName='$sessionName'";

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
    public function viewAll()
    {
        //$sessionName = strtoupper(addslashes($sessionName));
        $sql = "SELECT * FROM runsession";

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

        //get the values entered in the registration form contained in the $postArray argument      
        extract($postArray);



        $idRunSession = (integer) $idRunSession;
        $sessionName = addslashes($sessionName);
        $totalDuration = (integer) $totalDuration;
        $setQty = (integer) $setQty;
        $repQty = (integer) $repQty;
        $repTime = (integer) $repTime;
        $recoveryTimeReps = (integer) $recoveryTimeReps;
        $recoveryTimeSets = (integer) $recoveryTimeSets;
        $hrLower = (double) $hrLower;
        $hrUpper = (double) $hrUpper;
        $hrRecovery = (double) $hrRecovery;

        //construct the INSERT SQL 
        $sql = "UPDATE runsession SET idRunSession = '$idRunSession',totalDuration =$totalDuration,setQty=$setQty,repQty=$repQty,repTime=$repTime,recoveryTimeReps=$recoveryTimeReps,recoveryTimeSets=$recoveryTimeSets,hrLower=$hrLower,hrUpper=$hrUpper,hrRecovery=$hrRecovery  WHERE sessionName = '$sessionName'";

        //execute the insert query
        $rs = $this->db->query($sql);
        //check the insert query worked
        if ($rs) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteRecordbyID($sessionName)
    {
        $sessionName = strtoupper(addslashes($sessionName));
        if ($this->getRecordByID($sessionName)) { //confirm the record exists before deleting
            $sql = "DELETE FROM runsession WHERE sessionName='$sessionName'";

            try {
                $this->db->query($sql); //successfully deleted
                return true;
            } catch (Exception $ex) { //records with FK references to child records cannot be deleted
                return false;
            }
        } else {
            return false; //record does not exist
        }
    }


}