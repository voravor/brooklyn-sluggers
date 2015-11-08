<nav>
	<ul>


	<?php

	$location = 'footer';

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
