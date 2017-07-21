<?php get_header(); ?>

<?php the_post(); ?>
<div class="banner" <?php banner_styles(); ?>>
    <div class="overlay"></div>
    <div class="wide horiz_center">
        <div class="vert_center expand">
            <h1 class="inner text_center">
                <?php the_title(); ?>
            </h1>
        </div>
    </div>
</div>
<main id="page_content" class="wide horiz_center space_2_top space_2_bottom">
    <?php the_content() ?>
</main>

<?php get_footer(); ?>
