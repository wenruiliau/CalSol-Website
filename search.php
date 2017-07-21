<?php
/*
Template Name: Search Page
*/
get_header(); ?>

<div class="banner">
    <div class="overlay"></div>
    <div class="wide horiz_center">
        <div class="vert_center expand">
            <h1 class="inner text_center">
                Search Results
            </h1>
        </div>
    </div>
</div>
<div id="page_content" class="wide text_center pad_2_top clearfix">
    <div class="width_3 mobile_width_12 float_left text_left pad_2_right">
        Search terms:
        <?php get_search_form(); ?>
    </div>
    <div id="search_results" class="width_9 mobile_width_12 float_right">
        <?php
            query_posts($query_string . '&showposts=10');
            function_exists("pagination") && pagination();
        ?>
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
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php
        }
        ?>
        </div>
        <?php function_exists("pagination") && pagination(); ?>
</div>
</div>
<?php get_footer(); ?>
