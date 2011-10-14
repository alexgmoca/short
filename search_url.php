<?php
include_once ("base.php");
include_once ("utils.php");
$hint = $_POST['h'];
//sanitize
$hint = sql_clean($hint);
if(preg_match("/[^".SEED."]+/",$hint)) {
	echo '<font color="red"> &#10008; Invalid characters in custom URL</font>';
}else {
		$sql = sprintf("SELECT instance_id FROM instance WHERE strkey = '%s'",$hint);
		$res = mysql_query($sql);
		if(mysql_result($res,0)!=0) {
			echo '<font color="red"> &#10008; Custom URL already used</font>';
		}
		else {
			echo '<font color="green"> &#10004; Custom URL available</font>';
		}
}
?>