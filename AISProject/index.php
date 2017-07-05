<!--========================================-->
<!--========データベース接続用コード========-->
<!--========================================-->
<?php
  $StatusName = null;
  define("DATABASE_NAME", "postgres");
  define("USER_NAME"    , "postgres");
  define("USER_PASSWORD", "dltjrals0102");
  define("QUERY_STRING" , "SELECT * FROM m_ais where delete_flag = 0
                           ORDER BY number ASC;
");


?>
<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>AIS営業支援システム</title>
<style>
Button {
   padding: 10px 15px;
   font-family: "HGP創英角ﾎﾟｯﾌﾟ体";
   background: #FF7A2A;
   color: #fff;
   border: none;
   cursor: pointer;
   border-radius: 5px;
   -webkit-border-radius: 10px;
}
Button2 {
   padding: 9px 15px;
   font-family: "HGP創英角ﾎﾟｯﾌﾟ体";
   background: #FF7A2A;
   color: #fff;
   border: none;
   cursor: pointer;
   border-radius: 5px;
   -webkit-border-radius: 10px;
}
Button3 {
   padding: 10px 15px;
   font-family: "HGP創英角ﾎﾟｯﾌﾟ体";
   background: #FF7A2A;
   color: #fff;
   border: none;
   cursor: pointer;
   border-radius: 5px;
   -webkit-border-radius: 10px;
}

.Button4 {
   padding: 9px 15px;
   font-family: "HGP創英角ﾎﾟｯﾌﾟ体";
   background: #FF7A7A;
   color: #fff;
   border: none;
   cursor: pointer;
   border-radius: 5px;
   -webkit-border-radius: 10px;
}

.Button5 {
   padding: 9px 15px;
   font-family: "HGP創英角ﾎﾟｯﾌﾟ体";
   background: #7aa7ff;
   color: #fff;
   border: none;
   cursor: pointer;
   border-radius: 5px;
   -webkit-border-radius: 10px;
}

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

<script type="text/javascript">
	function entryChange2(){
		if(document.getElementById('changeSelect')){
			id = document.getElementById('changeSelect').value;

			if(id == 'statusnumber'){
				//フォーム
				//document.getElementByID('select').value="";
				document.getElementById('select').style.display = "";
				document.getElementById('select2').style.display = "none";
				document.getElementById('select2').value = "";
			}else if(id == 'casee' || id == 'casename' || id == 'projectoutline' || id == 'workplace' || id == 'period' ||
					  id == 'numberperiod' || id == 'skill' || id == 'conditions' || id == 'flow' || id == 'other' ||
					  id == 'opportunity'){
				//フォーム

				document.getElementById('select').style.display = "none";
				document.getElementById('select2').style.display = "";
				document.getElementById('select').value = "";
				//特典

			}
		}
	}

	//オンロードさせ、リロード時に選択を保持
	window.onload = entryChange2;
</script>
  </head>
  <body>
  <center>
  <hr width="1550" color="orange" size="2">
  <font color="orange">
        <h1>AIS営業支援システム</h1></font>
  <hr width="1550" color="orange" size="2">
  </center>

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
        <!--========================================-->
        <!--========データベース接続処理終了========-->
        <!--========================================-->

        <!--=================================-->
        <!--========テーブル作成画面=========-->
	    <!--=================================-->
		<table border="0" width="300">
		<tr>
			<td>
			<a href="Insert/Insert.php" style="text-decoration:none;"><Button id="submit">新規登録</Button></a>
			</td>
			<td>
			<a href="ExcelOutPut/ExcelOutPut.php" style="text-decoration:none;"><Button2 id="submit">Excel出力</Button2></a>
			</td>
			<td>
			<a href="Graph/example.php" style="text-decoration:none;"><Button3 id="submit">グラフ</Button3></a>
			</td>
		</tr>
		</table>
		<form action="Search/Search.php" name="Select" method="POST" onchange="entryChange2();">
			<div align="right">
			((項目))
			<select id="changeSelect" name = "Search" style="width:100px;height:24px">
				<option value="casee">		 	顧客	  </option>
				<option value="statusnumber">	ステータス</option>
				<option value="casename">	 	案件名	  </option>
				<option value="projectoutline"> 案件概要  </option>
				<option value="workplace">	    作業場所  </option>
				<option value="period">			期間	  </option>
				<option value="numberperiod">	募集人数  </option>
				<option value="skill">		    スキル	  </option>
				<option value="conditions">		条件	  </option>
				<option value="flow">		    商流	  </option>
				<option value="other">		    その他	  </option>
				<option value="opportunity">	案件担当  </option>
			</select>

			<select id="select" name = "SearchText">
				<option value="">選択</option>
				<option value="1">提案前</option>
				<option value="2">提案済</option>
				<option value="3">面談前</option>
				<option value="4">結果待ち</option>
				<option value="5">NG</option>
				<option value="6">OK</option>
				<option value="7">2次面談待ち</option>
				<option value="8">クロ-ズ</option>
			</select>

		    <input type="text" id="select2" name="SearchText2">
			<input type="submit" class="Button4" value="検索実行" style="width:100px;height:30px">
		     </div>
			</form>
	<table border="1" width="1350" height="100">
        <tr bgcolor="#6699cc">
          <th scope="col" height="50" width="100">No</th>
          <th scope="col">顧客</th>
          <th scope="col">ステータス</th>
          <th scope="col">案件名</th>
          <th scope="col">案件概要</th>
          <th scope="col">作業場所</th>
          <th scope="col">期間</th>
          <th scope="col">募集人数</th>
          <th scope="col">スキル</th>
          <th scope="col">条件</th>
          <th scope="col">商流</th>
          <th scope="col">その他</th>
          <th scope="col">案件担当</th>
          <th scope="col">作成日</th>
          <th scope="col">更新</th>
          <th scope="col">削除</th>
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
        <td align = "center"><?php echo "$StatusName"?></td>  <!--ステータス -->
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

        <!--=============================================-->
        <!--========AISUpdate.phpへ更新情報を渡す========-->
        <!--=============================================-->
        <form action="Update/AISUpdate.php" method="POST">
        <input type="hidden" name="a" value="<?php echo "$row[0]"?>">    <!--顧客-->
        <input type="hidden" name="b" value="<?php echo "$row[1]"?>">    <!--ステータス-->
        <input type="hidden" name="c" value="<?php echo "$row[2]"?>">    <!--案件名-->
        <input type="hidden" name="d" value="<?php echo "$row[3]"?>">    <!--案件概要-->
        <input type="hidden" name="e" value="<?php echo "$row[4]"?>">    <!--作業場所-->
        <input type="hidden" name="f" value="<?php echo "$row[5]"?>">    <!--期間-->
        <input type="hidden" name="g" value="<?php echo "$row[6]"?>">    <!--募集人数-->
        <input type="hidden" name="h" value="<?php echo "$row[7]"?>">    <!--スキル-->
        <input type="hidden" name="i" value="<?php echo "$row[8]"?>">    <!--条件-->
        <input type="hidden" name="j" value="<?php echo "$row[9]"?>">    <!--商流-->
        <input type="hidden" name="k" value="<?php echo "$row[10]"?>">   <!--その他-->
        <input type="hidden" name="l" value="<?php echo "$row[11]"?>">   <!--案件担当-->
        <input type="hidden" name="m" value="<?php echo "$row[14]"?>">   <!--No-->
        <td align = "center"><input type="submit" class="Button5" value="更新"></td>
        </form>
        <!--==============================================-->
        <!--========DeleteOk.phpへ主キーのみを渡す========-->
        <!--==============================================-->
        <form action="Delete/DeleteOk.php" method="POST">
        <input type="hidden" name="D" value="<?php echo "$row[14]"?>">
        <td align = "center"><input type="submit" class="Button6" value="削除"></td>
        </form>
        </tr>
        <!--================================-->
        <!--========テーブル作成終了========-->
        <!--================================-->
        <?php
              }  //for文に対する閉じ括弧
       	?>
       	</form>
       	<?php

            } //if文に対する閉じ括弧
          } // if文に対する閉じ括弧
        ?>
        </body>
   </p>
  </table>
</html>














