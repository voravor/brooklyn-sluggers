<?php

use \Helium\Content;

$social_cta	= get_post_meta(get_the_ID(), 'social-cta', true);
$attachment = get_post(get_post_thumbnail_id());

?>

<?php get_header('single'); ?>


<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

		
		<?php get_template_part('parts/post', 'topbar'); ?>
		
		<?php get_template_part('parts/post', 'dropdown'); ?>
		
		<div class="topbar-share hide-topbar-share">
			<?php get_template_part('parts/post', 'share'); ?>
		</div>

		<div class="content-container">
			<header class="post-header">
				<div class="row">
					<div class="columns large-11 large-offset-1 medium-11 medium-offset-1 small-12 small-centered">

						<?php //get_template_part('parts/post', 'influencer-quote'); ?>

						<h1 class="post-title"><?php the_title(); ?></h1>

						<div class="row">
							<div class="columns post-subtitle hide-for-small">
								<?= the_excerpt(); ?>
							</div>
						</div>

						<div class="row">
							<div class="columns large-4 medium-4 small-12">
								<?php get_template_part('parts/post', 'meta'); ?>
							</div>
						</div>

					</div>
				</div>

				<div class="row single-stats">

					<?php get_template_part('parts/post', 'social-stats'); ?>

					<div class="post-share">
						<?php get_template_part('parts/post', 'share'); ?>
					</div>

				</div>

			</header>

			<div class="post-content">


				<?php if ( has_post_thumbnail() ): ?>
				<div class="full-width-row main-photo" >
					<a id="share-waypoint"></a>
					<img data-original="<?= Content::get_img_url(get_the_ID(), 'full'); ?>" class="lazy" src="<?= get_template_directory_uri(); ?>/assets/helium/img/white.gif" />
				</div>

				<?php if(false): ?>
				<div class="photo-caption right">
					<?= $attachment->post_excerpt; ?>
				</div>
				<?php endif; ?>
				<?php endif; ?>

				<div class="row full-width-row collapse" data-equalizer>
					<div class="pullquote columns large-4 show-for-large-only" data-equalizer-watch>
						<div class=""><?= Content::get_pullquote(get_the_ID()); ?></div>
					</div>

					<div class="post-body columns large-4 medium-8 small-12" data-equalizer-watch>

						<?php the_content(); ?>

						<?php get_template_part('parts/post', 'in-brief'); ?>

						<div class="row">
							<div class="columns large-12 social-cta text-center ">
								<?= $social_cta; ?>
							</div>
						</div>
					</div>

					<div class="sidebar columns large-4 medium-4">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>

		</div>


		<footer class="post-footer">

			<div class="row full-width-row">

				<div class="columns large-12 medium-8 text-center">
					<a id="share-waypoint-bottom"></a>
					<?php get_template_part('parts/post', 'share'); ?>
				</div>

			</div>

			<?php get_template_part('parts/post', 'bottom-hero'); ?>

			<!--scrolling to here triggers potential READ to Wizard -->
			<a id="read-waypoint"></a>

			<a id="share-waypoint-bottom-off"></a>

			<?php get_template_part('parts/post', 'recommended'); ?>

			<div class="masthead-container">
				<?php get_template_part('parts/masthead'); ?>
			</div>

		</footer>
		
<?php if(false): ?>
<pre data-bind="text: ko.toJSON($data, null, 2)"></pre>
<?php endif; ?>

	</article>
<?php endwhile;?>

<?php get_footer('mini'); ?>
