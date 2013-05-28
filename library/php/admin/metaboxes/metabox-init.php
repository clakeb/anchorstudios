<?php
/**
 * Build Metaboxes
 *
 * @package  AnchorTheme
 * @category Admin
 * @author  Anchor Studios
 * @version 1.0.0
 * @since 1.0.0
 */

/**
 * Add metaboxes
 *
 * @return void
 */
function as_add_metaboxes() {

    // Portfolio project details
    add_meta_box(
        'as_project_details',
        'Project Details',
        'as_project_details_callback',
        'portfolio',
        'side'
    );

}
add_action( 'add_meta_boxes', 'as_add_metaboxes' );

/**
 * Project Details callback
 *
 * @return void
 */
function as_project_details_callback( $post ) {

    ob_start();
    ?>
        <label>
            Website URL
            <input type="text" name="as_project_details[url]">
        </label>
    <?php
    echo ob_get_clean();

}
