<?php
/**
 * "Controller" for media resource; responsible for updating 
 * media items
 *
 * @package WordPress
 * @subpackage Administration
 */

// iterate through tags and build listing of images
global $wpdb;
$data = [ ];


// get payload 
$payload  = (array)json_decode(stripslashes($_REQUEST['payload']));
$filename = $payload['filename'];


$wp_filetype   = wp_check_filetype($filename);
$wp_upload_dir = wp_upload_dir();


$attachment = array(
   'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
   'post_mime_type' => $wp_filetype['type'],
   'post_title'     => $payload['title'],
   'post_content'   => $payload['description'],
   'post_status'    => 'inherit'
);
$attach_id = wp_insert_attachment( $attachment, $filename, 37 );

// you must first include the image.php file
// for the function wp_generate_attachment_metadata() to work
require_once( ABSPATH . 'wp-admin/includes/image.php' );
$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
wp_update_attachment_metadata( $attach_id, $attach_data );

// iterate through terms and attach to post object
foreach($payload['terms'] as $term) {
  $term = (array)$term;


  $wpdb->get_results(
    "INSERT INTO wp_term_relationships (
      object_id, term_taxonomy_id

    ) VALUES (
      $attach_id, {$term['term_taxonomy_id']}
    
    )"
  );  
}

// finally encode and "return" response
echo json_encode([ $attach_id ]);