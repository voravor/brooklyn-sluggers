<?php use \Helium\Influencer; ?>

<ul class="topnav show-for-xlarge-up">
	<li>
		<a class="has-dropdown" tabindex="-1">
			Thought Leaders
		</a>

		<div id="thought-leaders-dropdown" class="topnav-dropdown">
			<h4>FEATURED</h4>
			<div class="row text-center">
				<?php foreach(Influencer::get_influencers() as $influencer): ?>

			
				<div class="columns xlarge-6">
					<div class="row">
						<a href="<?= get_author_posts_url($influencer->ID); ?>">
							<img class="circular" src="<?= Influencer::get_influencer_head($influencer->ID); ?>" />
						</a>
					</div>

					<div class="row">

						<a href="<?= get_author_posts_url($influencer->ID); ?>" onclick="console.log('click');">
							<?= $influencer->display_name; ?>
						</a>
					</div>

				</div>
			

				<?php endforeach; ?>
			</div>

			<div class="row text-center">
				<a class="heleo-blue view-all">View All</a>
			</div>
		</div>


	</li>


	<li>
		<a class="has-dropdown" tabindex="-1">
			Topics
		</a>

		<div id="topics-dropdown" class="topnav-dropdown">
		 	<h4>FEATURED TOPICS</h4>
			<?php get_template_part('parts/topics', 'menu'); ?>
		</div>
	</li>

	<li>
		<a href="/about-us">About Us</a>
	</li>
</ul>