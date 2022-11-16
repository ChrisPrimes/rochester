<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'blogsite-fontawesome-style','blogsite-genericons-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

function rochester_adding_scripts() {
    wp_register_script('rochester_mobile_script', get_stylesheet_directory_uri() . '/mobile.js');
    wp_enqueue_script('rochester_mobile_script');
	
	wp_register_style('rochester-search', get_stylesheet_directory_uri() . '/search.css');
    wp_enqueue_style('rochester-search');
} 

add_action( 'wp_enqueue_scripts', 'rochester_adding_scripts', 999 );

function remove_parent_filters(){
	remove_filter('pre_get_posts','blogsite_search_filter');
	remove_action('admin_bar_menu', 'blogsite_custom_toolbar_link', 999);
	remove_action( 'admin_menu', 'blogsite_menu' );
}

add_action( 'after_setup_theme', 'remove_parent_filters' );

/**
 * Extend WordPress search to include custom fields
 *
 * https://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
		if(is_numeric(get_search_query())) {
			$query_num = intval(get_search_query());
			$where = "AND " . $wpdb->posts . ".post_type = 'permanent-collection' AND ". $wpdb->posts . ".post_status = 'publish' AND " . $wpdb->postmeta.".meta_key = 'collection_number' AND " . $wpdb->postmeta.".meta_value = " . $query_num;
			
		} else {
			$where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR ((".$wpdb->postmeta.".meta_value LIKE $1) AND ".$wpdb->postmeta.".meta_key IN('exhibition_title', 'artist_website', 'collection_number', 'title'))", $where );
		}
		
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

/*
 * Sort
 */
function custom_archives_orderby( $query ) {
	if(is_admin()) {
		return;
	}
	
    if ( $query->is_archive() && $query->is_main_query() && $query->query_vars['post_type'] == 'permanent-collection' ) {		
		$query->set( 'meta_key', 'collection_number' );
		$query->set( 'meta_type', 'NUMERIC' );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'order', 'asc' );
		$query->set( 'posts_per_page', '50' );
    }
	
	$categories = array("digital-exhibitions", "carnegie-gallery", "bernier-room", "past-projects");
	
	if ( $query->is_archive() && $query->is_main_query() && in_array($query->query_vars['category_name'], $categories) ) {		
		$query->set( 'meta_key', 'exhibition_start' );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 'order', 'dsc' );
    }
}
add_action( 'pre_get_posts', 'custom_archives_orderby' );

function get_artist_link() {
	$artist_website = get_field('artist_website');
	
	if($artist_website == '') {
		return '';
	}
	
	if(substr($artist_website, 0, 1) === '@') {
		$link = 'https://instagram.com/' . str_replace('@', '', $artist_website);
		$title = $artist_website;
	} else {
		if (stripos($artist_website, 'http://') === 0 || stripos($artist_website, 'https://') === 0) {
			$link = $artist_website;
			$title = str_replace('http://', '', str_replace('https://', '', $artist_website));
		} else {
			$link = 'https://' . $artist_website;
			$title = $artist_website;
		}
	}
	
	return '<a target="_blank" href="'. esc_html( $link ) . '">' . esc_html( $title ) . '</a>';
}

require_once('widget-recent.php');
function register_posts_widget() { 
    register_widget( 'Rochester_Recent_Widget' ); 
}

add_action( 'widgets_init', 'register_posts_widget' );

add_action(
    'after_setup_theme',
    function() {
        add_theme_support( 'html5', [ 'script', 'style' ] );
    }
);

add_filter( 'wpseo_schema_needs_author', '__return_false' );

function rochester_primary_category() {
    $category = get_the_category();
	$index = 0;
	
	if($category && $category[0]->slug === 'now-on-view' && count($category) > 1) {
		$index = 1;
	}
	
	return $category[$index]->slug;
}

function get_address() {
	$cat = rochester_primary_category();
	if($cat == 'bernier-room' || $cat == 'digital-exhibitions') {
		$address = '150 Wakefield Street, Rochester, NH 03867';
	} else if($cat == 'carnegie-gallery') {
		$address = '65 South Main Street, Rochester, NH 03867';
	} else {
		$address = '';
	}
	
	return $address;
}

function blogsite_custom_excerpt_length( $length ) {
    if ( is_admin() ) {
        return $length;
    } else {
       return '55'; 
    }
}

function rochester_is_on_view() {
	if(has_category('now-on-view') && has_category(array('bernier-room', 'digital-exhibitions', 'carnegie-gallery'))) {
		return true;
	} else {
		return false;
	}
}

function blogsite_first_category() {
	$category = get_the_category();
	$onView = rochester_is_on_view();
	$index = 0;
	
	if($category && $onView && $category[0]->slug !== 'now-on-view' && count($category) > 1) {
		$index = 1;
	}
	
    if ($category) {
      echo '<a href="' . esc_url( get_category_link( $category[$index]->term_id ) ) . '">' . esc_html( $category[$index]->name ) .'</a> ';
    }    
}