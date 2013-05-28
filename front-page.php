<?php
/**
 * Front Page functions
 *
 * @package  AnchorTheme
 * @category Template
 * @author  Anchor Studios
 * @version 1.0.0
 * @since 1.0.0
 */

/**
 * Front Page Loop
 *
 * @return void
 */
function as_front_page_loop() {
    global $loop_counter;

    // Reset the counter;
    $loop_counter = 0;

    // Original Loop ( without the post_title )
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            ?>
            <div class="row collapse home-section home-caption">
                <?php do_action( 'genesis_before_post' ); ?>
                <div <?php post_class( array( 'row collapse' ) ); ?>>
                    <?php do_action( 'genesis_before_post_title' ); ?>
                    <?php do_action( 'genesis_after_post_title' ); ?>
                    <?php do_action( 'genesis_before_post_content' ); ?>

                    <div class="entry-content">
                        <?php do_action( 'genesis_post_content' ); ?>
                    </div><!-- end .entry-content -->

                </div><!-- end .postclass -->
                <?php do_action( 'genesis_after_post' ); ?>
            </div>

            <?php
            $loop_counter++;

        endwhile;
        do_action( 'genesis_after_endwhile' );
    endif;

    // Home Sections loop
    $args = array(
        'post_type'      => 'home_section',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    );

    $home_query = new WP_Query( $args );

    // Reset the counter;
    $loop_counter = 0;

    if ( $home_query->have_posts() ) :
        while ( $home_query->have_posts() ) : $home_query->the_post();
            ?>
            <div class="row collapse home-section service">
                <?php do_action( 'genesis_before_post' ); ?>
                <div <?php post_class( array( 'row collapse' ) ); ?>>
                    <div class="small-4 columns featured-image">
                        <?php the_post_thumbnail( 'medium' ); ?>
                    </div>
                    <div class="small-10 columns home-section-content">
                        <?php do_action( 'genesis_post_title' ); ?>
                        <div class="entry-content">
                            <?php do_action( 'genesis_post_content' ); ?>
                        </div><!-- end .entry-content -->
                    </div>
                </div><!-- end .postclass -->
                <?php do_action( 'genesis_after_post' ); ?>
            </div>

            <?php
            $loop_counter++;

        endwhile;
        do_action( 'genesis_after_endwhile' );
    endif;

    ?>
    <div id="contact" class="row collapse home-section">
        <h2 class="small-12 columns">Contact</h2>
        <div class="small-12 columns small-centered large-7">
            <?php echo do_shortcode( '[formidable id=2]' ); ?>
        </div>
    </div>
    <?php
}
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'as_front_page_loop' );

genesis();
