<?php get_header(); ?>

<div class="page-container">
	<div class="row">
		<div class="columns large-12 ">
			<div class="row">
				<div class="columns text-center">
					<h1>
						<a href="/"><img src="<?php echo get_template_directory_uri(); ?>/assets/helium/img/Heleo_logo_516x170.png" height="100" width="300" /></a>
					</h1>
				</div>
			</div>
			
			<div class="row">
				 <div class="columns text-center">
					<h2 class="page-tagline">
						ELEVATING IDEAS
					</h2>
				</div>
			</div>
		</div>
	</div>

<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		
			<div class="entry-content">
	
				<?php if ( has_post_thumbnail() ): ?>
				<div class="full-width-row">
					<?php the_post_thumbnail('full', array('class'=> 'jobs-img')); ?>
				</div>
				
				
				<?php endif; ?>
				
				<div class="row">
					<div class="columns large-6 medium-6 small-6 large-centered medium-centered small-centered text-center">
						<h3 class="entry-title"><?php the_title(); ?></h3>
					</div>
					
				</div>
				
				<div class="row">
					<div class="columns large-9 large-centered medium-10 medium-centered small-10 small-centered jobs-content">
						<?php the_content(); ?>
					</div>
				</div>
				
				
	
			</div>
		</article>
	<?php endwhile;?>
	
</div>



<footer class="page-signup">
	<div class="row">
		<div class="columns large-12 large-centered">
			<?php get_template_part('parts/signup', 'form'); ?>
		</div>
	</div>
	
	<?php get_footer('mini'); ?>
	
</footer>


