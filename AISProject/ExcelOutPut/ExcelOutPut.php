<?php
define ( "DATABASE_NAME", "postgres" );
define ( "USER_NAME", "postgres" );
define ( "USER_PASSWORD", "dltjrals0102" );
include 'DataOutPut.php';
include 'TodayOutPut.php';

?>
<!DOCTYPE HTML>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<?php

		// DB Connect
		$database = pg_connect ( "dbname=" . DATABASE_NAME . " user=" . USER_NAME . " password=" . USER_PASSWORD );
		if (! $database) {
			echo ("データベースへ登録することができませんでした。(" . DATABASE_NAME . ")");
		} else {
			$rs = pg_query ( $database, QUERY_STRING );
			$rs2 = pg_query($database , QUERY_STRING4);
			if (!$rs) {
				echo ("SQL文を実行できません(" . QUERY_STRING . ")");
			} else {
				 $maxrows = pg_num_rows($rs);
		// -------------------------------------------------------------------------
?>
<?php
header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=1,pre-check=0" );
header( "Pragma: public" );
header( "Content-Disposition: attachment; filename=案件情報一覧.xls" );

error_reporting(0);
$row2 = pg_fetch_row($rs2, $i);
$AA = $row2[0];
echo "
	<div align=right>
	作成日:$AA
	</div>
    <table border=1 width=1000 height=800>
	<center>
    <tr bgcolor=#6699cc>
        <td align=center height=50 width=100>No</td>
        <td align=center height=50 width=100>顧客</td>
		<td align=center height=50 width=100>ステータス</td>
		<td align=center height=50 width=100>案件名</td>
		<td align=center height=50 width=100>案件概要</td>
		<td align=center height=50 width=100>作業場所</td>
		<td align=center height=50 width=100>期間</td>
		<td align=center height=50 width=100>募集人数</td>
		<td align=center height=50 width=100>スキル</td>
		<td align=center height=50 width=100>条件</td>
		<td align=center height=50 width=100>商流</td>
		<td align=center height=50 width=100>その他</td>
		<td align=center height=50 width=100>案件担当</td>
    </tr>
    ";

for ($i = 0; $i < $maxrows; $i++) {
	$row = pg_fetch_row($rs, $i);

	switch($row[2]) {

		case 1:
			$row[2]= "提案前";
			break;
		case 2:
			$row[2]= "提案済";
			break;
		case 3:
			$row[2]= "面談前";
			break;
		case 4:
			$row[2]= "結果待ち";
			break;
		case 5:
			$row[2]= "NG";
			break;
		case 6:
			$row[2]= "OK";
			break;
		case 7:
			$row[2]= "2次面談待ち";
			break;
		case 8:
			$row[2]= "クローズ";
			break;
	}
	echo
	"<tr>

	<center>
	<td align=center height=50 width=100>$row[0]</td>
	<td align=center height=50 width=100>$row[1]</td>
	<td align=center height=50 width=100>$row[2]</td>
	<td align=center height=50 width=100>$row[3]</td>
	<td align=center height=50 width=100>$row[4]</td>
	<td align=center height=50 width=100>$row[5]</td>
	<td align=center height=50 width=100>$row[6]</td>
	<td align=center height=50 width=100>$row[7]</td>
	<td align=center height=50 width=100>$row[8]</td>
	<td align=center height=50 width=100>$row[9]</td>
	<td align=center height=50 width=100>$row[10]</td>
	<td align=center height=50 width=100>$row[11]</td>
	<td align=center >$row[12]</td>
	</tr>";
}

echo "
	</center>
    </table>
    ";
			}
		}

?>
</body>
</html>