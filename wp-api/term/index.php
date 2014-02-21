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

foreach($_REQUEST['terms'] as $parent) { 
	$parent   = get_term_by('name', $parent, TAXONOMY);
  $children = get_term_children($parent->term_id, TAXONOMY);
	
  foreach($children as $id) {
    $data[$id] = (array)get_term_by('id', $id, TAXONOMY);
  }
}

// finally encode and "return" response
echo json_encode(array_values($data));