<?php
/**
 * This file contains the Form Class
 * 
 */

/**
 * 
 * Form class - is a helper class that generates HTML forms  
 * 
 *  
 *
 * 
 */

class Form
{

        /**
         * Generates a HTML login form 
         * 
         * @param string $pageID The pageID of the page which will be used to process the login form. 
         * @return string String containing the generated form.
         */
        public static function form_login($pageID)
        {
                $form = '<form method="post" action="index.php?pageID=' . $pageID . '">';
                $form .= '<div class="form-group">';
                $form .= '<label for="userID">ID (email)</label><input required type="text" class="form-control" id="userID" name="userID" >';
                $form .= '<label for="password">Password</label><input required type="password" class="form-control" id="password" name="password" >';
                $form .= '</div> ';
                $form .= '<button type="submit" class="btn btn-default" value="TRUE" name="btnLogin">Login</button>';
                $form .= '</form>';
                return $form;
        }

        /**
         * Generates a HTML password change form
         * 
         * @param string $pageID The pageID of the page which will be used to process the login form.
         * @return string String containing the generated form.
         */
        public static function form_password_change($pageID)
        {
                $form = '<form method="post" action="index.php?pageID=' . $pageID . '">';
                $form .= '<div class="form-group">';
                $form .= '<label for="pass1">Enter New Password</label><input required type="password" class="form-control" id="pass1" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">';
                $form .= '<label for="pass2">Re-enter New Password</label><input required type="password" class="form-control" id="pass2" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must match the above password exactly">';
                $form .= '<label for="password">Enter OLD Password</label><input required type="password" class="form-control" id="password" name="password" >';
                $form .= '</div> ';
                $form .= '<button type="submit" class="btn btn-default" value="TRUE" name="btnChangePW">Change Password</button>';
                $form .= '<button type="submit" class="btn btn-default" name="btnCancelUpdatePW" value="updatePWCancel">Cancel</button>';
                $form .= '</form>';
                return $form;
        }

        /**
        * 
        * Generates a HTML form for editing account details. 
        * 
        * The form generated will display but does not permit editing of the users ID.  
        * 
        
        * @param mysqli_result $userRecord Resultset containing the current user details from the database  user table 
        * @param string $pageID The pageID of the page which will be used to process the login form.
        * @return string String containing the generated form.
        */
        public static function form_edit_account($userRecord, $pageID)
        {



                $userRecordArray = $userRecord->fetch_assoc();
                extract($userRecordArray);

                $form = '<form method="post" action="index.php?pageID=' . $pageID . '">';
                $form .= '<div class="form-group">';
                //$form .= '<label for="ID">ID</label><input required readonly type="text" class="form-control"   value="' . $ID . '" id="ID" name="ID" pattern="[a-zA-Z0-9]{5,10}" title="ID (5 to 10 Characters) - Enter Characters A-Z,a-z and/or numbers 0-9">';
                $form .= '<label for="firstName">First Name</label><input required type="text" class="form-control"  value="' . $FirstName . '" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="First Name (up to 45 Characters)">';
                $form .= '<label for="lastName">Last Name</label><input required type="text" class="form-control"   value="' . $LastName . '" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="Last Name (up to 45 Characters)" >';


                $form .= '<label for="email">email (not editable)</label><input required readonly type="text" class="form-control" value="' . $email . '" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >';
                $form .= '<label for="mobile">mobile</label><input type="text" class="form-control" value="' . $mobile . '" id="mobile" name="mobile" pattern="[0-9()+-\']{7,20}" title="enter a valid phone number" >';

                $form .= '</div> ';
                $form .= '<button type="submit" class="btn btn-default" name="btnUpdateAccount" value="update">Update</button>';
                $form .= '</form>';

                return $form;
        }


        /**
         * Generates a HTML form for registering a new  account. 
         * 
         * The form generated will display a drop down list/chooser of counties.  
         * 
         * @param string $pageID The pageID of the page which will be used to process the login form.
         * @return string String containing the generated form.
         */
        public static function form_register($pageID)
        {



                $form = '<form method="post" action="index.php?pageID=' . $pageID . '">';
                $form .= '<div class="form-group">';
                $form .= '<label for="firstName">First Name</label><input required type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="First Name (up to 45 Characters)">';
                $form .= '<label for="lastName">Last Name</label><input required type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí\']{1,45}" title="Last Name (up to 45 Characters)" >';
                $form .= '<label for="ID">Username (max 10 characters)</label><input required type="text" class="form-control" id="ID" name="ID" pattern="[a-zA-Z0-9]{5,10}" title="ID (5 to 10 Characters) - Enter Characters A-Z,a-z and/or numbers 0-9">';

                $form .= '<label for="email">Email (this will be your user ID) </label><input type="text" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >';
                $form .= '<label for="mobile">Mobile</label><input type="text" class="form-control" id="mobile" name="mobile" pattern="[0-9()+-\']{7,20}" title="enter a valid phone number" >';

                $form .= '<label for="userType">User Type</label><select class="form-control" id="userType" name="userType"><option value="CLIENT">Client</option><option value="ADMIN">Administrator</option></select>';


                $form .= '<label for="pass1">Password</label><input required type="password" class="form-control" id="pass1" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">';
                $form .= '<label for="pass2">Re-enterPassword</label><input required type="password" class="form-control" id="pass2" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must match the above password exactly">';
                $form .= '</div> ';
                $form .= '<button type="submit" class="btn btn-default" name="btnRegister" value="register">Register</button>';
                $form .= '</form>';

                return $form;
        }



        /**
         * Generates a HTML form for entering a chat message and optionally specifying a recipient. 
         * 
         * 
         * @param string $pageID The pageID of the page which will be used to process the login form.
         * @return string String containing the generated form.
         */
        public static function form_add_msg($pageID)
        {
                $form = '<div class="container-fluid">';
                $form .= '<form method="post" action="index.php?pageID=' . $pageID . '">';

                $form .= '<div class="form-group">';

                $form .= '<label for="message">Enter a Message</label><textarea class="form-control" id="message" name="message" rows="3" style="resize:vertical"></textarea> ';

                $form .= '<label for="msgTo">Addressed To (enter ID or leave blank for ALL)</label><input type="text" class="form-control" id="msgTo" name="msgTo" >';
                $form .= '</div> ';
                $form .= '<button type="submit" class="btn btn-default" value="TRUE" name="btnAddMsg">Submit Message</button>';
                $form .= '</form>';
                $form .= '</div>';
                return $form;
        }


        /**
         * Generates a HTML form for adding a new module. 
         * 
         * 
         * @param string $pageID The pageID of the page which will be used to process the login form.
         * @return string String containing the generated form.
         */
        public static function form_add_runsession($pageID)
        {
                $form = '<div class="container-fluid">';
                $form .= '<form method="post" action="index.php?pageID=' . $pageID . '">';
                $form .= '<div class="form-group">';

                $form .= '<label for="idRunSession">Run Session ID (Integer Value)</label><input required type="text" class="form-control" id="idRunSession" name="idRunSession"  title="idRunSession (Integer)" >';
                $form .= '<label for="sessionName">Session Name</label><input required type="text" class="form-control" id="sessionName"  name="sessionName" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="sessionName (up to 45 Characters)">';
                $form .= '<label for="totalDuration">Total Session Duration in seconds</label><input required type="text" class="form-control" id="totalDuration" name="totalDuration"  title="Total Duration (Integer)" >';
                $form .= '<label for="setQty">Set Quantity (Integer Value)</label><input required type="text" class="form-control" id="setQty" name="setQty"  title="Set Quantity (Integer)" >';
                $form .= '<label for="repQty">Rep Quantity (Integer Value)</label><input required type="text" class="form-control" id="repQty" name="repQty"  title="Rep Quantity (Integer)" >';
                $form .= '<label for="repTime">Rep Time in seconds</label><input required type="text" class="form-control" id="repTime" name="repTime"  title="Rep Time (Integer)" >';
                $form .= '<label for="recoveryTimeReps">Recovery Time in seconds (btw Reps)</label><input required type="text" class="form-control" id="recoveryTimeReps" name="recoveryTimeReps"  title="Recovery Time Reps (Integer)" >';
                $form .= '<label for="recoveryTimeSets">Recovery Time in seconds (btw Sets)</label><input required type="text" class="form-control" id="recoveryTimeSets" name="recoveryTimeSets"  title="Recovery Time Sets (Integer)" >';
                $form .= '<label for="hrLower">Heart Rate Minimum (Zone Value)</label><input required type="text" class="form-control" id="hrLower" name="hrLower"  title="Heart Rate Minimum (Double)" >';
                $form .= '<label for="hrUpper">Heart Rate Maximum (Zone Value)</label><input required type="text" class="form-control" id="hrUpper" name="hrUpper"  title="Heart Rate Maximum (Double)" >';
                $form .= '<label for="hrRecovery">Heart Rate Recovery (Zone Value)</label><input required type="text" class="form-control" id="hrRecovery" name="hrRecovery"  title="Heart Rate Recovery (Double)" >';
                $form .= '</div>';

                //$form.='<button type="submit" class="btn btn-default" name="btnAddRunSession" value=\'moduleAdd\'>Add Module</button>';
                $form .= '<button type="submit" class="btn btn-default" value="TRUE" name="btnAddRunSession">Submit Run Session</button>';
                $form .= '</form>';
                $form .= '</div>';
                return $form;
        }

        /**
         * Generates a HTML form for select a run session. 
         * 
         * 
         * @param string $pageID The pageID of the page 
         * @return string String containing the generated form.
         */
        public static function form_select_runsession($pageID)
        {
                $form = '<div class="container-fluid">';
                $form .= '<form method="post" action="index.php?pageID=' . $pageID . '">';

                $form .= '<div class="form-group">';
                $form .= '<label for="sessionName">Session Name</label><input required type="text" class="form-control" id="sessionName" name="sessionName" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="sessionName (up to 45 Characters)">';
                $form .= '</div>';

                $form .= '<button type="submit" class="btn btn-default" name="btnSelectRunSession" value=\'sessionSelect\'>Select Run Session</button>';
                $form .= '</form>';
                $form .= '</div>';
                return $form;
        }

        /**
         * Generates a HTML form for editing/updating a module. Module ID and Lecturer ID cannot be edited. 
         * 
         * @param ResultSet $runSessionRecord ResultSet containing the module record to be updated
         * @param string $pageID The pageID of the page .
         * @return string String containing the generated form.
         */
        public static function form_edit_runsession($runSessionRecord, $pageID)
        {


                $runSessionRecordArray = $runSessionRecord->fetch_assoc();
                extract($runSessionRecordArray);

                $form = '<div class="container-fluid">';
                $form .= '<form method="post" action="index.php?pageID=' . $pageID . '">';

                $form .= '<div class="form-group">';

                $form .= '<label for="idRunSession">Run Session ID (Not editible)</label><input required readonly type="text" class="form-control" id="idRunSession" value="' . $idRunSession . '" name="idRunSession"  title="idRunSession (Integer)" >';
                $form .= '<label for="sessionName">Session Name (Not editible)</label><input required readonly type="text" class="form-control" id="sessionName" value="' . $sessionName . '" name="sessionName" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="sessionName (up to 45 Characters)">';
                $form .= '<label for="totalDuration">Total Session Duration in seconds</label><input required type="text" class="form-control" id="totalDuration" value="' . $totalDuration . '" name="totalDuration"  title="Total Duration (Integer)" >';
                $form .= '<label for="setQty">Set Quantity (Integer Value)</label><input required type="text" class="form-control" id="setQty" value="' . $setQty . '" name="setQty"  title="Set Quantity (Integer)" >';
                $form .= '<label for="repQty">Rep Quantity (Integer Value)</label><input required type="text" class="form-control" id="repQty" value="' . $repQty . '" name="repQty"  title="Rep Quantity (Integer)" >';
                $form .= '<label for="repTime">Rep Time in seconds</label><input required type="text" class="form-control" id="repTime" value="' . $repTime . '" name="repTime"  title="Rep Time (Integer)" >';
                $form .= '<label for="recoveryTimeReps">Recovery Time in seconds (btw Reps)</label><input required type="text" class="form-control" id="recoveryTimeReps" value="' . $recoveryTimeReps . '"  name="recoveryTimeReps"  title="Recovery Time Reps (Integer)" >';
                $form .= '<label for="recoveryTimeSets">Recovery Time in seconds (btw Sets)</label><input required type="text" class="form-control" id="recoveryTimeSets" value="' . $recoveryTimeSets . '" name="recoveryTimeSets"  title="Recovery Time Sets (Integer)" >';
                $form .= '<label for="hrLower">Heart Rate Minimum (Zone Value)</label><input required type="text" class="form-control" id="hrLower" value="' . $hrLower . '" name="hrLower"  title="Heart Rate Minimum (Double)" >';
                $form .= '<label for="hrUpper">Heart Rate Maximum (Zone Value)</label><input required type="text" class="form-control" id="hrUpper" value="' . $hrUpper . '" name="hrUpper"  title="Heart Rate Maximum (Double)" >';
                $form .= '<label for="hrRecovery">Heart Rate Recovery (Zone Value)</label><input required type="text" class="form-control" id="hrRecovery" value="' . $hrRecovery . '" name="hrRecovery"  title="Heart Rate Recovery (Double)" >';
                $form .= '</div>';


                $form .= '<button type="submit" class="btn btn-default" name="btnUpdateRunSession" value=\'runSessionAdd\'>Update Session</button>';
                $form .= '</form>';
                $form .= '</div>';
                return $form;

        }

        public static function form_add_runplan($pageID)
        {
                $form = '<div class="container-fluid">';
                $form .= '<form method="post" action="index.php?pageID=' . $pageID . '">';
                $form .= '<div class="form-group">';

                //$form .= '<label for="idRunPlan">Run Plan ID (Integer Value)</label><input required type="text" class="form-control" id="idRunPlan" name="idRunPlan"  title="idRunPlan (Integer)" >';
                $form .= '<label for="typeRun">Run Week-Day</label><input required type="text" class="form-control" id="typeRun" name="typeRun" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="typeRun (up to 45 Characters)">';

                $form .= '<label for="runSessionId">Session Type (Choose)</label><input required type="text" class="form-control" id="runSessionId" name="runSessionId"  title="runSessionId (Integer)" >';
                $form .= '<label for="ID">Client Username (max 10 characters)</label><input required type="text" class="form-control" id="ID" name="ID" pattern="[a-zA-Z0-9]{5,10}" title="ID (5 to 10 Characters) - Enter Characters A-Z,a-z and/or numbers 0-9">';
                //$form .= '<input type="checkbox" id="sessionCompleted" name="sessionCompleted" value="1">';

                //$form .= '<label for="sessionCompleted">Session Completed - Boolean Value 1 or 0</label><input required type="text" class="form-control" id="sessionCompleted" name="sessionCompleted"  title="1" >';
                //$form .= '<label for="sessionScore">Session Score (Integer Value)</label><input required type="text" class="form-control" id="sessionScore" name="sessionScore"  title="sessionScore (Integer)" >';



                $form .= '</div>';

                //$form.='<button type="submit" class="btn btn-default" name="btnAddRunSession" value=\'moduleAdd\'>Add Module</button>';
                $form .= '<button type="submit" class="btn btn-default" value="TRUE" name="btnAddRunPlan">Submit Run Plan</button>';
                $form .= '</form>';
                $form .= '</div>';
                return $form;
        }

        public static function form_select_runplan($pageID)
        {
                $form = '<div class="container-fluid">';
                $form .= '<form method="post" action="index.php?pageID=' . $pageID . '">';

                $form .= '<div class="form-group">';
                //$form .= '<label for="sessionName">Session Name</label><input required type="text" class="form-control" id="sessionName" name="sessionName" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="sessionName (up to 45 Characters)">';
                $form .= '<label for="ID">Client Username (max 10 characters)</label><input required type="text" class="form-control" id="ID" name="ID" pattern="[a-zA-Z0-9]{5,10}" title="ID (5 to 10 Characters) - Enter Characters A-Z,a-z and/or numbers 0-9">';
                $form .= '</div>';

                $form .= '<button type="submit" class="btn btn-default" name="btnSelectRunPlan" value=\'sessionSelect\'>Select Run Plan</button>';
                $form .= '</form>';
                $form .= '</div>';
                return $form;
        }

        public static function form_select_runplan_edit($pageID)
        {
                $form = '<div class="container-fluid">';
                $form .= '<form method="post" action="index.php?pageID=' . $pageID . '">';

                $form .= '<div class="form-group">';

                $form .= '<label for="ID">Client Username (max 10 characters)</label><input required type="text" class="form-control" id="ID" name="ID" pattern="[a-zA-Z0-9]{5,10}" title="ID (5 to 10 Characters) - Enter Characters A-Z,a-z and/or numbers 0-9">';
                $form .= '<label for="typeRun">Week-Day</label><input required type="text" class="form-control" id="typeRun" name="typeRun" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="typeRun (up to 45 Characters)">';
                $form .= '</div>';

                $form .= '<button type="submit" class="btn btn-default" name="btnSelectRunPlan" value=\'sessionSelect\'>Select Run Plan</button>';
                $form .= '</form>';
                $form .= '</div>';
                return $form;
        }

        public static function form_edit_runplan($runPlanRecord, $pageID)
        {


                $runPlanRecordArray = $runPlanRecord->fetch_assoc();
                extract($runPlanRecordArray);

                $form = '<div class="container-fluid">';
                $form .= '<form method="post" action="index.php?pageID=' . $pageID . '">';

                $form .= '<div class="form-group">';
                $form .= '<label for="ID">Client Username (max 10 characters)</label><input required type="text" class="form-control" id="ID" name="ID"   pattern="[a-zA-Z0-9]{5,10}" title="ID (5 to 10 Characters) - Enter Characters A-Z,a-z and/or numbers 0-9">';
                //$form .= '<label for="ID">Client Username</label><input required type="text" class="form-control" id="ID" value="' . $ID . '" name="ID" pattern="[a-zA-Z0-9]{5,10}" title="ID (5 to 10 Characters) - Enter Characters A-Z,a-z and/or numbers 0-9">';
                $form .= '<label for="idRunPlan">Run Plan ID</label><input required type="text" class="form-control" id="idRunPlan" name="idRunPlan"  value="' . $idRunPlan . '" pattern="[0-9]{1,2}" title="idRunPlan (Integer Value)" >';
                $form .= '<label for="typeRun">Week-Day</label><input required type="text" class="form-control" id="typeRun" value="' . $typeRun . '" name="typeRun" pattern="[a-zA-Z0-9óáéí\' ]{1,45}" title="typeRun (up to 45 Characters)">';
                $form .= '<label for="runSessionId">Run Session ID</label><input required type="text" class="form-control" id="runSessionId" name="runSessionId"  value="' . $runSessionId . '" pattern="[0-9]{1,2}" title="idRunPlan (Integer Value)" >';
                $form .= '</div>';


                $form .= '<button type="submit" class="btn btn-default" name="btnUpdateRunPlan" value=\'runSessionAdd\'>Update Plan</button>';
                $form .= '</form>';
                $form .= '</div>';
                return $form;

        }





}