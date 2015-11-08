<?php
/**
 *  Brookly Sluggers content class.
 */

namespace Bs;

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! class_exists( 'Bs\Content' ) ) {

    /**
	 * Bs Content
	 *
	 */
	class Content {


        protected static $instance;


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
		public function __construct()
        {
			$this->init();
		}

		public function init()
		{
			add_post_type_support( 'post', 'page-attributes' );

		}

		public function get_img_url($post_id, $size='full')
		{

			$attachment_id 	= get_post_thumbnail_id($post_id);
            $thumbnail 		= wp_get_attachment_image_src($attachment_id, $size);
            $url 			= $thumbnail[0];

			return $url;

		}

 		public function get_homepage_posts($numberposts = 6)
 		{

 			$args = array(
 				'orderby' => 'menu_order',
 				'order' => 'ASC',
 				'numberposts' => $numberposts
 			);

 			$posts = get_posts($args);

 			return $posts;

 		}

    }

}
