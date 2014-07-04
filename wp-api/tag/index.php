<?php
/**
 * "Controller" for tag resource
 *
 * @package WordPress
 * @subpackage Administration
 */

const TAXONOMY = 'category';

// iterate through tags and build listing of images
$data = [ ];

// if there are no arguments, then query all tags
global $wpdb;

$result = $wpdb->get_results($query = <<<EOQ
  SELECT
    wpt.term_id,
    wpt.slug,
    wpt.name,
    wptt.description

  FROM wp_terms wpt
  
  INNER JOIN
    wp_term_taxonomy wptt
      USING (term_id)

  WHERE wptt.taxonomy = 'media_tag'

EOQ
);


// finally encode and "return" response
echo json_encode($result);