<?php
/**
 * Portfolio Archive Template
 *
 * @author Anchor Studios
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @package Template
 * @category Core
 */

/**
 * Filter post classes
 *
 * Adds portfolio-archive class
 *
 * @return array $classes An array of post classes
 */
function as_portfolio_classes( $classes ) {

    $classes[] = 'portfolio-archive';

    return $classes;

}
add_filter( 'post_class','as_portfolio_classes', 10, 1 );

// Remove post info
remove_action( 'genesis_before_post_content', 'genesis_post_info' );

/**
 * Add featured image
 *
 * @return void
 */
function as_portfolio_featured_image() {
    global $post;
    echo '<a href="' . get_permalink( $post->ID ) . '">';
        echo '<div class="portfolio-image">';
            the_post_thumbnail( 'portfolio' );
        echo '</div>';
    echo '</a>';
}
add_action( 'genesis_post_content', 'as_portfolio_featured_image' );

// Remove post content
remove_action( 'genesis_post_content', 'genesis_do_post_content' );

// Remove post meta
function as_portfolio_post_meta() {
    global $post;
    ob_start();
        the_terms( $post->ID, 'project-type', 'Project Type: ', ', ', '' );
    return ob_get_clean();
}
add_filter( 'genesis_post_meta', 'as_portfolio_post_meta', 10 );

genesis();
