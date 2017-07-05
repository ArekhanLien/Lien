<html>
<head>
<body>
<?php
$chart = new GoogChart ();

error_reporting(0);

function arrayProcessing($row, $rs){
	$result = array();
	while($row = pg_fetch_array($rs)) {
		//$result[$row['casee'].'.['.$row['count'].'%'.'].'] = $row['count'];
		$result[$row['casee'].'['.$row['count'].']'] = $row['count'];
	}

	return $result;
}

try {
	$data = arrayProcessing($row, $rs);



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
		'title' => '顧客割合',
		'data' => $data,
		'size' => array (
				600,
				350
		),
		'color' => $color
) );
?>
<h1><?php echo $chart;?></h1>

</html>
