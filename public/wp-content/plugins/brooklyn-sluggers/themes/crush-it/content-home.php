<?php 

use \Helium\Content; 
use \Helium\Influencer;

$influencer_id 	= get_post_meta(get_the_ID(), 'influencer_id', true);
$influencer 	= Influencer::get_influencer($influencer_id);

?>

<article id="post-<?php the_ID(); ?>" data-original="<?= Content::get_img_url(get_the_ID()); ?>" <?php post_class('post lazy'); ?>
		style="background: url('<?= get_template_directory_uri(); ?>/assets/helium/img/white.gif') no-repeat center center;-webkit-background-size: cover;	-moz-background-size: cover;
		-o-background-size: cover;  
		background-size: cover;">
	
	<div class="post-content">

		<header class="feed-title">
			<h2>
				<a href="<?php the_permalink(); ?>" class="feed-item-hed"><?= Content::title(get_the_title(), 50); ?></a>
			</h2>
			
			
			<h3>
				<div class="feed-item-dek hide-for-small"><?= the_excerpt(); ?></div>
			</h3>
		
			
			<div class="row hide">
				<div class="columns large-12 large-centered medium-12 medium-centered">
					<a class="read-more hvr-ripple-out" href="<?php the_permalink(); ?>">Read More</a>
				</div>
			</div>
			
		</header>

		<footer class="full-width-row">
			
			<div class="columns small-6 feed-shares social-stats ">
				<div class="social-share-count"></div>
			</div>

			<?php if($influencer_id): ?>
			<div class="columns small-3 influencer-head  right">
				<img class="influencer-img circular" src="<?= Influencer::get_influencer_head($influencer_id); ?>" />
				<p><?= $influencer->display_name; ?></p>
			</div>
			<?php endif; ?>

		</footer>

	</div>
</article>
