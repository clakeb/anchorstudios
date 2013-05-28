<?php
/**
 * Admin functions
 *
 * @package  AnchorTheme
 * @category Admin
 * @author  Anchor Studios
 * @version 1.0.0
 * @since 1.0.0
 */


/**
 * Admin init function
 *
 * @return void
 */
function as_admin_init() {

    // Build metaboxes
    include_once( 'metaboxes/metabox-init.php' );
}
add_action( 'admin_init', 'as_admin_init' );
