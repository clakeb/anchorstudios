<?php
/**
 * Frontend functions
 *
 * @package AnchorTheme
 * @category Frontend
 * @author  Anchor Studios
 * @version 1.0.0
 * @since 1.0.0
 */

/**
 * Frontend init function
 *
 * @return void
 */
function as_frontend_init() {

    // Remove edit post link
    add_filter ( 'genesis_edit_post_link' , '__return_false' );

}
add_action( 'genesis_before', 'as_frontend_init' );

/**
 * Recover site title ( for front_page )
 *
 * @return string The path to the child theme's stylesheet
 */
function as_seo_title( $inside, $wrap ) {

    // Lowercase the site title
    $custom_title = '<span class="anchor-span">anchor</span><span class="studios-span">studios</span>';
    $inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $custom_title );

    // Determine which wrapping tags to use
    $wrap = ( is_home() || is_front_page() ) && 'title' == genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';

    // Build the Title
    return $title = sprintf( '<%s id="title">%s</%s>', $wrap, $inside, $wrap );

}
add_filter( 'genesis_seo_title', 'as_seo_title', 10, 2 );

/**
 * Replace default stylesheet
 *
 * @return string The path to the child theme's stylesheet
 */
function as_replace_stylesheet() {

    return CHILD_URL . '/library/css/frontend.css';

}
add_filter( 'stylesheet_uri', 'as_replace_stylesheet', 10, 2 );

/**
 * Force site layout
 *
 * @return string The string indicating which layout to force
 */
function as_site_layout( $opt ) {

    return 'full-width-content';

}
add_filter( 'genesis_pre_get_option_site_layout', 'as_site_layout' );

/**
 * Customize the Footer
 *
 * @return string The HTML to output
 */
function as_footer_output( $backtotop_text, $creds_text ) {

    return '<div class="creds"><p>Proudly made with WordPress.</p></div>';

}
add_filter( 'genesis_footer_output', 'as_footer_output', 10, 2 );
