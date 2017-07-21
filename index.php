<?php
/*
Template Name: Blog Index
*/
get_header(); ?>

<div class="banner" <?php banner_styles(); ?>>
    <div class="overlay"></div>
    <div class="wide horiz_center">
        <div class="vert_center expand">
            <h1 class="inner text_center">
                <?php if(is_month()){ ?>
                    Archive |<?php single_month_title(' '); ?>
                <?php } else { ?>
                    Blog
                <?php } ?>
            </h1>
        </div>
    </div>
</div>

<main id="page_content" class="wide horiz_center space_2_top space_2_bottom clearfix">
    <ul id="sidebar" class="float_left width_4 mobile_hide pad_2_right">
    <?php if ( ! dynamic_sidebar('index_sidebar') ) : ?>
        <li>[Set up blog index sidebar in WP admin]</li>
    <?php endif; ?>
    </ul>
    <div class="width_8 mobile_width_12 float_right">
        <?php function_exists("pagination") && pagination(); ?>
        <div class="article_list">
        <?php
        while(have_posts() ) {
            the_post();

            //get the author name via custom field (or default to "real" author)
            $author = get_post_meta(get_the_ID(), "author", true);
            $author = $author ? $author : get_the_author();
        ?>
            <article class="clearfix">
                <header>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="context">
                        <?php echo $author; ?>
                        <span class="splitter">//</span>
                        <time datetime="<?php the_time('c'); ?>">
                        <?php the_time('F d, Y'); ?></time>
                        <span class="splitter">//</span>
                        <?php comments_number(); ?>
                    </div>
                </header>
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php
        }
        ?>
        </div>
        <?php function_exists("pagination") && pagination(); ?>
    </div>
</main>

<?php
get_footer();
?>
