<?php
/**
 * This file contains the User Class
 * 
 */

/**
 * The user class represents the end user of the application. 
 * 
 * This class is responsible for providing the following functions:
 * 
 * User registration
 * User Login
 * User Logout
 * Persisting user session data by keeping the$_SESSION array up to date
 *
 * 
 * 
 */


class User
{

    /**
     *
     * @var Session Object   $session The current Session
     */
    protected $session;

    /**
     *
     * @var MySQLi Object $db the database connection 
     */
    protected $db;

    /**
     *
     * @var String $userID containing User ID
     */
    protected $userID;


    /**
     *
     * @var String $ID containing User's app ID (admin or client number)
     */
    protected $ID;


    /**
     *
     * @var String $userFirstName  User first name 
     */
    protected $userFirstName;

    /**
     *
     * @var $String userLastName  User Last Name
     */
    protected $userLastName;

    /**
     *
     * @var String $userType;      User type 
     */
    protected $userType;

    /**
     *
     * @var Array $postArray;     Copy of $_POST array
     */
    protected $postArray;

    /**
     *
     * @var boolean$chatEnabled  TRUE if AJAX chat is enabled for this session
     */
    protected $chatEnabled;

    /**
     *
     * @var boolean $loggedin  TRUE if user is logged in
     */
    protected $loggedin;

    /**
     *
     * @var boolean $encryptPW  TRUE if passwords are hash encrypted in DB
     */
    protected $encryptPW;



    /**
     * Class constructor
     * 
     * @param Session Object $session
     * @param MySQLi Object $database
     * @param boolean $encryptPW  TRUE if passwords are hash encrypted in DB
     * 
     * 
     */
    function __construct($session, $database, $encryptPW)
    {
        $this->loggedin = $session->getLoggedinState();
        $this->db = $database;
        $this->session = $session;

        //get properties from the session object
        $this->userID = $session->getUserID();
        $this->ID = $session->getID();
        $this->userFirstName = $session->getUserFirstName();
        $this->userLastName = $session->getUserLastName();
        $this->userType = $session->getUserType();
        $this->chatEnabled = $session->getChatEnabledState();
        $this->encryptPW = $encryptPW;
        $this->postArray = array();
    }



    /**
     * Login method. Validates the user credentials provided and returns TRUE 
     * if they match credentials stored in the user table in the database. 
     * 
     * @param String $userID
     * @param String $password
     * @param String $userApp
     * @return boolean TRUE if login is successful
     * 
     */
    public function login($userID, $password)
    {
        //This login function checks both the student and lecturer tables for valid login credentials

        $userTable = new UserTable($this->db);
        if ($userTable->validate_login($userID, $password, $this->encryptPW)) { //check if the login details match an ADMIN       
            //query the table for that specific user
            $rs = $userTable->getRecordByID($userID);


            $row = $rs->fetch_assoc(); //get the users record from the query result 

            var_dump($row);


            //then set the session array property values
            $this->session->setUserID($row['email']);
            $this->session->setID($row['ID']);
            $this->session->setUserFirstName($row['FirstName']);
            $this->session->setUserLastName($row['LastName']);
            $this->session->setUserType($row['userType']);
            $this->session->setLoggedinState(TRUE);

            //update the User class properties
            $this->userID = $row['email'];
            $this->ID = $row['ID'];
            $this->userFirstName = $row['FirstName'];
            $this->userLastName = $row['LastName'];
            $this->userType = $row['userType'];
            return TRUE;
        } else {
            $this->session->setLoggedinState(FALSE);
            $this->userID = NULL;
            $this->ID = NULL;
            $this->userFirstName = NULL;
            $this->userLastName = NULL;
            $this->userType = 'GUEST';
            $this->loggedin = FALSE;
            return FALSE;
        }

    }


    /**
     * Unconditionally logs out the current user. 
     *  
     * @return boolean TRUE if logout is completed
     * 
     */
    public function logout()
    {
        //
        if ($this->session->logout()) {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Sets the number of login attempts. 
     * 
     * @param integer $num The number of login attempts.
     */
    public function setLoginAttempts($num)
    {
        $this->session->setLoginAttempts($num);
    }

    /**
     * Sets the chat enabled state
     * 
     * @param boolean $state The desired chat enabled state
     */
    public function setChatEnabledState($state)
    {
        $this->session->setChatEnabledState($state);
    }

    /**
     * Sets the logged in state.
     * 
     * @param boolean $loggedinState The logged in state. 
     */
    public function setLoggedInState($loggedinState)
    {
        $this->loggedin = loggedinState;
    } //end METHOD - getLoggedInState  

    /**
     * Returns the current user's  logged in state.
     *  
     * @return boolean
     */
    public function getLoggedInState()
    {
        return $this->session->getLoggedinState();
    } //end METHOD - getLoggedInState        

    /**
     * Returns the current user's  ID
     *  
     * @return string
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * Returns the current user's  college ID
     *  
     * @return string
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Returns the current user's  first name
     *  
     * @return string
     */
    public function getUserFirstName()
    {
        return $this->userFirstName;
    }

    /**
     * Returns the current user's  last name
     *  
     * @return string
     */
    public function getUserLastName()
    {
        return $this->userLastName;
    }

    /**
     * Returns the current user's  user type
     *  
     * @return string
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Returns the state of the encryptPW property. TRUE if password encryption is set. 
     *  
     * @return boolean
     */
    public function getPWEncrypted()
    {
        return $this->encryptPW;
    }

    /**
     * Returns the current sessions number of login attempts
     *  
     * @return integer
     */
    public function getLoginAttempts()
    {
        return $this->session->getLoginAttempts();
    }

    /**
     * Returns the state of the chatEnabled property. TRUE if chatEnabled is set. 
     *  
     * @return boolean
     */
    public function getChatEnabledState()
    {
        return $this->chatEnabled;
    }

    /**
     * Dumps diagnostic information in HTML format relating to the class properties
     */
    public function getDiagnosticInfo()
    {
        echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV
        echo '<h3>USER (CLASS)  properties</h3>';
        echo '<table border=1 border-style: dashed; style="background-color: #EEEEEE" >';
        echo '<tr><th>PROPERTY</th><th>VALUE</th></tr>';
        echo "<tr><td>userID </td><td>$this->userID       </td></tr>";
        echo "<tr><td>ID  </td><td>$this->ID       </td></tr>";
        echo "<tr><td>userFirstName  </td><td>$this->userFirstName     </td></tr>";
        echo "<tr><td>userLastName  </td><td>$this->userLastName         </td></tr>";
        echo "<tr><td>userType  </td><td>$this->userType         </td></tr>";
        echo "<tr><td>chatEnabled  </td><td>$this->chatEnabled         </td></tr>";
        echo "<tr><td>loggedin  </td><td> $this->loggedin        </td></tr>";
        echo "<tr><td>Password Encryption  </td><td> $this->encryptPW        </td></tr>";
        echo "<tr><td>  </td><td>         </td></tr>";
        echo "<tr><td>  </td><td>         </td></tr>";
        echo "<tr><td>  </td><td>         </td></tr>";

        echo '</table>';
        echo '<p><hr>';
        echo '</div>';
    }

}