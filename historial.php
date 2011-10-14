<?php
session_start();
include_once('base.php');
include_once('utils.php');
if(!isset($_SESSION["user_name"])){
	echo "<script>location.href='login.php'</script>";
}

if($_GET["p"]=="logout") {
	session_destroy();
	header("location:login.php");
}
echo "<div align='right'><a href='index.php' >Short!</a>&nbsp&nbsp&nbsp&nbsp<a href='index.php?p=logout'>Logout!</a></div>";
?>


<script type="text/javascript">
function display_notes(id){
	if(document.getElementById(id).className == 'off') {
		document.getElementById(id).className = 'on';
		document.getElementById('l'+id).innerHTML = ' <<';
	} else {
		document.getElementById(id).className = 'off';
		document.getElementById('l'+id).innerHTML = 'notes>>';
	}
}
</script>
<style type='text/css'>
.off {
display:none;
}
.on {
display:true;
}
</style>

<?php
$urls = get_user_urls($_SESSION['user_id']);
if($urls) {
	foreach(array_keys($urls) as $k) {
				$total_clicks = get_total_clicks($urls[$k]['url_id']);
				$clicks = get_clicks($urls[$k]['instance']);
				echo "<li>http://kmkz.mx/".$urls[$k]['strkey']."</li>";
				echo "<li>url: ".$urls[$k]['url']."</li>";
				echo "<li>all users clicks: ".$total_clicks."</li>";
				if($clicks['left'] == '-') {
					echo "<li>clicks left: -</li>";
				} else if($clicks['left'] =='max_reached') {
					echo "<li>clicks left: no more clicks left</li>";
				} else{
					echo "<li>clicks left: ".$clicks['left']." of ".$urls[$k]['max']."</li>";
				}
				echo "<li>clicks on your instance: ".$clicks['clicks']."</li>";
				if($urls[$k]['exp_date'] == '0000-00-00 00:00:00') {
					echo "<li>expiration date: -</li>";
				} else {
					echo "<li>expiration date: ".$urls[$k]['exp_date']."</li>";
				}
				echo "<li>created: ".$urls[$k]['date']."</li>";
				echo "<li><notes class='off' id=".$k.">notes: ".$urls[$k]['notes']."</notes><a id=l".$k." href='javascript:;' onClick='display_notes(".$k.")'>notes>></a></li>";
				echo "<form action='metricas.php' method=POST><input type=hidden name='id' value=".$urls[$k]['instance'].">";
				echo "<input type=hidden name='url' value=".$urls[$k]['url_id'].">";
				echo "<input type=submit value='metrics'></form>";
				echo "______________________________________________";
			}
}
else
	echo 'error trying to get your URLs';
?>

