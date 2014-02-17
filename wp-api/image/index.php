<?php
/**
 * "Controller" for image resource
 *
 * @package WordPress
 * @subpackage Administration
 */

// iterate through tags and build listing of images
$uris = [ ];


foreach($_REQUEST['tags'] as $tag) { 
	// query media items
  // @TODO will need pagination here
  $raw = @wp_media_tags_plugin::media_tags_query(
		$tag, 'full'
	); 

	// pre match on src attribute
  preg_match_all('/src="(.+?)"/', $raw, $matches);

	$uris = empty($uris) 
		? $matches[1]
		: array_intersect($uris, $matches[1]);
}


// finally encode and "return" response
echo json_encode($uris);