<?php
/**
 * "Controller" for image resource
 *
 * @package WordPress
 * @subpackage Administration
 */

// iterate through tags and build listing of images
$data = [ ];

if (isset($_REQUEST['tags'])) {
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

} else if (isset($_REQUEST['slug'])) {

    global $wpdb;

    $res = $wpdb->get_results(
      "SELECT p.ID 
        FROM wp_posts p
        WHERE post_type='attachment'
        AND post_mime_type LIKE 'image%'
        AND LOWER(REPLACE(`post_title`, ' ', '-')) = '$_REQUEST[slug]'"
    
    );

    $data[] = wp_get_attachment($res[0]->ID);

# otherwise we are just pulling post data; this needs to be paginated
# because its motherfucking slow
} else {
  global $wpdb;

  $limit  = $_REQUEST['limit']  ?: 10;
  $offset = $_REQUEST['offset'] ?: 0; 
  $res    = $wpdb->get_results($query = sprintf(
    'SELECT wp.ID as id
     FROM wp_posts wp 
     WHERE 
       unix_timestamp(`wp`.`post_modified`) >= unix_timestamp(
        CURRENT_TIMESTAMP - INTERVAL %d MINUTE
       
       ) AND
       wp.post_type   = "attachment" AND
       wp.post_status = "inherit"
     ORDER BY wp.post_modified DESC
     LIMIT %d OFFSET %d' 
     
  // for interval, we make value arbitrarily large to cover
  // all posts
  , isset($_REQUEST['recent']) && $_REQUEST['recent'] ? 10 : 100000, $limit, $offset));


  //foreach ($query_images->posts as $image) {
  foreach($res as $result) { 
    $data[] = wp_get_attachment($result->id);
  }
}

// finally encode and "return" response
echo json_encode(array_values($data), JSON_PRETTY_PRINT);
