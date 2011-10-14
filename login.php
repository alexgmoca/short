<?php
session_start();
include_once("base.php");
include_once("utils.php");

if(isset($_SESSION["user_name"])) {
	header ("Location: index.php");
}

if(isset($_POST["sign_up_user_name"])) {
	$user_data = array (
	"user_name"   => $_POST["sign_up_user_name"],
	"password"    => $_POST["sign_up_password"],
	"re_password" => $_POST["sign_up_re_password"],
	"user_email"  => $_POST["sign_up_user_email"]
	);
	$url = sign_up_user($user_data);	
	header ("Location: ".$url);	
}

if(isset($_POST["user_name"])) {
	header("Location: ".log_in_user($_POST["user_name"],$_POST["password"]));
}

if($_GET["p"]=="signup") {
?>

<form name="sign_up" method = "post" action = "login.php?p=signup">
<div><input type = "text" name = "sign_up_user_name"/>User Name</div>
<div><input type = "password" name = "sign_up_password"/>Password (it must be 6 to 12 characters and must have only letters and numbers)</div>
<div><input type = "password" name = "sign_up_re_password"/>Retype Password</div>
<div><input type = "text" name = "sign_up_user_email"/>Email Address</div>
<div><input type = "submit" name = "sign_up_send" value = "Sign Up"/></div>
</form>

<?php
} 
else {
?>

<form name = "login" method = "post" action = "login.php">
<div><input type = "text" name = "user_name"/>User Name</div>
<div><input type = "password" name = "password"/>Password</div>
<div><input type = "submit" name = "send" value = "Sign In"/></div>
<br>
<br>
<div><a href="login.php?p=signup">Sign Up</a></div>
<br>
<div><a href="password.php">Forgot your password?</a></div>
</form>

<?php
} 
?>