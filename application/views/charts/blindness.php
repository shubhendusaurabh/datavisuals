<?php

$fp = fopen("data/blindness.csv", "r");

$arr = array();
while ($line = fgetcsv($fp)) {
	$arr[] = $line;
}
fclose($fp);
array_shift($arr);
//var_dump($arr);
$data = array();
foreach($arr as $a){
	$temp['y'] = floatval($a[1]);
	$temp['key'] = $a[0];
	$data[] = $temp;	
}
?>
	<div class="container">
		<h2>See the mimimum temperature over the years</h2>
		<div class="row-fluid">
			<div class="span7">
				<svg id="chart"></svg>
			</div>
				
			<div class="span7 offset1">
				<?= $visual->body ?>
			</div>
		</div>
		<script>
	
			var seriesData = <?php echo json_encode($data); ?>;
				
			nv.addGraph(function() {
			    var width = 600,
			        height = 500;
			
			    var chart = nv.models.pieChart()
			        .x(function(d) { return d.key + ": " + d.y + "%" })
			        .y(function(d) { return d.y })
			        .showLabels(true)
			        .values(function(d) { return d })
			        .color(d3.scale.category20c().range())
			        .width(width)
			        .height(height);
				var tp = function(key, y, e, graph) {
					return '<h3>' + key + '</h3>' ;
				};
				chart.tooltipContent(tp);
			      d3.select("#chart")
			          .datum([seriesData])
			        .transition().duration(1200)
			          .attr('width', width)
			          .attr('height', height)
			          .call(chart);
			
			    chart.dispatch.on('stateChange', function(e) { nv.log('New State:', JSON.stringify(e)); });
			
			    return chart;
			});

		</script>

	</div>