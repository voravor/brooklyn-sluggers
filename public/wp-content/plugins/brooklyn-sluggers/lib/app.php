<?php
/**
 * Main Brookly Sluggers class.
 */

namespace Bs;


// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
 * Bs\App:
 * singleton class for loading up main application functionality
 * - initialization
 * - hooks
 * - libs
 * - loading/enqueing styles/js
 * - loading theme and servicing it
 *
 */

if ( ! class_exists( 'Bs\App' ) ) {

    /**
	 * Bs App
	 *
	 */
	class App {

		const VERSION             = '0.0.1';

        public $name        = "Bs";

        /**
		 * Notices to be displayed in the admin
		 * @var array
		 */
		protected $notices = array();

        //needed for path manipulation
        public $plugin_dir;
		public $plugin_path;
		public $plugin_url;
		public $plugin_name;

        protected static $instance;
		protected static $flash;
		protected static $user;
		protected static $content;

        /**
		 * Static Singleton Factory Method
		 * @return App
		 */
		public static function instance()
        {
			if ( ! isset( self::$instance ) ) {
				$className      = __CLASS__;
				self::$instance = new $className;
			}

			return self::$instance;
		}

        /**
		 * Initializes plugin variables and sets up WordPress hooks/actions.
		 */
		protected function __construct()
        {
			$this->plugin_path = trailingslashit( dirname( dirname( __FILE__ ) ) );
			$this->plugin_dir  = trailingslashit( basename( $this->plugin_path ) );
			$this->plugin_url  = plugins_url( $this->plugin_dir );

            $this->register_theme_directory();
			//debug('hi');
			self::$user		 	= User::instance();
			self::$content		= Content::instance();

			//self::$flash = Flash::instance();

			add_action( 'init', array( $this, 'load_text_domain' ), 1 );

			$this->add_hooks();

		}


        /* void, no args
         * called when plugin is activated
         *
         * @return void
         */
        public function install()
        {
            \debug( "install");
        }

        /* void, no args
         * called when plugin is de-activated
         * useful for cleanup
         */
        public function uninstall()
        {
            \debug("uninstall");
        }

        /**
		 * Load the text domain. Not utilized yet...
		 * Text domains: for i18n/l10n
		 *
		 * @return void
		 */
		public function load_text_domain()
        {
			load_plugin_textdomain( 'helium', false, $this->plugin_dir . 'lang/' );
		}

        /* void, no args
         * just returns the file path to this plugin
         *
         * @return void
         */
        public function get_plugin_path()
        {
            return $this->plugin_path;
        }

		public function get_plugin_url()
		{
			return $this->plugin_url;
		}

        /**
		 * Add filters and actions, all in one place
		 * If you add more filters/actions, put them here for cleanliness
		 * void, no args
		 *
		 * @return void
		 */
		protected function add_hooks()
        {
			add_action( 'init', array( $this, 'init' ), 10 );
			
            //styles and js
            add_action('wp_head', array($this, 'head') );

            add_action( 'admin_enqueue_scripts', array($this, 'scripts') );

            //add favicon to admin - fixes an annoyance
            add_action( 'admin_head', array($this, 'add_favicon'));
            add_action( 'admin_head', array($this, 'admin_head'));

        }

        

        /* void, no args
         * add some js to admin head
         * @return void
        */
        public function admin_head() 
        {

            
        }
        /*
         * void, no args
         * fixes broken favicon in admin when using custom wp location
         *
         * @return void
         */
        public function add_favicon()
        {
          //  $favicon_url = get_template_directory_uri() . '/assets/img/icons/favicon.ico?v=' . filemtime(get_template_directory() . '/assets/img/icons/favicon.ico');
          //  echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
        }

        /* Init, called in wp init hook
         * void, no args
         *
         * sets up data types, e.g., post types and taxonomies
         *
         */
        public function init()
        {
            $this->plugin_name = __( 'Bs', 'bs' );

            //Custom data definitions
            //uses Types singleton, q.v.

            //custom post types - the only one so far is "Best Sellers",
            //but you may not need that particular one
            Types::instance()->register_post_types();

            //use if you have the need for custom taxonomies
            Types::instance()->register_taxonomies();

			//disable emojis
			// remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			// remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			// remove_action( 'wp_print_styles', 'print_emoji_styles' );
			// remove_action( 'admin_print_styles', 'print_emoji_styles' );
			// remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
			// remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
			// remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
			// add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );

        }

        /* void, no args
         * defines custom theme location as a child directory of this plugin
         * tricky: modify at your own risk!
         *
         * @return void
         */
        public function register_theme_directory()
        {
			global $wp_theme_directories;

			// Allow registration of other theme directories or moving the CoursePress theme.
			$theme_directories = apply_filters( 'bs_theme_directory_array', array(
				$this->get_plugin_path() . 'themes', ABSPATH . 'wp-content/themes'
                )
			);

            //diebug($this->get_plugin_path());
			foreach ( $theme_directories as $theme_directory ) {
				register_theme_directory( $theme_directory );
			}

		}

       
       
        public function head()
        {

            switch(ENVIRONMENT) {

                case 'development':
                    //use local copy
                    $path = get_template_directory_uri();
                  //  $path = str_replace(WP_HOME, CDN_MISC_URL, get_template_directory_uri());
					$debug = true;
					break;

                case 'staging':
					$path = str_replace(WP_HOME, CDN_MISC_URL, get_template_directory_uri());
					$debug = true;
					break;

                case 'qa':

                case 'production':
                    //use cdn version
                    $path = str_replace(WP_HOME, CDN_MISC_URL, get_template_directory_uri());
					$debug = true;
                    break;

                default:
                    $path = get_template_directory_uri();

            }

            ?>

            <!--favicons -->


            <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-57x57.png">
            <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-60x60.png">
            <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-72x72.png">
            <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-76x76.png">
            <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-114x114.png">
            <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-120x120.png">
            <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-144x144.png">
            <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-152x152.png">
            <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-180x180.png">
            <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $path ; ?>/assets/img/icons/android-icon-192x192.png">
            <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $path ; ?>/assets/img/icons/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $path ; ?>/assets/img/icons/favicon-96x96.png">
            <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $path ; ?>/assets/img/icons/favicon-16x16.png">
            <link rel="manifest" href="/manifest.json">
            <meta name="msapplication-TileColor" content="#ffffff">
            <meta name="msapplication-TileImage" content="<?php echo $path ; ?>/assets/img/icons/ms-icon-144x144.png">
            <meta name="theme-color" content="#ffffff">
          <!--   <link rel="icon" href="<?php echo $path ; ?>/assets/img/icons/favicon.ico?v=<?= filemtime(get_template_directory() . '/assets/img/icons/favicon.ico') ?>" type="image/x-icon">
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-144x144.png?v=<?= filemtime(get_template_directory() . '/assets/img/icons/apple-icon-144x144.png') ?>">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-114x114.png?v=<?= filemtime(get_template_directory() . '/assets/img/icons/apple-icon-114x114.png') ?>">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-72x72.png?v=<?= filemtime(get_template_directory() . '/assets/img/icons/apple-icon-72x72.png') ?>">
            <link rel="apple-touch-icon-precomposed" href="<?php echo $path ; ?>/assets/img/icons/apple-icon-precomposed.png?v=<?= filemtime(get_template_directory() . '/assets/img/icons/apple-icon-precomposed.png') ?>">
 -->
			<script>
				DEBUG = <?= $debug ? 'true': 'false'; ?>;
			</script>
			<?php

        }

       
        public function scripts() 
        {
          //  wp_enqueue_style ('admin_css', App::instance()->get_plugin_url() . 'includes/css/styles.css', false, filemtime(App::instance()->get_plugin_path() . 'includes/css/styles.css') );
            
         //   wp_enqueue_script('jquery-ui');
         //   wp_enqueue_script('jquery-ui-autocomplete');
         //   wp_enqueue_script('ko', get_template_directory_uri() . '/js/vendor/knockout/dist/knockout.js');
         //   wp_enqueue_script('ko-auto', get_template_directory_uri() . '/js/vendor/knockout-jqAutocomplete/build/knockout-jqAutocomplete.min.js', array('ko'));

        }


    }

}
