<?php
define("DATABASE_NAME", "postgres");
define("USER_NAME"    , "postgres");
define("USER_PASSWORD", "dltjrals0102");
define("QUERY_STRING" , "select statusnumber , st_name from status;");
?>
<!DOCTYPE HTML>
<html lang="jp">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>新規登録画面</title>

   <style>
  .Button {
   padding: 20px 15px;
   font-family: "HGP創英角ﾎﾟｯﾌﾟ体";
   background: #3dcc9c;
   color: #fff;
   border: none;
   cursor: pointer;
   border-radius: 5px;
   -webkit-border-radius: 10px;
}

Button {
   padding: 20px 15px;
   font-family: "HGP創英角ﾎﾟｯﾌﾟ体";
   background: #ff4d6a;
   color: #fff;
   border: none;
   cursor: pointer;
   border-radius: 5px;
   -webkit-border-radius: 10px;
}
  </style>
<script type="text/javascript">

function check(){

    var flag = 0;


    // 設定開始（必須にする項目を設定してください）

    if(document.form1.M_1.value == ""){ // 「お名前」の入力をチェック

        flag = 1;

    }
    else if(document.form1.M_3.value == ""){ // 「パスワード」の入力をチェック

        flag = 2;

    }
    else if(document.form1.M_12.value == ""){ // 「コメント」の入力をチェック

        flag = 3;

    }

    // 設定終了

    if(flag == 1) {

        window.alert('顧客情報が入力されていません'); // 入力漏れがあれば警告ダイアログを表示
        return false; // 送信を中止

    }

        if(flag == 2) {

        	window.alert('案件名情報が入力されていません'); // 入力漏れがあれば警告ダイアログを表示
            return false; // 送信を中止
        }

        	if(flag == 3) {
        		window.alert('案件担当者情報が入力されていません'); // 入力漏れがあれば警告ダイアログを表示
                return false; // 送信を中止
        	} else {

        return true; // 送信を実行

    }

}

</script>

  </head>

  <body>
  	<a href="../index.php" style="text-decoration:none;"><Button id="submit">戻る</Button></a>
  	<center>
    <h1 align="center">
    <hr width="300" color="blue" size="2">
    <?php echo("AIS営業情報登録画面"); ?>
    </h1>
    <hr width="300" color="blue" size="2">
    </center>
    <p>
      <?php
        $database = pg_connect("dbname=".DATABASE_NAME.
                               " user=".USER_NAME.
                               " password=".USER_PASSWORD);
        if (!$database) {
          echo("データベースへ登録することができませんでした。(".DATABASE_NAME.")");
        } else {
          $rs = pg_query($database, QUERY_STRING);
          if (!$rs) {
            echo("SQL文を実行できません(".QUERY_STRING.")");
          } else {

        ?>
        <!--================================================-->
        <!--==========登録画面の入力情報を格納する==========-->
        <!--================================================-->
            <table align="center" width="600" cellpadding="5" cellspacing="5" border="0">
            <form action="inserOk.php" method="post" name="form1" onSubmit="return check()">
            <tr>
		    <td width="5" align="right">顧客<font color="red">※</td></font></td><td><input type="text" name="M_1" size="55"></td>
            </tr>
            <!--==============================================-->
            <!--========ドロップダウンリストを作成する========-->
            <!--==============================================-->
            <tr>
            <td width="5" align="right">ステータス<font color="red">※</td></font></td>
            <td>
            <?php
          	echo "<select name=M_2>";
           	while($row = pg_fetch_assoc($rs)) {
            echo "<option value={$row['statusnumber']}>{$row['st_name']}</option>";
            }
            echo "</select>";
            ?>
            </td>
            </tr>
            <tr>
            <td width="100" align="right">案件名<font color="red">※</td></font></font><td><input type="text" name="M_3" size="55"></td>
            </tr>
            <tr>
            <td width="100" align="right">案件概要</td><td><input type="text" name="M_4" size="55"></td>
            </tr>
            <tr>
            <td width="100" align="right">作業場所</td><td><input type="text"  name="M_5" size="55"></td>
            </tr>
            <tr>
            <td width="100" align="right">期間</td><td><input type="text"  name="M_6" size="55"></td>
            </tr>
            <tr>
            <td width="100" align="right">募集人数</td><td><input type="text"  name="M_7" size="55"></td>
            </tr>
            <tr>
            <td width="100" align="right">スキル</td><td><input type="text"  name="M_8" size="55"></td>
            </tr>
            <tr>
            <td width="100" align="right">条件</td><td><input type="text"  name="M_9" size="55"></td>
            </tr>
            <tr>
            <td width="100" align="right">商流</td><td><input type="text"  name="M_10" size="55"></td>
            </tr>
            <tr>
            <td width="100" align="right">その他</td><td><input type="text"  name="M_11" size="55"></td>
            </tr>
            <tr>
            <td width="100" align="right">案件担当<font color="red">※</td></font></td><td><input type="text"  name="M_12" size="55"></td>
            </tr>
            <tr>
            <td colspan="2" align="center"><input type="submit" class="Button" value="登録" style="width:200px;height:50px"></td>
        </form>
        <?php
            }
        }

        ?>
    </p>
  </body>
</html>