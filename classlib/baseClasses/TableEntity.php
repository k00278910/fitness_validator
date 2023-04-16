<?php
/**
* This file contains the TableEntity Base Class
* 
*/

/**
 * 
 * Base class for Table Entities
 * 
 * 
 * 
 */

class TableEntity {


    /**
     * 
     * @var MySQLi $db The database connection object
     */    
    protected $db;


    /**
     * 
     * @var String $tableName Name of the table entity in the database
     */ 
    private $tableName;

    /**
     * Constructor Method
     * 
     * This is the constructor for the TableEntity class. The TableEntity class is the parent class for all table entities. 
     * 
     * @param MySQLi $databaseConnection The database connection handle
     * @param String $tableName Name of the table entity in the database
     */
    function __construct ($databaseConnection,$tableName){
        $this->tableName=$tableName;
        $this->db=$databaseConnection;
    }    

    //table entity methods

    /**
     * 
     * Selects all records from the table entity. 
     * 
     * @return mysqli_result if TRUE or boolean FALSE
     * 
     */
    public function select_all(){
        $sql = "SELECT * FROM  $this->tableName";  //valid query
        if(@$rs=$this->db->query($sql)){  //execute query and check resultset has been returned 
            return $rs;  //Static methods can be called directly - without creating an instance of the class first.
            $rs->free();
        }
        else{  //something went wrong with the SQL query execution 
            return false;  
        }
    }


    //getters
    /**
     * 
     * Returns the entity table name
     * 
     * @return string $this->tableName name of this table entity
     * 
     */
    public function get_table_name(){
        return $this->tableName;
    }    



    /**
     * Dumps diagnostic information in HTML format relating to the class properties
     */
     public function getDiagnosticInfo(){      
            echo '<!-- TABLE ENTITY CLASS PROPERTY SECTION  -->';
            echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV

                echo '<h3>TABLE ENTITY CLASS (CLASS): '.$this->tableName.'</h3>';
                echo '<table border=1 border-style: dashed; style="background-color: #EEEEEE" >';
                echo '<tr><th>PROPERTY</th><th>VALUE</th></tr>';                        
                echo "<tr><td>Entity Table Name</td>   <td>$this->tableName</td></tr>";
                echo '</table>';
                echo '<p><hr>';
            echo '</div>';            
            echo '<!-- END TABLE ENTITY CLASS PROPERTY SECTION  -->';

    }   
    //END METHOD: getDiagnosticInfo()

    
}
