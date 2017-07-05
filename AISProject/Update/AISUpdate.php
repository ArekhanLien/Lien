<?php
  define("DATABASE_NAME", "postgres");
  define("USER_NAME"    , "postgres");
  define("USER_PASSWORD", "dltjrals0102");
  define("QUERY_STRING" , "select statusnumber , st_name from status;");
?>
<!DOCTYPE HTML>
<html lang="jp">
  <head>

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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>情報更新画面</title>
  </head>

  <body>
    <a href="../index.php" style="text-decoration:none;"><Button id="submit">戻る</Button></a>
  	<center>
    	<h1 align="center">
    		<hr width="300" color="blue" size="2">
    <?php echo("AIS営業情報更新画面"); ?>
    	</h1>
    		<hr width="300" color="blue" size="2">
    </center>
    <p>
      <?php
      $database = pg_connect("dbname=".DATABASE_NAME.
      		" user=".USER_NAME.
      		" password=".USER_PASSWORD);
      if (!$database) {
      	echo("データベースへ登録することができませんでした。");
      } else {
      	$rs = pg_query($database, QUERY_STRING);
      	if (!$rs) {
      		echo("SQL文を実行できません(".QUERY_STRING.")");

      	} else {

?>

<!--========データの有効性チェック========-->
<?php
//顧客
if(isset($_POST['a'])) { $a = $_POST['a']; }
//ステータス
if(isset($_POST['b'])) { $b = $_POST['b']; }
//案件名
if(isset($_POST['c'])) { $c = $_POST['c']; }
//案件概要
if(isset($_POST['d'])) { $d = $_POST['d']; }
//作業場所
if(isset($_POST['e'])) { $e = $_POST['e']; }
//期間
if(isset($_POST['f'])) { $f = $_POST['f']; }
//募集人数
if(isset($_POST['g'])) { $g = $_POST['g']; }
//スキル
if(isset($_POST['h'])) { $h = $_POST['h']; }
//条件
if(isset($_POST['i'])) { $i = $_POST['i']; }
//商流
if(isset($_POST['j'])) { $j = $_POST['j']; }
//その他
if(isset($_POST['k'])) { $k = $_POST['k']; }
//案件担当
if(isset($_POST['l'])) { $l = $_POST['l']; }
//No
if(isset($_POST['m'])) { $m = $_POST['m']; }
?>

        <!--================================================-->
        <!--==========登録画面の入力情報を格納する==========-->
        <!--================================================-->
       <table align="center" width="600" cellpadding="5" cellspacing="5" border="0">
            <form action="UpdateOk.php" method="post">
            <tr>
			  <td align="right">更新元No</td><td><input type="text" name="M_1"  value="<?php echo $m ?>" disabled="disabled"></td>
            <tr>
            <input type="hidden" name="a" value="<?php echo $a ?>">
            <tr>
              <td width="10" align="right">(後)顧客</td><td><input type="text" name="aaa" size="55" value="<?php echo $a ?>"></td>
            </tr>
            <!--==============================================-->
            <!--========ドロップダウンリストを作成する========-->
            <!--==============================================-->
          	<tr>
          	<td width="120" align="right">(後)ステータス</td>
          	<td>
            <?php
            echo "<select name=bbb>";
            while($row = pg_fetch_assoc($rs)) {
            echo "<option>{$row['st_name']}</option>";
            }
            echo "</select>";
            ?>
            </td>
            <?php
            } //ifに対する閉じ括弧
            } //ifに対する閉じ括弧
            ?>
            <input type="hidden" name="c" value="<?php echo $c ?>">
            <input type="hidden" name="d" value="<?php echo $d ?>">
            <input type="hidden" name="e" value="<?php echo $e ?>">
            <input type="hidden" name="f" value="<?php echo $f ?>">
            <input type="hidden" name="g" value="<?php echo $g ?>">
            <input type="hidden" name="h" value="<?php echo $h ?>">
            <input type="hidden" name="i" value="<?php echo $i ?>">
            <input type="hidden" name="j" value="<?php echo $j ?>">
            <input type="hidden" name="k" value="<?php echo $k ?>">
            <input type="hidden" name="l" value="<?php echo $l ?>">
            <input type="hidden" name="m" value="<?php echo $m ?>">


            </td>
            </tr>
            <tr>
            <td width="100" align="right">(後)案件名</td><td><input type="text" name="ccc" size="55" value="<?php echo $c?>"></td>
            </tr>
            <tr>
            <td width="100" align="right">(後)案件概要</td><td><input type="text" name="ddd" size="55" value="<?php echo $d?>"></td>
            </tr>
            <tr>
            <td width="100" align="right">(後)作業場所</td><td><input type="text"  name="eee" size="55" value="<?php echo $e?>"></td>
            </tr>
            <tr>
            <td width="100" align="right">(後)期間</td><td><input type="text"  name="fff" size="55" value="<?php echo $f?>"></td>
            </tr>
            <tr>
            <td width="100" align="right">(後)募集人数</td><td><input type="text"  name="ggg" size="55" value="<?php echo $g?>"></td>
            </tr>
            <tr>
            <td width="100" align="right">(後)スキル</td><td><input type="text"  name="hhh" size="55" value="<?php echo $h?>"></td>
            </tr>
            <tr>
            <td width="100" align="right">(後)条件</td><td><input type="text"  name="iii" size="55" value="<?php echo $i?>"></td>
            </tr>
            <tr>
            <td width="100" align="right">(後)商流</td><td><input type="text"  name="jjj" size="55" value="<?php echo $j?>"></td>
            </tr>
            <tr>
            <td width="100" align="right">(後)その他</td><td><input type="text"  name="kkk" size="55" value="<?php echo $k?>"></td>
            </tr>
            <tr>
            <td width="100" align="right">(後)案件担当</td><td><input type="text"  name="lll" size="55" value="<?php echo $l?>"></td>
            </tr>
            <input type="hidden" name="mmm" value="<?php echo $m?>">
            <tr>
            <td colspan="2" align="center"><input type="submit" class="Button" value="更新実行" style="width:200px;height:50px"></td>
            </tr>
        </form>

    </p>
  </body>
</html>












