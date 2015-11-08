<?php
/**
 *  Bs User 
 *
 *  
 */

namespace Bs;

require_once VENDOR_PATH . '/autoload.php';

use \Guzzle\Http\Client;

use Rhumsaa\Uuid\Uuid;
use Rhumsaa\Uuid\Exception\UnsatisfiedDependencyException;

use \Exception;

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! class_exists( 'Bs\User' ) ) {
        
    /**
	 * Bs User
	 *
	 */ 
	class User {

		private static $endpoint;
		
        protected static $instance;
		protected $flash;
        
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
			$this->flash = Flash::instance();
            

             
        }
		
		

        

    }
    
}

