
<p class="byline author">By
    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="author-meta">
        <?php echo get_the_author(); ?>
    </a>
    <time class="updated" datetime="<?php the_time('c'); ?>">
        <?php the_date(); ?>
    </time>
</p>
