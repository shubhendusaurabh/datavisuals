<?php

function btn_edit($uri) {
	return anchor($uri, '<i class="icon-edit"></i>');
}

function btn_delete($uri) {
	return anchor($uri, '<i class="icon-remove"></i>', array('onclick' => "return confirm('You are about to delete!');"));
}

function e($string) {
	return htmlentities($string);
}

function visual_link($visual) {
	return 'visual/' . intval($visual -> id) . '/' . e($visual -> slug);
}

function visual_links($visuals) {
	$string = '<ul>';
	foreach ($visuals as $visual) {
		$url = visual_link($visual);
		$string .= '<li>';
		$string .= "<h3>" . anchor($url, $visual -> title) . " &raquo; </h3>";
		$string .= '<p class="pubdate">' . e($visual -> pubdate) . '</p>';
		$string .= '</li>';

	}
	$string .= '</ul>';
	return $string;
}

function get_excerpt($visual, $numwords = 50) {
	$string = '';
	$url = 'visual/' . intval($visual -> id) . '/' . e($visual -> slug);
	$string .= '<h2>' . anchor($url, e($visual -> title)) . '</h2>'.PHP_EOL;
	$string .= '<p class="pubdate">' . e($visual -> pubdate) . '</p>'.PHP_EOL;
	$string .= '<p>' . e(limit_to_numwords(strip_tags($visual -> body), $numwords)) . '</p>'.PHP_EOL;
	$string .= '<p>' . anchor($url, 'Read More >', array('title' => e($visual -> title))) . '</p>'.PHP_EOL;
	return $string;
}

function limit_to_numwords($string, $numwords) {
	$excerpt = explode(' ', $string, $numwords + 1);
	if (count($excerpt) >= $numwords) {
		array_pop($excerpt);
	}
	$excerpt = implode(' ', $excerpt);
	return $excerpt;
}

function get_menu($array, $child = false) {

	$CI = &get_instance();

	$str = '';

	if (count($array)) {
		$str .= $child == false ? '<ul class="nav">' : '<ul class="dropdown-menu">';

		foreach ($array as $item) {

			$active = $CI -> uri -> segment(1) == $item['slug'] ? true : false;

			// Do for any children
			if (isset($item['children']) && count($item['children'])) {
				$str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
				$str .= '<a class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['slug'])) . '"> ' . $item['title'];
				$str .= '<b class="caret"></b></a>' . PHP_EOL;
				$str .= get_menu($item['children'], true);
			} else {
				$str .= $active ? '<li class="active">' : '<li>' . PHP_EOL;
				$str .= '<a href="' . site_url($item['slug']) . '"> ' . $item['title'] . '</a>';
			}

			$str .= '</li>' . PHP_EOL;
		}

		$str .= '</ul>' . PHP_EOL;
	}

	return $str;
}

function get_ol($array, $child = false){

	$str = '';

	if (count($array)) {
		$str .= $child == false ? '<ol class="sortable">' : '<ol>';

		foreach ($array as $item) {
			$str .= '<li id="list_' . $item['id'] . '">';
			$str .= '<div>' . $item['title'] . '</div>' . PHP_EOL;

			// Do for any children
			if (isset($item['children']) && count($item['children'])) {
				$str .= get_ol($item['children'], true);			
			}

			$str .= '</li>' . PHP_EOL;
		}

		$str .= '</ol>' . PHP_EOL;
	}

	return $str;
}

function admin_menu($array){
	
	$CI = &get_instance();
	
	$str = '';

	if (count($array)) {
		$str .= '<ul class="nav">';

		foreach ($array as $key => $value) {

			$active = $CI -> uri -> segment(2) == $key ? true : false;
			$str .= $active ? '<li class="active">' : '<li>' . PHP_EOL;
			$str .= '<a href="' . site_url('admin/'.$key) . '"> ' . $value . '</a>';
		

			$str .= '</li>' . PHP_EOL;
		}

		$str .= '</ul>' . PHP_EOL;
	}

	return $str;
}
