<?php
define ( "DATABASE_NAME", "postgres" );
define ( "USER_NAME", "postgres" );
define ( "USER_PASSWORD", "dltjrals0102" );
define ( "QUERY_STRING2", "SELECT statusnumber , count(*) FROM m_ais
						  where delete_flag = 0
						  GROUP BY statusnumber;"
);

?>
<!DOCTYPE HTML>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>新規登録画面</title>
</head>

<body>

		<p>
<?php
		// DB Connect
		$database = pg_connect ( "dbname=" . DATABASE_NAME . " user=" . USER_NAME . " password=" . USER_PASSWORD );
		if (! $database) {
			echo ("データベースへ登録することができませんでした。(" . DATABASE_NAME . ")");
		} else {
			$rs = pg_query ( $database, QUERY_STRING2 );
			if (!$rs) {
				echo ("SQL文を実行できません(" . QUERY_STRING2 . ")");
			} else {
				// echo ("SQL文を実行できました(" . QUERY_STRING . ")");
		// -------------------------------------------------------------------------
?>
<?php
				/**
				 * Include class
				 */


				$chart = new GoogChart ();
				error_reporting(0);
				function arrayProcessing2($row, $rs){
					$result = array();
					while($row = pg_fetch_array($rs)) {

						switch($row['statusnumber']) {

							case 1:
								$row['statusnumber']= "提案前";
								break;
							case 2:
								$row['statusnumber']= "提案済";
								break;
							case 3:
								$row['statusnumber']= "面談前";
								break;
							case 4:
								$row['statusnumber']= "結果待ち";
								break;
							case 5:
								$row['statusnumber']= "NG";
								break;
							case 6:
								$row['statusnumber']= "OK";
								break;
							case 7:
								$row['statusnumber']= "2次面談待ち";
								break;
							case 8:
								$row['statusnumber']= "クローズ";
								break;
						}
						$result[$row['statusnumber'].'['.$row['count'].']'] = $row['count'];
					}
					return $result;
				}

				try {

					$data = arrayProcessing2($row, $rs);



				} catch ( Exception $e ) {
					echo ($e->getMessage ());
				}

				// Set graph colors
				$color = array (
						'#99C754',
						'#54C7C5',
						'#999999'
				);

				/* # Chart 1 # */
				$chart->setChartAttrs ( array (
						'type' => 'pie',
						'title' => 'ステータスグラフ',
						'data' => $data,
						'size' => array (
								500,
								350

						),
						'color' => $color
				) );

				 echo $chart;


	}
}
?>
    </p>
</body>
</html>