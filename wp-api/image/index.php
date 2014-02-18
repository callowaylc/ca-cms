<?php
/**
 * "Controller" for image resource
 *
 * @package WordPress
 * @subpackage Administration
 */

// iterate through tags and build listing of images
$data = [ ];


foreach($_REQUEST['tags'] as $tag) { 
	// query media items
  // @TODO will need pagination here
  $attachments = @wp_media_tags_plugin::media_tags_attachments(
		$tag
	); 

  $data = empty($data)  
  	? $attachments
  	: array_uintersect($data, $attachments, function($a, $b) {
  		return strcmp($a['src'], $b['src']);
  	});
	
}

// finally encode and "return" response
echo json_encode(array_values($data));