<?php

/**
 * This file contains the NavigationAdmin Class
 * 
 */

/**
 * 
 * NavigationAdmin class is a model class that implements the content generation for the
 * page navigation bar for a logged in ADMIN user.  
 * 
 * @author Gerry Guinane
 * 
 */
class NavigationAdmin implements NavigationInterface {

    /**
     *
     * @var boolean $loggedin User logged in state 
     */
    protected $loggedin;

    /**
     *
     * @var String $modelType Identifues this navigation model type  
     */
    protected $modelType;

    /**
     *
     * @var String $pageID The currently selected page
     */
    protected $pageID;

    /**
     *
     * @var array $menuNav An array of menu items  
     */
    protected $menuNav;

    /**
     *
     * @var User $user  The current user object. 
     */
    protected $user;

    /**
     * Class constructor. 
     * 
     * @param User $user The current user object.
     * @param string $pageID The currently selected page
     */
    function __construct($user, $pageID) {
        $this->loggedin = $user->getLoggedInState();
        $this->modelType = 'NavigationAdmin';
        $this->user = $user;
        $this->pageID = $pageID;
        $this->setmenuNav();
    }

    /**
     * Method to prepare the navigation menu depending on the currently selected page ID. 
     * 
     * This method implements handlers for each page ID.  It prepares a HTML list item string
     * containing the menu items that will appear in the view. This string may be returned using the 
     * getMenuNav() method of this class.
     * 
     * If a user is not properly logged in it force redirects to the website home page. 
     * 
     */
    public function setmenuNav() {//set the menu items depending on the users selected page ID
        //empty string for menu items
        $this->menuNav = '';

        if ($this->loggedin) {
            //handlers for logged in user
            switch ($this->pageID) {
                //home navigation
                case "home":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageClients">Manage Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageRunPlans">Manage Run Plans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageRunSessions">Manage Run Sessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;

                case "manageClients":
                    //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=manageClients">Manage Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addClients">Add Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewClients">View Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editClients">Edit Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteClients">Delete Clients</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "addClients":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageClients">Manage Clients</a></li>';
                    //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addClients">Add Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewClients">View Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editClients">Edit Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteClients">Delete Clients</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "viewClients":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageClients">Manage Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addClients">Add Clients</a></li>';
                    //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewClients">View Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editClients">Edit Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteClients">Delete Clients</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "editClients":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageClients">Manage Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addClients">Add Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewClients">View Clients</a></li>';
                    //$this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editClients">Edit Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteClients">Delete Clients</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "deleteClients":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageClients">Manage Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addClients">Add Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewClients">View Clients</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editClients">Edit Clients</a></li>';
                    //$this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteClients">Delete Clients</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                // -------- Option RunPlan --------------
                case "manageRunPlans":
                    //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=manageRunPlans">Manage RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addRunPlans">Add RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewRunPlans">View RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editRunPlans">Edit RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteRunPlans">Delete RunPlans</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "addRunPlans":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageRunPlans">Manage RunPlans</a></li>';
                    //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addRunPlans">Add RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewRunPlans">View RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editRunPlans">Edit RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteRunPlans">Delete RunPlans</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "viewRunPlans":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageRunPlans">Manage RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addRunPlans">Add RunPlans</a></li>';
                    //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewRunPlans">View RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editRunPlans">Edit RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteRunPlans">Delete RunPlans</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "editRunPlans":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageRunPlans">Manage RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addRunPlans">Add RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewRunPlans">View RunPlans</a></li>';
                    //$this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editRunPlans">Edit RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteRunPlans">Delete RunPlans</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "deleteRunPlans":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageRunPlans">Manage RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addRunPlans">Add RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewRunPlans">View RunPlans</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editRunPlans">Edit RunPlans</a></li>';
                    //$this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteRunPlans">Delete RunPlans</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                //--------------------------------------------------------------------------------------------------
                case "manageRunSessions":
                    //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=manageRunSessions">Manage RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addRunSessions">Add RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewRunSessions">View RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editRunSessions">Edit RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteRunSessions">Delete RunSessions</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "addRunSessions":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageRunSessions">Manage RunSessions</a></li>';
                    //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=addRunSessions">Add RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewRunSessions">View RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editRunSessions">Edit RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteRunSessions">Delete RunSessions</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "viewRunSessions":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageRunSessions">Manage RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addRunSessions">Add RunSessions</a></li>';
                    //$this->menuNav.='<li><a href="'.$_SERVER['PHP_SELF'].'?pageID=viewRunSessions">View RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editRunSessions">Edit RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteRunSessions">Delete RunSessions</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "editRunSessions":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageRunSessions">Manage RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addRunSessions">Add RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewRunSessions">View RunSessions</a></li>';
                    //$this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editRunSessions">Edit RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteRunSessions">Delete RunSessions</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                case "deleteRunSessions":
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=home">Home</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=manageRunSessions">Manage RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=addRunSessions">Add RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=viewRunSessions">View RunSessions</a></li>';
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=editRunSessions">Edit RunSessions</a></li>';
                    //$this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=deleteRunSessions">Delete RunSessions</a></li>';

                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
                //----------------------------------------------------------------------------------------------------

                default:
                    $this->menuNav .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?pageID=logout">Log Out</a></li>';
                    break;
            }//end switch                
        } else {
            //redirect to main index.php page
            header("Location:" . $_SERVER['PHP_SELF']);
        }
    }

    /**
     * Getter to return the HTML menu string. 
     * 
     * @return string Containing  a HTML list item string containing the menu items that will appear in the view.
     */
    public function getMenuNav() {
        return $this->menuNav;
    }

    /**
     * Dumps diagnostic information in HTML format relating to the class properties
     */
    public function getDiagnosticInfo() {

        echo '<!-- NAVIGATION ' . $this->modelType . ' CLASS PROPERTY SECTION  -->';
        echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV

        echo '<h3>NAVIGATION ' . $this->modelType . '(CLASS) properties</h3>';
        echo '<table border=1 border-style: dashed; style="background-color: #EEEEEE" >';
        echo '<tr><th>PROPERTY</th><th>VALUE</th></tr>';
        echo "<tr><td>pageID</td>   <td>$this->pageID</td></tr>";
        echo "<tr><td>menuNav</td>  <td>$this->menuNav      </td></tr>";
        echo '</table>';
        echo '<p><hr>';
        echo '</div>';
        echo '<!-- END NAVIGATION CLASS PROPERTY SECTION  -->';
    }

}
