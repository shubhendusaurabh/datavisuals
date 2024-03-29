<?php
date_default_timezone_set('UTC');
$season = array(1 => 'Annual', 2 => 'Jan-Feb', 3 => 'Mar-May', 4 => 'Jun-Sep', 5 => 'Oct-Dec');
$color = array(1 => '#c05020', 2 => '#f68f6e', 3 => '#f85a6a', 4 => '#c6df45', 5 => '#0088cc');
$file = base_url("data/{$visual->filename}").'.csv';
$fp = fopen($file, "r");

$arr = array();
while ($line = fgetcsv($fp)) {
	$arr[] = $line;
}
fclose($fp);
array_shift($arr);
array_shift($arr);

foreach ($season as $key => $value) {
	$year = 1901;
	$lol = array();
	foreach ($arr as $a) {
		$temp['x'] = mktime(22,0,0,12,13,$year++);
		$temp['y'] = floatval($a[$key]);
		$lol[] = $temp;

	}
	
	$data['data'] = $lol;
	$data['name'] = $value;
	$data['color'] = $color[$key];
	$s[] = $data;
	
}
?>
		<div id="chart_container">
			<div id="y_axis"></div>
			<div id="chart"></div>

		</div>
		<br />
		<div class="row">
			<div class="span7 offset1">
				<?php echo $visual->body;?>
			</div>
			<div class="span3 offset1">
				<div id="legend_container">
					<div id="smoother" title="Smoothing"></div>
					<div id="legend"></div>
				</div>
			</div>
		</div>
		
		
		<script>
	
			var graph = new Rickshaw.Graph({
				element : document.getElementById("chart"),
				width : 900,
				height : 350,
				renderer : 'line',
				series : <?php echo json_encode($s); ?>
			});
			
			var y_ticks = new Rickshaw.Graph.Axis.Y({
				graph : graph,
				orientation : 'left',
				tickFormat : Rickshaw.Fixtures.Number.formatKMBT,
				element : document.getElementById('y_axis'),
			});
			var axes = new Rickshaw.Graph.Axis.Time({
				graph : graph
			});
		
			
			var hoverDetail = new Rickshaw.Graph.HoverDetail({
				graph : graph
			});
		
			var legend = new Rickshaw.Graph.Legend({
				graph : graph,
				element : document.getElementById('legend')
		
			});
		
			var shelving = new Rickshaw.Graph.Behavior.Series.Toggle({
				graph : graph,
				legend : legend
			});
			graph.render();

		</script>
