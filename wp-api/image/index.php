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
$query_images_args = array(
    'post_type' => 'attachment', 'post_mime_type' =>'image', 'post_status' => 'inherit', 'posts_per_page' => -1,
);

$query_images = new WP_Query( $query_images_args );
$images = array();
foreach ( $query_images->posts as $image) {
    $images[]= wp_get_attachment_url( $image->ID );
}
}

// finally encode and "return" response
echo json_encode(array_values($data));