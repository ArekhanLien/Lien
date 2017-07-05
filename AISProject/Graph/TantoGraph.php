<?php
define ( "DATABASE_NAME", "postgres" );
define ( "USER_NAME", "postgres" );
define ( "USER_PASSWORD", "dltjrals0102" );
define ( "QUERY_STRING3", "SELECT opportunity , count(*) FROM m_ais
						  where delete_flag = 0
						  GROUP BY opportunity;"
		);

?>
<!DOCTYPE HTML>
<html lang="jp">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>新規登録画面</title>

		<p>
<?php
		// DB Connect
		$database = pg_connect ( "dbname=" . DATABASE_NAME . " user=" . USER_NAME . " password=" . USER_PASSWORD );
		if (! $database) {
			echo ("データベースへ登録することができませんでした。(" . DATABASE_NAME . ")");
		} else {
			$rs = pg_query ( $database, QUERY_STRING3 );
			if (!$rs) {
				echo ("SQL文を実行できません(" . QUERY_STRING3 . ")");
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
				function arrayProcessing3($row, $rs){
					$result = array();
					while($row = pg_fetch_array($rs)) {

 						$result[$row['opportunity'].'['.$row['count'].']'] = $row['count'];

					}
					return $result;
				}

				try {

					$data = arrayProcessing3($row, $rs);



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
						'type' => 'bar-vertical',
						'title' => '案件担当',
						'data' => $data,
						'size' => array (
								500,
								350
						),
						'labelsXY' => true,
						'color' => $color
				) );
				// Print chart

				echo $chart
?>
<?php
			}
		}
?>

    </p>

</html>
