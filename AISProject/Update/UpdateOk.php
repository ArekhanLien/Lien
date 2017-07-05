<DOCTYPE HTML!>
<html lang="jp">
<head>
<?php
// Database Connect Data
  define("DATABASE_NAME", "postgres");
  define("USER_NAME"    , "postgres");
  define("USER_PASSWORD", "dltjrals0102");



// 更新後格納ファイル
$aaa     = $_POST['aaa'];       //顧客
$bbb     = $_POST['bbb'];        //ステータス
switch($bbb) {

	case "提案前":
		$bbb = 1;
		break;
	case "提案済":
		$bbb = 2;
		break;
	case "面談前":
		$bbb = 3;
		break;
	case "結果待ち":
		$bbb = 4;
		break;
	case "NG":
		$bbb = 5;
		break;
	case "OK":
		$bbb = 6;
		break;
	case "2次面談待ち":
		$bbb = 7;
		break;
	case "クロ-ズ":
		$bbb = 8;
		break;

}
$ccc     = $_POST['ccc'];        //案件名
$ddd     = $_POST['ddd'];       //案件概要
$eee     = $_POST['eee'];       //作業場所
$fff     = $_POST['fff'];       //期間
$ggg     = $_POST['ggg'];       //募集人数
$hhh     = $_POST['hhh'];        //スキル
$iii     = $_POST['iii'];        //条件
$jjj     = $_POST['jjj'];        //商流
$kkk     = $_POST['kkk'];        //その他
$lll     = $_POST['lll'];        //案件担当
$mmm     = $_POST['mmm'];       //更新対象No
// sql Query
define("QUERY_STRING" ,
"UPDATE m_ais SET
				casee          = '$aaa' ,
			    statusnumber        = '$bbb' ,
			    casename       = '$ccc' ,
			    projectoutline = '$ddd' ,
			    workplace      = '$eee' ,
			    period         = '$fff' ,
			    numberperiod   = '$ggg' ,
			    skill          = '$hhh' ,
			    conditions     = '$iii' ,
			    flow           = '$jjj' ,
			    other          = '$kkk' ,
				opportunity    = '$lll'
		     WHERE
				number         = '$mmm'

");


// DataBase Connect
$database = pg_connect("dbname=".DATABASE_NAME." user=".USER_NAME." password=".USER_PASSWORD);

if (!$database) { // Connect Failed
	echo("データベースへ登録することができませんでした。(".DATABASE_NAME.")");

} else { // Connect Success

	// Check Query
	$rs = pg_query($database, QUERY_STRING);

	if (!$rs) { // Query Failed
		echo("SQL文を実行できません(".QUERY_STRING.")");

	} else { // Query Success
		//echo("SQL文を実行できました(".QUERY_STRING.")");
		echo("<script>location.href='../index.php';</script>");

	}
}
?>
<title>
</title>
</head>
<body>
</body>
</html>










