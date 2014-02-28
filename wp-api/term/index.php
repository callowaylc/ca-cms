<?php
/**
 * "Controller" for term resource
 *
 * @package WordPress
 * @subpackage Administration
 */

const TAXONOMY = 'category';

// iterate through tags and build listing of images
$data = [ ];

if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
  $tags = json_decode(stripslashes($_REQUEST['payload']));

  if (is_array($tags)) { 
    foreach($tags as $tag) {
      $tag = (array)$tag;

      $data[] = ($result = term_exists($tag['name'], $tag['type']))
        ? $result
        : wp_insert_term($tag['name'], $tag['type'], $tag);
    }
  }

} else { 
	foreach($_REQUEST['terms'] as $parent) { 
		$parent   = get_term_by('name', $parent, TAXONOMY);
	  $children = get_term_children($parent->term_id, TAXONOMY);
		
	  foreach($children as $id) {
	    $data[$id] = (array)get_term_by('id', $id, TAXONOMY);
	  }
	}

}

// finally encode and "return" response
echo json_encode(array_values($data));