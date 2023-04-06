<?php
/**
* This file generates the student registration form for for this application
* 
*/

/**

* 
*/

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
<div class="form-group">
<label for="ID">USER ID</label><input required type="text" class="form-control" id="ID" name="ID" pattern="[a-zA-Z0-9]{5,10}" title="ID (5 to 10 Characters) - Enter Characters A-Z,a-z and/or numbers 0-9">
<label for="firstName">First Name</label><input required type="text" class="form-control" id="firstName" name="firstName" pattern="[a-zA-Z0-9óáéí']{1,45}" title="First Name (up to 45 Characters)">
<label for="lastName">Last Name</label><input required type="text" class="form-control" id="lastName" name="lastName" pattern="[a-zA-Z0-9óáéí']{1,45}" title="Last Name (up to 45 Characters)" >
<label for="email">email</label><input type="text" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9@.]{1,45}" title="enter a valid email" >
<label for="mobile">mobile</label><input type="text" class="form-control" id="mobile" name="mobile" pattern="[0-9()+-']{7,20}" title="enter a valid phone number" >



<label for="pass1">Password</label><input required type="password" class="form-control" id="pass1" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
<label for="pass2">Re-enterPassword</label><input required type="password" class="form-control" id="pass2" name="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must match the above password exactly">
</div>
<div class="btn-group">
<button type="submit" class="btn btn-primary btn-med" name="btnRegister" value='registerUSER'>Register</button>
</div>
</form>