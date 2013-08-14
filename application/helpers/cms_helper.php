<?php

function add_meta_title($string) {
	$CI = &get_instance();
	$CI -> data['meta_title'] = e($string) . ' - ' . $CI -> data['meta_title'];
}

function btn_edit($uri) {
	return anchor($uri, '<i class="icon-edit"></i>');
}

function btn_delete($uri) {
	return anchor($uri, '<i class="icon-remove"></i>', array('onclick' => "return confirm('You are about to delete!');"));
}

function e($string) {
	return htmlentities($string);
}

function article_link($article) {
	return 'article/' . intval($article -> id) . '/' . e($article -> slug);
}

function article_links($articles) {
	$string = '<ul>';
	foreach ($articles as $article) {
		$url = article_link($article);
		$string .= '<li>';
		$string .= "<h3>" . anchor($url, $article -> title) . " &raquo; </h3>";
		$string .= '<p class="pubdate">' . e($article -> pubdate) . '</p>';
		$string .= '</li>';

	}
	$string .= '</ul>';
	return $string;
}

function get_excerpt($article, $numwords = 50) {
	$string = '';
	$url = 'article/' . intval($article -> id) . '/' . e($article -> slug);
	$string .= '<h2>' . anchor($url, e($article -> title)) . '</h2>';
	$string .= '<p class="pubdate">' . e($article -> pubdate) . '</p>';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article -> body), $numwords)) . '</p>';
	$string .= '<p>' . anchor($url, 'Read More >', array('title' => e($article -> title))) . '</p>';
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

function image_link($image) {
	return 'image/' . intval($image -> id) . '/' . e($image -> slug);
}

function image_links($images){
	$string = '<ul>';
	foreach ($images as $image) {
		$url = image_link($image);
		$string .= '<li>';
		$string .= "<h3>" . anchor( $url, $image->title) . " &raquo; </h3>";
		$string .= '<p class="pubdate">' . e($image->pubdate) . '</p>';
		$string .= '</li>';

	}
	$string .= '</ul>';
	return $string;
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