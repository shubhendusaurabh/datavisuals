<?php



function get_files($library,$stylesheet=false)
{
	$js = array('rickshaw' => array(
					'jquery-ui-1.9.1.custom.min.js',
					'd3.min.js',
					'd3.layout.min.js',
					'rickshaw.min.js'
				),
			'nvd3' => array(
					'd3.v3.js',
					'nv.d3.js'
				)
			);
			
	$css = array('rickshaw' => 'rickshaw.min.css',
			 'nvd3' => 'nv.d3.css'
		);
	if ($stylesheet === TRUE){
		return $css[$library];
	}
	return $js[$library];
}