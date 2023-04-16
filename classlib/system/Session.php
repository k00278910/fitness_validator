<?php
/**
 * This file contains the Session Class
 * 
 */


/**
 * 
 * The Session Class is responsible for persistance of user data between page requests. 
 * Data persistence - the properties of this class are stored in the superglobal array $_SESSION
 *
 *
 * 
 */


class Session
{


  /**
   *
   * @var String $sessionID Containing the PHPSESSID cookie value  
   */
  private $sessionID;

  /**
   *
   * @var Boolean $loggedin TRUE is logged in 
   */
  private $loggedin;

  /**
   *
   * @var String $userID Containing User ID 
   */
  private $userID;

  /**
   *
   * @var String $ID containing User's app ID (employee or student number)
   */
  protected $ID;

  /**
   *
   * @var String $userFirstName The user's first name
   */
  private $userFirstName;


  /**
   *
   * @var String $userLastName The user's last name 
   */
  private $userLastName;

  /**
   *
   * @var String: $userType Contains the user's type eg MANAGER, ADMIN etc 
   */
  private $userType;

  /**
   *
   * @var Integer $loginAttempts Count of login attempts 
   */
  private $loginAttempts;

  /**
   *
   * @var Integer $views Count of the number of page views in the current session 
   */
  private $views;

  /**
   *
   * @var DateTime $lastViewTimestamp Timestamp of the most recent page view
   */
  private $lastViewTimestamp;

  /**
   *
   * @var DateTime $loginTimestamp Timestamp of the current users login
   */
  private $loginTimestamp;

  /**
   *
   * @var boolean $chatEnabled TRUE if chat function (AJAX) is enabled
   */
  private $chatEnabled;




  /**
   * Constructor
   * 
   * This constructor initialises the $_SESSION variables to initial default values 
   * for first time page visit. 
   * If the page/website has been previously (a valid session key exists) 
   * it retrieves all previously set values from the $_SESSION superglobal array
   * 
   */
  public function __construct()
  {

    //set the timestamps
    $this->lastViewTimestamp = date('d/m/Y h:i:s a', time());
    $_SESSION["lastViewTimestamp"] = $this->lastViewTimestamp;

    //get the sessionid from the cookie array
    if (isset($_COOKIE['PHPSESSID'])) {
      $this->sessionID = $_COOKIE['PHPSESSID'];
      $_SESSION['sessionID'] = $_COOKIE['PHPSESSID'];
    } else {
      $this->sessionID = null;
      $_SESSION['sessionID'] = null;
    }

    //initialise session variables
    if (isset($_SESSION['loggedin'])) {
      $this->loggedin = $_SESSION['loggedin'];
    } else {
      $_SESSION['loggedin'] = FALSE;
      $this->loggedin = FALSE;
      $this->loginTimestamp = null;
      $_SESSION["loginTimestamp"] = $this->loginTimestamp;
    }

    if (isset($_SESSION['views'])) { //keep track of the number of page views
      $_SESSION['views'] = $_SESSION['views'] + 1;
      $this->views = $_SESSION['views'];
    } else {
      $_SESSION['views'] = 1;
      $this->views = $_SESSION['views'];
    }

    if (isset($_SESSION['userID'])) {
      $this->userID = $_SESSION['userID'];
    } else {
      $_SESSION['userID'] = NULL;
      $this->userID = NULL;
    }

    if (isset($_SESSION['userID'])) {
      $this->userID = $_SESSION['userID'];
    } else {
      $_SESSION['userID'] = NULL;
      $this->userID = NULL;
    }

    if (isset($_SESSION['chatEnabled'])) {
      $this->chatEnabled = $_SESSION['chatEnabled'];
    } else {
      $_SESSION['chatEnabled'] = FALSE;
      $this->chatEnabled = FALSE;
    }

    if (isset($_SESSION['loginAttempts'])) {
      $this->loginAttempts = $_SESSION['loginAttempts'];
    } else {
      $_SESSION['loginAttempts'] = 0;
      $this->loginAttempts = 0;
    }


    if (isset($_SESSION['userFirstName'])) {
      $this->userFirstName = $_SESSION['userFirstName'];
    } else {
      $_SESSION['userFirstName'] = NULL;
      $this->userFirstName = NULL;
    }

    if (isset($_SESSION['userLastName'])) {
      $this->userLastName = $_SESSION['userLastName'];
    } else {
      $_SESSION['userLastName'] = NULL;
      $this->userLastName = NULL;
    }

    if (isset($_SESSION['userType'])) {
      $this->userType = $_SESSION['userType'];
    } else {
      $_SESSION['userType'] = NULL;
      $this->userType = NULL;
    }

    if (isset($_SESSION['ID'])) {
      $this->ID = $_SESSION['ID'];
    } else {
      $_SESSION['ID'] = NULL;
      $this->userAppID = NULL;
    }

  }



  /**
   * 
   * Sets the logged in state
   * 
   * @param boolean $loggedin 
   *  
   */
  public function setLoggedinState($loggedin)
  {
    //this function can be used to set the logged in state to true or false 
    //when set to false it does not kill the session variables or the session cookie
    //it is used for both successful and failed login attempts
    //
    if ($loggedin == TRUE) {
      $_SESSION['loggedin'] = TRUE;
      $this->loggedin = TRUE;
      $this->loginTimestamp = date('d/m/Y h:i:s a', time());
      $_SESSION["loginTimestamp"] = $this->loginTimestamp;

    } else {
      $_SESSION['loggedin'] = FALSE;
      $this->loggedin = FALSE;
      $this->setUserFirstName(NULL);
      $this->setUserLastName(NULL);
      $this->setUserID(NULL);
      $this->setUserType(NULL);
      $this->setID(NULL);
    }
  }
  //END METHOD: setLoggedinState($loggedin)


  /**
   * 
   * Implements the logout by resetting the Session class properties and resetting the
   * $_SESSION superglobal array to empty. 
   * 
   * @return boolean TRUE when logout is completed
   * 
   */
  public function logout()
  {
    //this logout function kills all session variables and expires the session cookie on the client machine
    $this->loggedin = FALSE;
    $this->setUserFirstName(NULL);
    $this->setUserLastName(NULL);
    $this->setUserID(NULL);
    $this->setUserType(NULL);
    $this->setID(NULL);
    $_SESSION = array(); //destroy all of the session variables
    if (ini_get("session.use_cookies")) { //kill the cookie containing the session ID on the client machine
      $params = session_get_cookie_params();
      setcookie(
        session_name(),
        '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
      );
    }
    return true;
  }


  /**
   * Sets the user ID property and saves in the $_SESSION superglobal array
   * 
   * @param string $userID The current user's ID
   */
  public function setUserID($userID)
  {
    $this->userID = $userID;
    $_SESSION['userID'] = $userID;
  }

  /**
   * Sets the $userID property and saves in the $_SESSION superglobal array
   * 
   * @param string $userID The current user's College ID
   */
  //public function setUserCollegeID($userCollegeID){$this->userCollegeID=$userCollegeID;$_SESSION['userCollegeID']=$userCollegeID;}    


  /**
   * 
   * Sets the user first name property and saves in the $_SESSION superglobal array
   * 
   * @param string $firstName The current user's first name
   */
  public function setUserFirstName($firstName)
  {
    $this->userFirstName = $firstName;
    $_SESSION['userFirstName'] = $firstName;
  }


  /**
   * 
   * Sets the user last name property and saves in the $_SESSION superglobal array
   * 
   * @param string $lastName The current user's first name
   */
  public function setUserLastName($lastName)
  {
    $this->userLastName = $lastName;
    $_SESSION['userLastName'] = $lastName;
  }


  /**
   * 
   * Sets the user type property and saves in the $_SESSION superglobal array
   * 
   * @param string $userType The current user's user type
   */
  public function setUserType($userType)
  {
    $this->userType = $userType;
    $_SESSION['userType'] = $userType;
  }

  /**
   * 
   * Sets the user type property and saves in the $_SESSION superglobal array
   * 
   * @param string $ID The current userID
   */
  public function setID($ID)
  {
    $this->ID = $ID;
    $_SESSION['ID'] = $ID;
  }


  /**
   * 
   * Sets the chat enabled state  property and saves in the $_SESSION superglobal array
   * 
   * @param boolean $state The chat enabled state
   */
  public function setChatEnabledState($state)
  {
    $this->chatEnabled = $state;
    $_SESSION['chatEnabled'] = $state;
  }


  /**
   * 
   * Sets the number of login attempts property and saves in the $_SESSION superglobal array
   * 
   * @param integer $num The number of log in attempts. 
   */
  public function setLoginAttempts($num)
  {
    $this->loginAttempts = $num;
    $_SESSION['loginAttempts'] = $num;
  }


  /**
   * Returns the PHP Session ID for the current session
   * 
   * @return string
   */
  public function getSessionID()
  {
    return $this->sessionID;
  }

  /**
   * Returns the current user's  logged in state.
   *  
   * @return boolean
   */
  public function getLoggedinState()
  {
    return $this->loggedin;
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
   * Returns the current user's  ID
   *  
   * @return string
   */
  public function getUserID()
  {
    return $this->userID;
  }

  /**
   * Returns the current user's  App ID
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
   * Returns the current sessions number of login attempts
   *  
   * @return integer
   */
  public function getLoginAttempts()
  {
    return $this->loginAttempts;
  }

  /**
   * Returns the timestamp of the most recent page view in the current session
   * 
   * @return DateTime
   */
  public function getLastPageViewTimestamp()
  {
    return $this->lastViewTimestamp;
  }

  /**
   * Returns the timestamp of the login of current session
   * 
   * @return DateTime
   */
  public function getLoginTimestamp()
  {
    return $this->loginTimestamp;
  }

  /**
   * Dumps diagnostic information in HTML format relating to the class properties
   */
  public function getDiagnosticInfo()
  {
    echo '<!-- SESSION CLASS PROPERTY SECTION  -->';
    echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV                    
    echo '<h3>SESSION (CLASS) properties</h3>';
    echo '<table border=1 border-style: dashed; style="background-color: #EEEEEE" >';
    echo '<tr><th>PROPERTY</th><th>VALUE</th></tr>';
    echo "<tr><td>sessionID  </td>   <td>$this->sessionID    </td></tr>";
    echo "<tr><td>loggedin  </td>   <td>$this->loggedin    </td></tr>";
    echo "<tr><td>chatEnabled  </td>   <td>$this->chatEnabled    </td></tr>";
    echo "<tr><td>userID  </td>   <td>$this->userID    </td></tr>";
    echo "<tr><td>userAppID  </td>   <td>$this->ID</td></tr>";
    echo "<tr><td>userFirstName  </td>   <td>$this->userFirstName    </td></tr>";
    echo "<tr><td>userType  </td>   <td>$this->userType    </td></tr>";
    echo "<tr><td>loginAttempts  </td>   <td>$this->loginAttempts    </td></tr>";
    echo "<tr><td>lastViewTimestamp  </td>   <td>$this->lastViewTimestamp    </td></tr>";
    echo "<tr><td>loginTimestamp  </td>   <td>$this->loginTimestamp    </td></tr>";
    echo '</table>';
    echo '<p><hr>';
    echo '</div>';
    echo '<!-- END SESSION CLASS PROPERTY SECTION  -->';

  } //END METHOD:  getDiagnosticInfo()


}