<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title( '|', true, 'right' ); ?></title>

    <meta http-equiv="title" content="<?php bloginfo('name'); ?>" />
    <meta http-equiv="description" content="<?php bloginfo('description'); ?>" />
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
    <script>
        $(function(){
            $('*').click(function(e){ /* mobile nav bar hide on click */
                if($(this).is('header > .wide > *')){
                    e.stopPropagation();   
                }
                if(!$(this).is('header, header *') || $(this).is('header .menu li a')){
                    $('#menu_enable_cb').prop('checked', false);
                }
                if(!$(this).is('#search_form, #search_form *, #search_enable_btn, #search_enable_btn *, #search_enable_cb')){
                    console.log(this);
                    $('#search_enable_cb').prop('checked', false);
                }
            });
        });
    </script>
</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

<header>
    <div class="wide clearfix">
        <a href="<?php echo home_url(); ?>"><img id="logo" src="<?php bloginfo('template_url'); ?>/img/logo_white.png" /></a><!-- TODO: replace logo markup with an anchored <img> tag -->
        <input id="menu_enable_cb" type="checkbox" />
        <label for="menu_enable_cb" id="menu_enable_btn" class="mobile_show">
            <i class="fi-list"></i>
            <i class="fi-plus"></i>
        </label>
        <input id="search_enable_cb" type="checkbox" />
        <label for="search_enable_cb" id="search_enable_btn" class="mobile_hide">
            <i class="fi-magnifying-glass"></i>
            <i class="fi-x"></i>
        </label>
        <div id="search_form">
            <?php get_search_form(); ?>
        </div>
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 1, 'menu_class' => 'nav_menu' ) ); ?>
    </div>
</header>

<!-- header.php end -->
