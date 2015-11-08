<?php
/**
 *  Bs custom post types class.
 */

namespace Bs;

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! class_exists( 'Bs\Types' ) ) {
        
    /**
	 * Bs_Types Class
	 *
	 */
	class Types {

        
        protected static $instance;
                
        /**
		 * Static Singleton Factory Method
		 * @return Types
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
            //$this->add_hooks();
		}
        
        public function register_post_types()
        {
			$this->register_post_type('Book', 'book', 'Books', 'page', NULL, true);
        }
        
        public function register_post_type($name, $slug, $label, $basic_type, $taxonomies, $is_hierarchical)
        {
            $supports = array('page-attributes', 'title', 'subtitles', 'editor', 'thumbnail', 'comments', 'excerpt', 'custom-fields', 'author', 'revisions', 'template');
            $taxonomies = array('category', 'post_tag');
            
            $args = array(
                'labels' => $this->get_labels($label, $name),
                'public' => true,
                'show_ui'=> true,
                'has_archive' => true,
                'hierarchical' => $is_hierarchical,
                'rewrite' => true,
                'query_var' => $slug,
                'supports' => $supports,
                'taxonomies' => $taxonomies,
                'capability_type' => $basic_type,
                
            );
            
            register_post_type($slug, $args);
        }
        
        protected function get_labels($label, $type)
        {
            $labels = array(
                'name'              => "{$label} ",
                'singular_name'     => "{$type}",
                'add_new_item'      => "Add New {$type}",
                'edit_item'         => "Edit {$type}",
                'new_item'          => "New {$type}",
                'view_item'         => "View {$type}",
                'search_items'      => "Search {$type}",
                'not_found'         => "No {$type} found",
                'not_found_in_trash'=> "No {$type} found in Trash",
                'menu_name'         => "{$label}"
            );
            
           // debug($labels);
            return $labels;   
        }
        
        public function register_taxonomies()
        {
           
            //$this->register_taxonomy('topics', 'Heleo Topic', 'Heleo Topics', array('post') );

        }

        public function register_taxonomy($slug, $singular, $plural, $types, $callback = '')
        {
            
            register_taxonomy(
                $slug,
                $types,
                array(
                    'hierarchical'          => false,
                    'labels'                => $this->get_tax_labels($singular, $plural),
                    'show_ui'               => true,
                    'show_admin_column'     => true,
                    'update_count_callback' => '',
                    'query_var'             => true,
                    'rewrite'               => array( 'slug' => $slug ),
                )
            );

        }
        
        public function get_tax_labels($singular, $plural)
        {
            
            $labels = array(
                'name'                       => _x( $plural, 'taxonomy general name' ),
                'singular_name'              => _x( $singular, 'taxonomy singular name' ),
                'search_items'               => __( 'Search ' . $plural ),
                'popular_items'              => __( 'Popular '. $plural ),
                'all_items'                  => __( 'All ' . $plural ),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __( 'Edit ' . $singular ),
                'update_item'                => __( 'Update ' . $singular ),
                'add_new_item'               => __( 'Add New ' . $singular ),
                'new_item_name'              => __( 'New ' . $singular ),
                'separate_items_with_commas' => __( 'Separate ' . strtolower($plural) . ' with commas' ),
                'add_or_remove_items'        => __( 'Add or remove ' . strtolower($plural) ),
                'choose_from_most_used'      => __( 'Choose from the most used ' . strtolower($plural) ),
                'not_found'                  => __( 'No ' . strtolower($plural) . ' found.' ),
                'menu_name'                  => __( $plural ),
            );
            
            return $labels;
        }
        
        
        
    }
    
}