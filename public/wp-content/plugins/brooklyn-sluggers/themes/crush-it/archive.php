<?php

//this is not used for Topics pages - see taxonomy-topics.php
use \Helium\Content;

get_header('homepage'); 

?>

<?php get_template_part('parts/module', 'most-viewed'); ?>

<div class="home-feed">

	<h2 class="most-recent">Most Recent from Heleo</h2>

	<?php
	
	$posts = Content::get_posts(12, 1, 0, NULL, 'happiness');
	$i = 1;

	foreach($posts as $post): setup_postdata($post); 
			
		get_template_part( 'content', 'home' ); 
		
		if($i == 3) {
			get_template_part( 'parts/module', 'editors-picks');
		}

		if($i == 6) {
			get_template_part( 'parts/module', 'featured-influencers');
		}

		if($i == 9) {
			get_template_part( 'parts/module', 'get-the-gist');
		}

		$i++;
	endforeach;
	
	?>

</div>


<div class="load-more">
	<a href="javascript:void(0);" data-bind="click: loadMore">Load more</a>
</div>

<div class="load-more-spinner"></div>


<?php if(false): ?>
<pre data-bind="text: ko.toJSON($data, null, 2)"></pre>
<?php endif; ?>

<?php get_footer(); ?>