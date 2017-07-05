<DOCTYPE HTML!>
<html lang="jp">
<head>
<?php
// データベース接続用データ
  define("DATABASE_NAME", "postgres");
  define("USER_NAME"    , "postgres");
  define("USER_PASSWORD", "dltjrals0102");

$DeleteName = $_POST['D'];

// SQL文
define("QUERY_STRING" , "UPDATE m_ais SET delete_flag = 1 WHERE delete_flag = 0 and number = $DeleteName");

// データベース接続
$database = pg_connect("dbname=".DATABASE_NAME." user=".USER_NAME." password=".USER_PASSWORD);


if (!$database) { // Connect Failed
        echo("データベースへ登録することができませんでした。(".DATABASE_NAME.")");

} else { // Connect Success

        // SQL文チェック
        $rs = pg_query($database, QUERY_STRING);

        if (!$rs) { // SQL文に誤りあり
                echo("SQL文を実行できません(".QUERY_STRING.")");

        } else { // SQL文に誤りなし
                echo("<script>location.href='../index.php';</script>");
        }
}

?>
<title>
</title>
</head>
<body>
</html>