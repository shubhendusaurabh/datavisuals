<?php

$category = array(1 => 'Rural India', 2 => 'Urban India', 3 => 'Total');
$color = array(1 => '#c05020', 2 => '#f68f6e', 3 => '#f85a6a', 4 => '#c6df45', 5 => '#f0f0f0');

$fp = fopen("data/poverty.csv", "r");

$arr = array();
while ($line = fgetcsv($fp)) {
	$arr[] = $line;
}
fclose($fp);
array_shift($arr);

foreach ($arr as $a) {
	
	$data = array();
	$temp['total'] = $a[3];
	$temp['label'] = $a[0];
	$temp['key'] = $category[2];
	$temp['y'] = $a[2];
	$temp['per'] = round((($a[2] / $a[3]) * 100), 2);
	$data[] = $temp;

	$temp['key'] = $category[1];
	$temp['y'] = $a[1];
	$temp['per'] = 100 - $temp['per'];

	$data[] = $temp;

	$s[] = $data;

}

?>
		<div class="container">
			<div class="row-fluid">
				<div class="span6">
					<h3 class="pull-right"><p><time datetime="1973">Year: 1973</time></p></h3>
					<svg id="chart"></svg>
					
				</div>
				<div class="span6">
					<h3 class="pull-right"><p><time datetime="1983">Year: 1983</time></p></h3>
					<svg id="chart1"></svg>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<h3 class="pull-right"><p><time datetime="1993">Year: 1993</time></p></h3>
					<svg id="chart2"></svg>
				</div>
				<div class="span6">
				<h3 class="pull-right"><p><time datetime="2004">Year: 2004</time></p></h3>
					<svg id="chart3"></svg>
				</div>
			</div>

			<script>
			var testdata =<?php echo json_encode($s[0]); ?>;
			var testdata1 = <?php echo json_encode($s[1]); ?>;
			var testdata2 = <?php echo json_encode($s[2]); ?>;
			var testdata3 = <?php echo json_encode($s[3]); ?>;
			var width = 500, height = 500;
		
			var chart = nv.models.pieChart().x(function(d) {
				return d.key + ": " + Math.round(d.per) + "%"
			}).y(function(d) {
				return d.y
			}).showLabels(true).values(function(d) {
				return d
			}).color(d3.scale.category20().range()).width(width).height(height);
			var tp = function(key, y, e, graph) {
				return '<h3>' + key + '</h3>' + '<p>No of persons: ' + y + '</p>' + '<p>Percentage: ' + e.point.per + '%</p>' + '<p>Total: ' + e.point.total + '</p>'+ '<p>Year: ' + e.point.label + '</p>';
			};
			chart.tooltipContent(tp);
			function plot(id, data) {
		
				d3.select(id).datum([data]).transition().duration(1200).attr('width', width).attr('height', height).call(chart);
		
				chart.dispatch.on('stateChange', function(e) {
					nv.log('New State:', JSON.stringify(e));
				});
		
				return chart;
			}
		
		
			nv.addGraph(plot("#chart", testdata));
			nv.addGraph(plot("#chart1", testdata1));
			nv.addGraph(plot("#chart2", testdata2));
			nv.addGraph(plot("#chart3", testdata3));

			</script>
			<div class="span7 offset1">
				<?php echo $visual->body;?>
				<table class="table table-bordered table-striped table-condensed table-hover">
					<thead>
						<th>Year</th>
						<th>Number of Persons Below Poverty Line in Rural India</th>
						<th>Number of Persons Below Poverty Line in Urban India</th>
						<th>Number of Persons Below Poverty Line in India</th>
					</thead>
					<tbody>
						<tr>
							<td>1973</td>
							<td>2612.9</td>
							<td>600.46</td>
							<td>3213.36</td>
						</tr>
						<tr>
							<td>1983</td>
							<td>2519.57</td>
							<td>709.4</td>
							<td>3228.97</td>
						</tr>
						<tr>
							<td>1993</td>
							<td>2440.31</td>
							<td>763.37</td>
							<td>3203.68</td>
						</tr>
						<tr>
							<td>2004</td>
							<td>2209.24</td>
							<td>807.96</td>
							<td>3017.2</td>
						</tr>
					</tbody>
			</table>
			</div>
		</div>
