<?php

/**
 * Enqueue scripts and styles.
 *
 * @since React Max 1.0
 */
function react_max_scripts() {

	// Load our main stylesheet.
//	wp_enqueue_style( 'bootstrap-style', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css' );
	wp_enqueue_style( 'react_max-style-dist', get_stylesheet_directory_uri() . '/dist/style.css');
	wp_enqueue_style( 'react_max-style', get_stylesheet_uri() );

    // Load scripts
//	wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', '20171006', false );
	wp_enqueue_script( 'scrollmagic', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js' , array( 'jquery' ), '1.0', false );    
	wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js', array( 'jquery' ), '20171006', false );
//    wp_enqueue_script( 'bootstrap-script', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js', array( 'jquery' ), '20171006', false );
    
    wp_enqueue_script( 'react_max-script', get_stylesheet_directory_uri() . '/dist/app.js' , array(), '1.0', true );

	$url = trailingslashit( home_url() );
	$path = trailingslashit( parse_url( $url, PHP_URL_PATH ) );

	wp_scripts()->add_data( 'react_max-script', 'data', sprintf( 'var ReactMaxSettings = %s;', wp_json_encode( array(
		'title' => get_bloginfo( 'name', 'display' ),
		'path' => $path,
		'URL' => array(
			'api' => esc_url_raw( get_rest_url( null, '/wp/v2' ) ),
			'root' => esc_url_raw( $url ),
		),
//		'woo' => array(
//			'url' => esc_url_raw( 'http://js-framework/wp-json/wc/v2/' ),
//			'consumer_key' => 'ck_803bcdcaa73d3a406a0f107041b07ef6217e05b9',
//			'consumer_secret' => 'cs_c50ba3a77cc88c3bf46ebac49bbc96de3a543f03'
//		),
	) ) ) );
}
add_action( 'wp_enqueue_scripts', 'react_max_scripts' );

add_theme_support( 'post-thumbnails' );

// Add various fields to the JSON output
function react_max_register_fields() {
	// Add Author Name
	register_rest_field( 'post',
		'author_name',
		array(
			'get_callback'		=> 'react_max_get_author_name',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
	// Add Featured Image
	register_rest_field( 'post',
		'featured_image_src',
		array(
			'get_callback'		=> 'react_max_get_image_src',
			'update_callback'	=> null,
			'schema'			=> null
		)
    );
    // Add Published Date
	register_rest_field( 'post',
        'published_date',
        array(
            'get_callback'		=> 'react_max_published_date',
            'update_callback'	=> null,
            'schema'			=> null
        )
	);
}
add_action( 'rest_api_init', 'react_max_register_fields' );

function react_max_get_author_name( $object, $field_name, $request ) {
	return get_the_author_meta( 'display_name' );
}
function react_max_get_image_src( $object, $field_name, $request ) {
    if($object[ 'featured_media' ] == 0) {
        return $object[ 'featured_media' ];
    }
	$feat_img_array = wp_get_attachment_image_src( $object[ 'featured_media' ], 'thumbnail', true );
    return $feat_img_array[0];
}
function react_max_published_date( $object, $field_name, $request ) {
	return get_the_time('F j, Y');
}

function react_max_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'react_max_excerpt_length' );