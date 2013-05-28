<?php
/**
 * Anchor Studios Theme
 *
 * @author Anchor Studios
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 * @package AnchorTheme
 * @category Core
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Save some memory, bro!
if ( ! class_exists( 'Anchor_Studios' ) ) {

/**
 * Anchor_Studios
 */
class Anchor_Studios {

    /**
     * The theme's version
     *
     * @access public
     * @var string
     */
    public $version = '2.0';

    /**
     * The theme's path (without a trailing slash)
     *
     * @access public
     * @var string
     */
    public $theme_path;

    /**
     * The theme's url (without a trailing slash)
     *
     * @access public
     * @var string
     */
    public $theme_url;

    /**
     * The theme's options
     *
     * @access public
     * @var array
     */
    public $options;

    /**
     * Class Anchor_Studios Constructor
     *
     * @access public
     * @return void
     */
    public function __construct() {

        // Auto-load classes on demand
        if ( function_exists( "__autoload" ) ) {
            spl_autoload_register( "__autoload" );
        }
        spl_autoload_register( array( $this, 'autoload' ) );

        // Define version constant
        define( 'ANCHOR_THEME_VERSION', $this->version );

        // Define child theme constants
        define( 'CHILD_THEME_NAME', 'Anchor Studios' );
        define( 'CHILD_THEME_URL', 'http://anchor.is/' );

        // Activation
        add_action( 'after_switch_theme', array( $this, 'activate' ), 10, 2 );

        // Deactivation
        add_action( 'switch_theme', array( $this, 'deactivate' ), 10, 2 );

        // Load Stratum
        add_action( 'genesis_setup', array( $this, 'init' ) );

        // Load action
        do_action( 'as_loaded' );
    }

    /**
     * Initialize Stratum
     *
     * @access public
     * @return void
     */
    public function init() {

        // Do pre-init action
        do_action( 'as_before_init' );

        // Dependencies
        $this->dependencies();

        // Register taxonomies
        $this->register_taxonomies();

        // Register post types
        $this->register_post_types();

        // Add/remove image sizes
        $this->configure_images();

        // Do init action
        do_action( 'as_init' );
    }

    /**
     * Theme activation function
     *
     * @access public
     * @return void
     */
    public function activate( $oldname, $oldtheme = false ) {

    }

    /**
     * Theme deactivation function
     *
     * @access public
     * @return void
     */
    public function deactivate( $newname, $newtheme ) {

    }

    /**
     * Auto-load plugin classes
     *
     * Saves on memory consumption
     *
     * @access public
     * @param mixed $class
     * @return void
     */
    public function autoload( $class ) {

        $class = strtolower( $class );

        if ( strpos( $class, 'as_' ) === 0 ) {

            $path = $this->theme_path() . '/library/php/classes/';
            $file = 'class-' . str_replace( '_', '-', $class ) . '.php';

            if ( is_readable( $path . $file ) ) {

                include_once( $path . $file );
                return;
            }
        }
    }

    /**
     * Get the theme's url
     *
     * @access public
     * @return string
     */
    public function theme_url() {

        if ( $this->theme_url ) return $this->theme_url;

        return $this->theme_url = get_stylesheet_uri();
    }

    /**
     * Get the theme's path
     *
     * @access public
     * @return string
     */
    public function theme_path() {

        if ( $this->theme_path ) return $this->theme_path;

        return $this->theme_path = get_stylesheet_directory();
    }

    /**
     * Include dependencies
     *
     * Example: Scripts, Styles, return value functions, libraries, etc.
     *
     * @access public
     * @return string
     */
    public function dependencies() {
        if ( is_admin() ) {
            include_once( 'library/php/admin/admin-init.php' );
        } else {
            include_once( 'library/php/frontend/frontend-init.php' );
        }
    }

    /**
     * Register post types
     *
     * @access public
     * @return string
     */
    public function register_post_types() {

        // Home Sections
        register_post_type(
            'home_section',
            array(
                'labels' => array(
                    'name'               => 'Home Sections',
                    'singular_name'      => 'Home Section',
                    'add_new'            => 'Add New',
                    'add_new_item'       => 'Add New Home Section',
                    'edit_item'          => 'Edit Home Section',
                    'new_item'           => 'New Home Section',
                    'all_items'          => 'All Home Sections',
                    'view_item'          => 'View Home Section',
                    'search_items'       => 'Search Home Sections',
                    'not_found'          => 'No Home Sections found',
                    'not_found_in_trash' => 'No Home Sections found in Trash',
                    'parent_item_colon'  => '',
                    'menu_name'          => 'Home Sections'
                ),
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'book' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array(
                    'title',
                    'editor',
                    'thumbnail',
                    'excerpt',
                    'page-attributes'
                )
            )
        );

        // Portfolio
        register_post_type(
            'portfolio',
            array(
                'labels'             => array(
                    'name'               => 'Portfolio',
                    'singular_name'      => 'Project',
                    'add_new'            => 'Add New',
                    'add_new_item'       => 'Add New Project',
                    'edit_item'          => 'Edit Project',
                    'new_item'           => 'New Project',
                    'all_items'          => 'All Projects',
                    'view_item'          => 'View Project',
                    'search_items'       => 'Search Portfolio',
                    'not_found'          => 'No Projects found',
                    'not_found_in_trash' => 'No Projects found in Trash',
                    'parent_item_colon'  => '',
                    'menu_name'          => 'Portfolio'
                ),
                'public'              => true,
                'publicly_queryable'  => true,
                'exclude_from_search' => true,
                'show_ui'             => true,
                'query_var'           => true,
                'rewrite'             => true,
                'capability_type'     => 'post',
                'has_archive'         => true,
                'hierarchical'        => false,
                'supports'            => array(
                    'title',
                    'editor',
                    'thumbnail',
                    'excerpt',
                )
            )
        );
    }

    /**
     * Register taxonomies
     *
     * @access public
     * @return string
     */
    public function register_taxonomies() {

        // Project Types
        register_taxonomy(
            'project-type',
            'portfolio',
            array(
                'labels' => array(
                    'name'          => 'Project Types',
                    'singular_name' => 'Project Type',
                    'search_items'  => 'Search Project Types',
                    'all_items'     => 'All Project Types',
                    'edit_item'     => 'Edit Project Type',
                    'update_item'   => 'Update Project Type',
                    'add_new_item'  => 'Add New Project Type',
                    'new_item_name' => 'New Project Type Name',
                    'menu_name'     => 'Project Types',
                ),
                'hierarchical' => false,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array( 'slug' => 'project-type' )
            )
        );
    }

    /**
     * Add or remove image sizes
     *
     * @access public
     * @return void
     */
    public function configure_images() {
        add_image_size( 'portfolio', 600, 350, TRUE );
    }
}

/**
 * Initializes the theme and stores the object
 *
 * @global Anchor_Studios $_GLOBALS['anchorstudios']
 * @name $anchorstudios
 */
$GLOBALS[ 'anchorstudios' ] = new Anchor_Studios;

}
