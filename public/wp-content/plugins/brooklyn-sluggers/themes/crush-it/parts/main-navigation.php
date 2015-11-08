
<nav>
	<ul class="navigation off-canvas-list" data-bind="fadeVisible: $root.show_nav">

		<li class="nav-item">
			<a href="javascript:void(0);" class="icon-close" data-bind="click: $root.toggleNav">X</a>
		</li>

	    	<?php

	    	$location = 'hamburger';

	    	 if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $location] ) ) :

				$menu 		= wp_get_nav_menu_object( $locations[ $location ] );
				$items 		= wp_get_nav_menu_items($menu->term_id);
				
				foreach($items as $item):

	    		?>
	    		
	    		<li class="nav-item">
	    			<a href="<?= $item->url; ?>">
	    			 	<span><?= $item->title; ?></span>
	    			 </a>
	    		</li>
	    		
	    		<?php 

	    		endforeach;
	    	endif;

	    	?>

	</ul>

</nav>

