<?php
include_once('base.php');
include_once('utils.php');
session_start();

if(isset($_POST['email'])) {
	if(is_email($_POST['email'])) {
		send_activation($_POST['email'],'password');
		echo 'an email has been send to you with the procedure to validate your account<br><br>';
	}
}
if(isset($_POST['pass'])) {
	if($_POST['hidd'] != '') {
		remind_password($_POST['pass'], $_POST['re_pass'], $_POST['hidd'], $_POST['val_code']);
	} else {
		echo "something went wrongs<br>";
	}
}
if(isset($_GET['val'])) {
	$hid = '';
	$val_code = sql_clean($_GET['val']);
	$sql=sprintf("SELECT user_name FROM user WHERE validation_code='%s'",$val_code);
	$res = mysql_query($sql);
	if(mysql_num_rows($res) != 0) {
		$hid = mysql_result($res,0);
	}
	echo "<form name=change_pass method=post action='password.php'>";
	echo "<div><input type=password name=pass> Enter your new password (it must be 6 to 12 characters and must have only letters and numbers)</input></div>";
	echo "<div><input type=password name=re_pass> Repeat your new password</input></div>";	
	echo "<input type=hidden name='hidd' value='$hid'></input>";
	echo "<input type=hidden name='val_code' value='$val_code'></input>";
	echo "<div><input type=submit value='Send'></div></form>";
}
else {
	echo "<form name=send_pass method=post action='password.php'>";
	echo "<div><input type=text name=email> Enter your email address</input></div>";
	echo "<div><input type=submit value='Send'></div></form>";
}

?>