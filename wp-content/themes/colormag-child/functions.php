<?php
/*Questo file è parte di colormag-child, colormag child theme.

Tutte le funzioni di questo file saranno caricate prima delle funzioni del tema genitore.
Per saperne di più https://codex.wordpress.org/Child_Themes.

Nota: questa funzione carica prima il foglio di stile genitore, poi il foglio di stile figlio
(non toccare se non sai cosa stai facendo)
*/

if ( ! function_exists( 'suffice_child_enqueue_child_styles' ) ) {
	function colormag_child_enqueue_child_styles() {
	    // loading parent style
	    wp_register_style(
	      'parente2-style',
	      get_template_directory_uri() . '/style.css'
	    );

	    wp_enqueue_style( 'parente2-style' );
	    // loading child style
	    wp_register_style(
	      'childe2-style',
	      get_stylesheet_directory_uri() . '/style.css'
	    );
	    wp_enqueue_style( 'childe2-style');
	 }
}
add_action( 'wp_enqueue_scripts', 'colormag_child_enqueue_child_styles' );

/*Scrivi qui le tue funzioni */


// well-known filter to change JPG quality:
add_filter( 'jpeg_quality', function( $arg ){ return 100; } );

// lesser-known filter to change quality for any image type:
add_filter( 'wp_editor_set_quality', 'any_image_quality', 10, 2 );
add_filter( 'jpeg_quality', 'any_image_quality' );

function any_image_quality( $default_quality, $mime_type = NULL ) {
  // you could do if ( 'image/png' == $mime_type ) here if you want to be specific
  return 100;
}













/*

// usa contenuto al posto del riassunto

add_filter( 'get_the_excerpt', 'wp256_use_content_as_excerpt', 10, 2 );
function wp256_use_content_as_excerpt( $excerpt, $post ) {
    return wp_strip_all_tags( $post->post_content );
}

// abilita link nel riassunto

// Allow links in excerpts
function sg_trim_words( $text, $num_words, $more, $original_text ) {
    $text = strip_tags( $original_text, '' );
    // @See wp_trim_words in wp-includes/formatting.php
    if ( strpos( _x( 'words', 'Word count type. Do not translate!' ), 'characters' ) === 0 && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
        $text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
        preg_match_all( '/./u', $text, $words_array );
        $words_array = array_slice( $words_array[0], 0, $num_words + 1 );
        $sep = '';
    } else {
        $words_array = preg_split( "/[\n\r\t ]+/", $text, $num_words + 1, PREG_SPLIT_NO_EMPTY );
        $sep = ' ';
    }
    if ( count( $words_array ) > $num_words ) {
        array_pop( $words_array );
        $text = implode( $sep, $words_array );
        $text = $text . $more;
    } else {
        $text = implode( $sep, $words_array );
    }
    // Remove self so we don't affect other functions that use wp_trim_words
    remove_filter( 'wp_trim_words', 'sg_trim_words' );
    return $text;
}
// Be sneaky: add our wp_trim_words filter during excerpt_more filter, which is called immediately prior
function sg_add_trim_words_filter( $excerpt_length ) {
    add_filter( 'wp_trim_words', 'sg_trim_words', 10, 4 );
    return $excerpt_length;
}
add_filter( 'excerpt_more', 'sg_add_trim_words_filter', 1 );*/
