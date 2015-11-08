<?php

use \Bs\Content;

$posts = Content::get_homepage_posts(7);

?>

<?php get_header(); ?>

<div class="home-feed row full-width-row collapse">

<?php foreach($posts as $post): setup_postdata($post); ?>
	
		<article <?php post_class('post'); ?>
			style="background: url('<?= Content::get_img_url(get_the_ID()); ?>') no-repeat center center;
			-webkit-background-size: cover;	
			-moz-background-size: cover;
			-o-background-size: cover;  
			background-size: cover;">

			<div class="post-content">
				<header class="feed-title">
					<h3><?= the_title(); ?></h3>

					<h4 class="description">
						<?= the_excerpt(); ?>
					</h4>
			</header>

				<!-- <div class="cta">
					Book Now
				</div>

				<div class="cta more">
					More
				</div> -->
			</div>

		</article>
	
<?php endforeach; wp_reset_postdata(); ?>


<!-- 
	<div class="columns small-12 medium-6">

		<article <?php post_class('post'); ?>
			style="background: url('<?= Content::get_img_url(16); ?>') no-repeat center center;
			-webkit-background-size: cover;	
			-moz-background-size: cover;
			-o-background-size: cover;  
			background-size: cover;">

			<div class="post-content">
				<header class="feed-title">
					<h3><?= get_the_title(16); ?></h3>

					<h4 class="description">
						Hitting. Pitching. Fielding.
					</h4>
				</header>

				<div class="cta">
					Book Now
				</div>

				<div class="cta more">
					More
				</div>
			</div>
		
		</article>
	</div>
</div>


<div class="home-feed row collapse">
	<div class="columns small-12">
		<article data-original="<?= Content::get_img_url(19); ?>" <?php post_class('post lazy'); ?>
			style="background: url('<?= get_template_directory_uri(); ?>/assets/bs/img/white.gif') no-repeat center center;
			-webkit-background-size: cover;	
			-moz-background-size: cover;
			-o-background-size: cover;  
			background-size: cover;">

			<div class="post-content">
				<header class="feed-title">
					<h3><?= get_the_title(19); ?></h3>

					<h4 class="description">
						Experienced. Supportive. Passionate.
					</h4>
			</header>

				<div class="cta">
					Book Now
				</div>

				<div class="cta more">
					More
				</div>
			</div>

		</article>

		
	</div>
</div>

<div class="home-feed row collapse">
	<div class="columns small-12">
		<article data-original="<?= Content::get_img_url(22); ?>" <?php post_class('post lazy'); ?>
			style="background: url('<?= get_template_directory_uri(); ?>/assets/bs/img/white.gif') no-repeat center center;
			-webkit-background-size: cover;	
			-moz-background-size: cover;
			-o-background-size: cover;  
			background-size: cover;">

			<div class="post-content">
				<header class="feed-title">
					<h3><?= get_the_title(22); ?></h3>

					<h4 class="description">
						Hitting. Conditioning. Instruction.
					</h4>
			</header>

				<div class="cta">
					Book Now
				</div>

				<div class="cta more">
					More
				</div>
			</div>

		</article>

		
	</div>
</div>

<div class="home-feed row collapse">
	<div class="columns small-12">
		<article data-original="<?= Content::get_img_url(28); ?>" <?php post_class('post lazy'); ?>
			style="background: url('<?= get_template_directory_uri(); ?>/assets/bs/img/white.gif') no-repeat center center;
			-webkit-background-size: cover;	
			-moz-background-size: cover;
			-o-background-size: cover;  
			background-size: cover;">

			<div class="post-content">
				<header class="feed-title">
					<h3><?= get_the_title(28); ?></h3>

					<h4 class="description">
						Hitting. Conditioning. Instruction.
					</h4>
			</header>

				<div class="cta">
					Book Now
				</div>

				<div class="cta more">
					More
				</div>
			</div>

		</article>

		
	</div>
</div>

<div class="home-feed row collapse">
	<div class="columns small-12">
		<article data-original="<?= Content::get_img_url(31); ?>" <?php post_class('post lazy'); ?>
			style="background: url('<?= get_template_directory_uri(); ?>/assets/bs/img/white.gif') no-repeat center center;
			-webkit-background-size: cover;	
			-moz-background-size: cover;
			-o-background-size: cover;  
			background-size: cover;">

			<div class="post-content">
				<header class="feed-title">
					<h3><?= get_the_title(31); ?></h3>

					<h4 class="description">
						Games. Food. Fun.
					</h4>
			</header>

				<div class="cta">
					Book Now
				</div>

				<div class="cta more">
					More
				</div>
			</div>

		</article>

		
	</div>
</div>

<div class="home-feed row collapse">
	<div class="columns small-12">
		<article data-original="<?= Content::get_img_url(34); ?>" <?php post_class('post lazy'); ?>
			style="background: url('<?= get_template_directory_uri(); ?>/assets/bs/img/white.gif') no-repeat center center;
			-webkit-background-size: cover;	
			-moz-background-size: cover;
			-o-background-size: cover;  
			background-size: cover;">

			<div class="post-content">
				<header class="feed-title">
					<h3><?= get_the_title(34); ?></h3>

					<h4 class="description">
						Achieve Your Dreams.
					</h4>
			</header>

				<div class="cta">
					Book Now
				</div>

				<div class="cta more">
					More
				</div>
			</div>

		</article>

		
	</div>
</div>

 -->




<?php get_footer(); ?>