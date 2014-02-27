<?php
/*
Plugin Name: WordPress Media Tags
Plugin URI: http://www.typomedia.org/wordpress/plugins/wordpress-media-tags/
Description: This plugin gives you the ability to use <code>Media Tags</code> for any attachment.
Author: Typomedia Foundation
Version: 1.5
Author URI: http://www.typomedia.org/
*/

if (!class_exists ('wp_media_tags_plugin')) {
	class wp_media_tags_plugin {

	// Loads the plugin's translated strings
	function media_tags_textdomain() {
		load_plugin_textdomain('wpmtp', false, dirname(plugin_basename(__FILE__)) . '/languages/');
	}

	// Function adds a media_tag taxonomy
	function media_tags_init() {
		$labels = array(
			'name' => __( 'Media Tags', 'wpmtp' ),
			'singular_name' => __( 'Media Tag', 'wpmtp' ),
			'search_items' => __( 'Search Tags', 'wpmtp' ),
			'popular_items' => __( 'Popular Tags', 'wpmtp'),
			'all_items' => __( 'All Tags', 'wpmtp' ),
			'parent_item' => __( 'Parent Tag', 'wpmtp' ),
			'parent_item_colon' => __( 'Parent Tag:', 'wpmtp' ),
			'edit_item' => __( 'Edit Tag', 'wpmtp' ), 
			'update_item' => __( 'Update Tag', 'wpmtp' ),
			'add_new_item' => __( 'Add New Tag', 'wpmtp' ),
			'new_item_name' => __( 'New Tag Name', 'wpmtp' ),
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'rewrite' => false,
		);

		register_taxonomy('media_tag', 'attachment', $args);
	}

	// Adding table header in Media Library
	function add_media_columns($columns) {
		$new = array();
		foreach($columns as $key => $title) {
			if ($key=='comments') // Put the column before the $key column
				$new['media_tags'] = __('Media Tags', 'wpmtp');
			$new[$key] = $title;
		}
		return $new;
	}

	// Adding tags entries in Media Library
	function fill_media_columns($column_name, $id) {
		switch($column_name) {
		case 'media_tags':
			$admin = get_admin_url();
			$string = "upload.php?";
			$tags = get_the_terms( $id, 'media_tag' );
			if ($tags) {
				$out = array();
				foreach ( $tags as $tag )
					$out[] = "<a href='".$string."media_tag=$tag->slug'> " . esc_html(sanitize_term_field('name', $tag->name, $tag->term_id, 'media_tag', 'display')) . "</a>";
				echo join( ', ', $out );
			} else {
				_e('No Tags');
			}
			break;
		default:
			break;
		}		 
	}

	// Get media_tags from database
	function media_tags_query($term, $size, $number, $class) {
		$pattern = "/\d\,\s?\d/";
		
		if (strrpos($term, ',') !== false) {
			$term = explode(',', $term);
		}
		if ( preg_match($pattern, $size) ) { 
			$size = array($size);
		}
		
		$args = array( 
			'post_type' => 'attachment', 
			'post_mime_type' => 'image',
			'post_status' => 'inherit',
			'posts_per_page' => $number,
			'tax_query' => array(
					array(
						'taxonomy' => 'media_tag',
						'terms' => $term,
						'field' => 'slug',
					)
				)
		);

		$loop = new WP_Query($args);
		while ( $loop->have_posts() ) : $loop->the_post();
			$image = wp_get_attachment_image('', $size, false);
			$url = wp_get_attachment_url();
			$output .= '<a class="'.$class.'" title="'.get_the_title().'" href="'.$url.'">'.$image.'</a>'."\n";
		endwhile;
	
		return $output;
	}

	function media_tags_attachments($term) {
		$pattern = "/\d\,\s?\d/";
		
		if (strrpos($term, ',') !== false) {
			$term = explode(',', $term);
		}
		if ( preg_match($pattern, $size) ) { 
			$size = array($size);
		}
		
		$args = array( 
			'post_type' => 'attachment', 
			'post_mime_type' => 'image',
			'post_status' => 'inherit',
                        'posts_per_page' => 100,
			'tax_query' => array(
					array(
						'taxonomy' => 'media_tag',
						'terms' => $term,
						'field' => 'slug',
					)
				)
		);

		$loop    = new WP_Query($args);
		$results = [ ]; 
		while ( $loop->have_posts() ) : $loop->the_post();
			$results[] = wp_get_attachment();
		endwhile;
	
		return $results;
	}	

	// Function for shortcode
	function media_tags_shortcode($atts) {
		extract( shortcode_atts( array(
			'name' => '',
			'size' => 'thumbnail',
			'number' => '-1',
			'class' => 'attachment-link',
		), $atts ) );
		return self::media_tags_query($name, $size, $number, $class);
	}

	// Exclude media_tag from search
	function search_by_tax_filter(&$query) {
		if ($query->is_search)
		$query->set('taxonomy', 'media_tag');
	}

	
	} // class wp_media_tags_plugin
}

add_action('init', array('wp_media_tags_plugin','media_tags_textdomain'));
add_action('init', array('wp_media_tags_plugin','media_tags_init'));
add_filter('manage_media_columns', array('wp_media_tags_plugin', 'add_media_columns'));
add_action('manage_media_custom_column', array('wp_media_tags_plugin', 'fill_media_columns'), 10, 2 );
add_shortcode('mediatag', array('wp_media_tags_plugin', 'media_tags_shortcode'));
add_action('parse_query', array('wp_media_tags_plugin', 'search_by_tax_filter'));
?>
