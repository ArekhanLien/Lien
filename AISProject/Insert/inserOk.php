<DOCTYPE HTML!>
<html lang="jp">
<head>
<meta charset="UTF-8">
<?php
// Database Connect Data
  define("DATABASE_NAME", "postgres");
  define("USER_NAME"    , "postgres");
  define("USER_PASSWORD", "dltjrals0102");
// information request
//$I0   = $_POST['M_0'];        //No
$I1     = $_POST['M_1'];        //顧客
$I2     = $_POST['M_2'];        //ステータスNo
$I3     = $_POST['M_3'];        //案件名
$I4     = $_POST['M_4'];        //案件概要
$I5     = $_POST['M_5'];        //作業場所
$I6     = $_POST['M_6'];        //期間
$I7     = $_POST['M_7'];        //募集人数
$I8     = $_POST['M_8'];        //スキル
$I9     = $_POST['M_9'];        //条件
$I10    = $_POST['M_10'];       //商流
$I11    = $_POST['M_11'];       //その他
$I12    = $_POST['M_12'];       //案件担当
$Status = null;


define("QUERY_STRING" ,
        "insert into m_ais(casee , statusnumber , casename , projectoutline , workplace , period , numberperiod ,
						   skill , conditions , flow , other , opportunity , creteddata , delete_flag)
		 values('$I1' , '$I2' , '$I3' , '$I4' , '$I5' , '$I6' ,'$I7' , '$I8' , '$I9' , '$I10' , '$I11' , '$I12' , current_date ,  0)"
);

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

