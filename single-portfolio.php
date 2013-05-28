<?php
/**
 * Single Portfolio
 *
 * @author Anchor Studios
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @package Template
 * @category Core
 */

// Remove post info
remove_action( 'genesis_before_post_content', 'genesis_post_info' );

// Add featuered image
function as_portfolio_featured_image() {
    the_post_thumbnail( 'full' );
}
add_action( 'genesis_before_post_content', 'as_portfolio_featured_image' );

// Filter post meta
function as_portfolio_post_meta() {
    global $post;
    ob_start();
        the_terms( $post->ID, 'project-type', 'Project Type: ', ', ', '' );
    return ob_get_clean();
}
add_filter( 'genesis_post_meta', 'as_portfolio_post_meta', 10 );

genesis();
