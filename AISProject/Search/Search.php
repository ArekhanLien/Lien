<!--========================================-->
<!--========検索対象データを取得する========-->
<!--========================================-->
<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>検索結果</title>
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
  </head>
<?php
$SearchText2 = $_POST['SearchText2'];	//テキストボックスから
$SearchText = $_POST['SearchText'];	//ドロップダウンから
$Search		= $_POST['Search'];		//ドロップダウンリストから選択する
//検索結果のテキストがNullならば検索を実行しない

if($SearchText2 == null and $SearchText == null) {
	echo("<script>location.href='../index.php';</script>");
} else {

	if($Search == "statusnumber") {
		define("QUERY_STRING" , "SELECT * FROM m_ais where ".$Search." ILIKE '%".$SearchText."%' and delete_flag = 0
                           		  ORDER BY number ASC;");
	} else {

		define("QUERY_STRING" , "SELECT * FROM m_ais where ".$Search." ILIKE '%".$SearchText2."%' and delete_flag = 0
                           		  ORDER BY number ASC;");
	}
}


//検索結果判定終了==================================
?>
<!--========================================-->
<!--========データベース接続用コード========-->
<!--========================================-->
<?php
  define("DATABASE_NAME", "postgres");
  define("USER_NAME"    , "postgres");
  define("USER_PASSWORD", "dltjrals0102");
  /**/
?>
  <body>
        <h1>検索結果ページ</h1>

        <!--==================================-->
        <!--========データベース接続処理======-->
        <!--==================================-->
     <?php
        $database = pg_connect("dbname=".DATABASE_NAME.
                               " user=".USER_NAME.
                               " password=".USER_PASSWORD);
      ?>

      <?php
        if (!$database) { //DB接続失敗処理
          echo("接続失敗.<br>");
          echo("データベースへ接続することができませんでした(".DATABASE_NAME.")");
        } else { //DB接続成功処理

          $rs = pg_query($database, QUERY_STRING); //SQL文を渡す
          if (!$rs) { //SQL文接続処理（失敗の場合）
            echo("SQL文を実行することができません(".QUERY_STRING.")");
          } else { //SQL文接続処理（成功の場合）
          	$maxrows = pg_num_rows($rs);
      ?>

		<form action="../index.php" method="POST">
			<div align="left">
			    <td align = "center"><input type="submit" class="Button6" value="戻る" style=width:200px;height:50px"></td>
		     </div>
		</form>
	<table border="1" width="1350" height="100" cellpadding="0" cellspacing="0">
        <tr>
          <th scope="col">No</th>
          <th scope="col">顧客</th>
          <th scope="col" width="80">ステータス</th>
          <th scope="col">案件名</th>
          <th scope="col">案件概要</th>
          <th scope="col">作業場所</th>
          <th scope="col" width="80">期間</th>
          <th scope="col">募集人数</th>
          <th scope="col">スキル</th>
          <th scope="col">条件</th>
          <th scope="col">商流</th>
          <th scope="col">その他</th>
          <th scope="col">案件担当</th>
          <th scope="col">作成日</th>
		</tr>
		<?php
            for ($i = 0; $i < $maxrows; $i++) {
             $row = pg_fetch_row($rs, $i);

             switch($row[1]) {

             	case 1:
             		$StatusName = "提案前";
             		break;
             	case 2:
             		$StatusName = "提案済";
             		break;
             	case 3:
             		$StatusName = "面談前";
             		break;
             	case 4:
             		$StatusName = "結果待ち";
             		break;
             	case 5:
             		$StatusName = "NG";
             		break;

             	case 6:
             		$StatusName = "OK";
             		break;
             	case 7:
             		$StatusName = "2次面談待ち";
             		break;
             	case 8:
             		$StatusName = "クローズ";
             		break;
             }
        ?>
      <!--==========================================-->
      <!--========INSERT結果を格納し続ける==========-->
      <!--==========================================-->
      	<tr>
        <td align = "center"><?php echo "$row[14]"?></td> <!--No-->
        <td align = "center"><?php echo "$row[0]"?></td>  <!--顧客-->
        <td align = "center"><?php echo "$StatusName"?></td>  <!--ステータス-->
        <td align = "center"><?php echo "$row[2]"?></td>  <!--案件名-->
        <td align = "center"><?php echo "$row[3]"?></td>  <!--案件概要-->
        <td align = "center"><?php echo "$row[4]"?></td>  <!--作業場所-->
        <td align = "center"><?php echo "$row[5]"?></td>  <!--期間-->
        <td align = "center"><?php echo "$row[6]"?></td>  <!--募集人数-->
        <td align = "center"><?php echo "$row[7]"?></td>  <!--スキル-->
        <td align = "center"><?php echo "$row[8]"?></td>  <!--条件-->
        <td align = "center"><?php echo "$row[9]"?></td>  <!--商流-->
        <td align = "center"><?php echo "$row[10]"?></td> <!--その他-->
        <td align = "center"><?php echo "$row[11]"?></td> <!--案件担当-->
        <td align = "center"><?php echo "$row[12]"?></td>
       </form>
      	</tr>
        <!--================================-->
        <!--========テーブル作成終了========-->
        <!--================================-->
        <?php

              }  //for文に対する閉じ括弧
            } //if文に対する閉じ括弧
          } // if文に対する閉じ括弧
        ?>
   </p>
  </table>
  </body>
</html>
