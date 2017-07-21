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
<div id="page_content" class="wide horiz_center clearfix">
  <article class="space_2_bottom width_8 mobile_width_12 float_left">
      <?php
          $author = get_post_meta(get_the_ID(), "author", true);
          $author = $author ? $author : get_the_author();
      ?>
      <div class="context">
                        <?php echo $author; ?>
                        <span class="splitter">//</span>
                        <time datetime="<?php the_time('c'); ?>">
                        <?php the_time('F d, Y'); ?></time>
                        <span class="splitter">//</span>
                        <?php comments_number(); ?>
      </div>
      <?php the_content() ?>

      <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">&larr; Back to Blog</a>
      <hr />
      <?php comments_template(); ?>
  </article>
  <ul id="sidebar" class="float_right width_4 mobile_hide pad_2_left">
  <?php if ( ! dynamic_sidebar('post_sidebar') ) : ?>
      <li>[Set up post sidebar in WP admin]</li>
  <?php endif; ?>
  </ul>
</div>

<?php get_footer(); ?>
