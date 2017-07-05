<?php
define ( "DATABASE_NAME", "postgres" );
define ( "USER_NAME", "postgres" );
define ( "USER_PASSWORD", "dltjrals0102" );
include 'CaseeGraphSQL.php';

?>
<!DOCTYPE HTML>
<html lang="jp">
<head>
<style>
.Button6 {
padding: 9px 15px;
font-family: "HGP創英角ﾎﾟｯﾌﾟ体";
background: #ff4d6a;
color: #fff;
border: none;
cursor: pointer;
border-radius: 5px;
-webkit-border-radius: 10px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>新規登録画面</title>
</head>

<body>

<form action="../index.php">
			    <td align = "center"><input type="submit" class="Button6" value="戻る" style=width:200px;height:50px"></td>
</form>
<?php

		// DB Connect
		$database = pg_connect ( "dbname=" . DATABASE_NAME . " user=" . USER_NAME . " password=" . USER_PASSWORD );
		if (! $database) {
			echo ("データベースへ登録することができませんでした。(" . DATABASE_NAME . ")");
		} else {
			$rs = pg_query ( $database, QUERY_STRING );
			if (!$rs) {
				echo ("SQL文を実行できません(" . QUERY_STRING . ")");
			} else {
				// echo ("SQL文を実行できました(" . QUERY_STRING . ")");
		// -------------------------------------------------------------------------
?>
<div>
<?php
				/**
				 * Include class
				 */
				include ('GoogChart.class.php');
?>
				<left>
				<table border="0" width="1200" height="800" align="center">
				<tr>
				<td width="800" align="center">
				<?php include 'CaseeGraph.php';?>
				<td width="800" align="center">
				<?php include 'StatusGraph.php';?>
				</td>
				</tr>

				<tr>
					<td width="500" colspan="2" height="500" align="center">
					<?php include 'TantoGraph.php';?>
				</tr>
				</td>
				</table>
				</left>
<?php
	}
}
?>
    </p>
</body>
</html>
