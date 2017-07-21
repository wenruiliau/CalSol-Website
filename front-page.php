<?php
/*
Template Name: Front Page
*/
?>
<?php get_header(); ?>

<div class="banner" style="background-image: url(<?php homepage_mod('bannerimageurl'); ?>); background-position: <?php homepage_mod('bannerposition'); ?>;">
    <div class="overlay"></div>
    <div class="wide horiz_center">
        <div class="vert_center expand">
            <div class="inner text_center">
                <div id="slogan"><?php homepage_mod('intro'); ?></div>
                <!-- <a href="<?php homepage_mod('introlinkurl'); ?>" style="font-size: 4em;" href=""><?php homepage_mod('introlinklabel'); ?> &raquo;</a> -->
            </div>
        </div>
    </div>
</div>

<div class="full_box">
    <section class="wide horiz_center pad_2 text_center">
        <h2><?php homepage_mod('featuretitle'); ?></h2>
        <a href="<?php homepage_mod('featurelinkurl'); ?>"><?php homepage_mod('featurelinkname'); ?> &raquo;</a>
        <br />
        <img src="<?php homepage_mod('featureimageurl'); ?>" class="space_2_top" />
    </section>
</div>

<div class="wide clearfix space_2_top">
    <div class="width_6 mobile_width_12 pad_2 float_left">
        <section class="box">
            <h2><?php homepage_mod('leftboxtitle'); ?></h2>
            <div class="visual" style="background-image:url(<?php homepage_mod('leftboximageurl'); ?>);"></div>
            <p><?php homepage_mod('leftboxblurb'); ?></p>
            <div class="link_list">
                <a href="<?php homepage_mod('leftboxlinkurl'); ?>"><?php homepage_mod('leftboxlinklabel'); ?> &raquo;</a>
            </div>
        </section>
    </div>
    <div class="width_6 mobile_width_12 pad_2 float_right">
        <section class="box">
            <h2><?php homepage_mod('rightboxtitle'); ?></h2>
            <div class="visual" style="background-image:url(<?php homepage_mod('rightboximageurl'); ?>);"></div>
            <p><?php homepage_mod('rightboxblurb'); ?></p>
            <div class="link_list">
                <a href="<?php homepage_mod('rightboxlinkurl'); ?>"><?php homepage_mod('rightboxlinklabel'); ?> &raquo;</a>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>
