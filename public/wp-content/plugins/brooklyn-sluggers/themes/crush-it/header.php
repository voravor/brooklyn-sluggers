<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php if ( is_category() ) {
			echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_tag() ) {
			echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_archive() ) {
			wp_title(''); echo '  | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo 'Search for &quot;'.esc_html($s).'&quot; | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) {
			bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
		}  elseif ( is_404() ) {
			echo 'Error 404 Not Found | '; bloginfo( 'name' );
		} elseif ( is_single() ) {
			wp_title('');
		} else {
			echo wp_title( ' | ', 'false', 'right' ); bloginfo( 'name' );
		} ?></title>
		
		<link href='https://fonts.googleapis.com/css?family=Ubuntu:200,300,400,700,300italic' rel='stylesheet' type='text/css'>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

	<?php get_template_part('parts/main-navigation'); ?>
	
	<div class="site-wrap" role="document">
		<div class="dim-body" data-bind="click: $root.toggleNav, fadeVisible: $root.show_nav"></div>

		<div class="fixed">

			<div class="tab-bar" data-bind="css: {'topbar-scrolled': $root.is_scrolled, '': $root.is_scrolled() == false}">
				
				<div class="hamburger" data-bind="click: $root.toggleNav">
					<span></span>
					<span></span>
					<span></span>
				</div>

				<section class="logo">
					<a href="<?php echo esc_url(home_url('/')); ?>">
					</a>
					<h3>Brooklyn Sluggers Logo</h3>
					<div class="tagline">Crush it!</div>
				</section>

				<?php get_template_part('parts/topbar-social'); ?>
				
			</div>
		</div>
		<div class="unfixed">
		</div>

		<a id="topbar-waypoint"></a>
	