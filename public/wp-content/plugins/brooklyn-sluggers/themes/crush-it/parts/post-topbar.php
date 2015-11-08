<?php

use \Helium\Content;

global $influencer_name, $influencer_firstname, $influencer_uuid, $influencer_id;

$influencer_id 		= Content::get_influencer(get_the_ID());

if($influencer_id):

    $influencer			= get_user_by('id', $influencer_id);
    $influencer_name 	= $influencer->display_name;
    $influencer_firstname = $influencer->user_firstname;
    $influencer_lastname= $influencer->user_lastname;
    $influencer_uuid    = get_user_meta($influencer_id, 'uuid', true);
    
    $topbar_image_id 	= get_user_meta($influencer_id, 'influencer_topbar_image', true);				
    $topbar_image 		= wp_get_attachment_image_src($topbar_image_id);

?>

<div class="topbar" data-bind="css: {'': show_dropdown, 'small-head': show_dropdown() == false, 'small-head': is_scrolled() && show_dropdown()== false}">
    
    <a data-bind="click: $root.toggleDropdown" class="head circular" 
        style="background: url('<?= $topbar_image[0]; ?>') no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;  
            background-size: cover;">
        <div class="circular overlay">
        </div>

        <div class="influencer circular">
            <span>
                <?= $influencer_firstname; ?> <?= $influencer_lastname; ?>
            </span>
        </div>    
    </a>

    <div class="toggle-dropdown" data-bind="click: toggleDropdown">
        <div class="triangle" data-bind="css: {'toggle-dropdown-rotate': show_dropdown, '': show_dropdown() == false}">
        </div>
    </div>
</div>

<?php endif; ?>