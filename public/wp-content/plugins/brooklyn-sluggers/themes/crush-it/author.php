<?php get_header(); ?>


<div class="row">
	<div class="small-12 large-12 columns" role="main">
		<?php
			if(get_query_var('author_name')) :
			    $curauth = get_user_by('slug', get_query_var('author_name'));
			else :
			    $curauth = get_userdata(get_query_var('author'));
			endif;
		?>
		<h2 class="pagetitle"><?php echo $curauth->nickname; ?></h2>

		

	</div>
	<?php //get_sidebar(); ?>
</div>
<?php


?>

<?php get_footer(); ?>