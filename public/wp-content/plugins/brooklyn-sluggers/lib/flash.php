<?php
/**
 *  Bs Flash Messages - WP ADMIN class.
 *
 *  Simple Admin Flash Messages
 *
 *  
 */

namespace Bs;

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! class_exists( 'Bs\Flash' ) ) {
        
    /**
	 * Bs Flash
	 *
	 */ 
	class Flash {
        
        protected $data;
        protected static $instance;
        
        private $option_name;
        private $class = 'updated notice notice-success is-dismissible';
        
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
        
        private function init()
        {
			
            global $current_user;
            
            $user_id = $current_user->ID;
            $this->option_name = 'wp_flash_messages_' . $user_id;
            
            add_action('admin_notices', array($this, 'show'));

        }
        
        //Flash Messages
        public function message($message)
        {
  
            $flash_messages = maybe_unserialize(get_option($this->option_name, array()));
            $flash_messages[$this->class][] = $message;
            update_option($this->option_name, $flash_messages);
        }
        
        public function show()
        {
			
            $flash_messages = maybe_unserialize(get_option($this->option_name, ''));
            if(is_array($flash_messages)) {
                foreach($flash_messages as $class => $messages) {
                    foreach($messages as $message) {
						//\debug($message);
                        ?><div class="<?php echo $class; ?>"><p><?php  echo $message; ?></p></div><?php
                    }
                }
            }
            //clear flash messages
            delete_option($this->option_name);
        }
        
        

		

    }
    
}

