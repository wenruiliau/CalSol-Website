<?php
/*
    CalSol WordPress Theme
    (c) brent yi 2015
*/

add_filter('wp_page_menu_args', 'show_homepage');
function show_homepage($args) {
    $args['show_home'] = true;
    return $args;
}

add_action('wp_enqueue_scripts', 'add_utils');
function add_utils() {
    wp_enqueue_style('util_styles', get_template_directory_uri() . '/util.css');
}

add_action('wp_enqueue_scripts', 'add_js');
function add_js() {
    wp_enqueue_script('respond_script', 'https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js');
    wp_enqueue_script('jquery_script', '//code.jquery.com/jquery-2.1.1.min.js');
}

add_action('wp_enqueue_scripts', 'load_foundation_icons');
function load_foundation_icons() {
    wp_enqueue_style('foundation_icons_styles', get_template_directory_uri() . '/foundation_icons/foundation-icons.css');
}

add_action('wp_enqueue_scripts', 'add_styles');
function add_styles() {
    wp_enqueue_style('normalize_css', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css');
    wp_enqueue_style('theme_styles', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('webfont_styles', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400|Open+Sans+Condensed:300');
}

//synchronize default input value with null setting defaults for homepage controls
global $homepage_mod_defaults;
global $homepage_controls;
$homepage_controls = [
    ['Intro', 'Lorem Ipsum Dolores', 'textarea'],
    ['Intro Link Label', 'Learn More', 'text'],
    ['Intro Link URL', '/', 'url'],
    ['Banner Image URL', 'http://placekitten.com/1000/400', 'url'],
    ['Banner Position', 'center center', 'text'],

    ['Feature Title', 'Consequator fugiat', 'text'],
    ['Feature Image URL', 'http://placekitten.com/800/400', 'url'],
//    ['Feature Link Name', 'Sed quia non numquam', 'text'],
//    ['Feature Link URL', '/', 'url'],

    ['Left Box Title', 'Seraph Edor', 'text'],
    ['Left Box Image URL', 'http://placekitten.com/250/300', 'url'],
    ['Left Box Blurb', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'textarea'],
    ['Left Box Link Label', 'Learn More', 'text'],
    ['Left Box Link URL', '/', 'url'],

    ['Right Box Title', 'Sed Amuruk', 'text'],
    ['Right Box Image URL', 'http://placekitten.com/270/320', 'url'],
    ['Right Box Blurb', 'Sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'textarea'],
    ['Right Box Link Label', 'Learn More', 'text'],
    ['Right Box Link URL', '/', 'url']
];
for($i = 0; $i < count($homepage_controls); $i++) {
    $id = strtolower(str_replace(' ', '', $homepage_controls[$i][0]));
    $homepage_mod_defaults[$id] = $homepage_controls[$i][1];
}

add_action( 'customize_register', 'mytheme_customize_register' );
function mytheme_customize_register( $wp_customize ) {
    //add homepage customization controls
    global $homepage_controls;
    for($i = 0; $i < count($homepage_controls); $i++){
        $name = $homepage_controls[$i][0];
        $default = $homepage_controls[$i][1];
        $type = $homepage_controls[$i][2];

        $id = strtolower(str_replace(' ', '', $name));
        $wp_customize->add_setting( 'homepage_' . $id , array(
            'default'     => $default
        ) );

        $wp_customize->add_control(
            'control_homepage_' . $id,
            array(
                'label'    => $name,
                'section'  => 'static_front_page',
                'settings' => 'homepage_' . $id,
                'type'     => $type
            )
        );
    }

    //add footer customization controls
    $wp_customize->add_section( 'footer' , array(
        'title'      => 'Footer/Social'
    ));
    $footer_urls = ['Facebook URL', 'Twitter URL', 'Instagram URL', 'Youtube URL', 'Flickr URL', 'Email URL'];
    for($i = 0; $i < count($footer_urls); $i++){
        $name = $footer_urls[$i];
        $id = strtolower(str_replace(' ', '', $name));
        $wp_customize->add_setting( 'footer_' . $id , array(
            'default'     => ''
        ) );

        $wp_customize->add_control(
            'control_footer_' . $id,
            array(
                'label'    => $name,
                'section'  => 'footer',
                'settings' => 'footer_' . $id,
                'type'     => 'url'
            )
        );
    }
}

function homepage_mod($id){
    global $homepage_mod_defaults;
    echo get_theme_mod('homepage_' . $id, $homepage_mod_defaults[$id]);
}

add_filter( 'wp_title', 'filter_wp_title' );
/**
 * Filters the page title appropriately depending on the current page
 *
 * This function is attached to the 'wp_title' fiilter hook.
 *
 * @uses    get_bloginfo()
 * @uses    is_home()
 * @uses    is_front_page()
 */
function filter_wp_title( $title ) {
    global $page, $paged;

    if ( is_feed() )
        return $title;

    $site_description = get_bloginfo( 'description' );

    $filtered_title = $title . get_bloginfo( 'name' );
    $filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
    $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) ) : '';

    return $filtered_title;
}


function pagination($pages = '', $range = 3)
{  
    $showitems = ($range * 2)+1;  

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
        global $wp_query;

        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }   

    if(1 != $pages)
    {
        echo '<div class="pagination text_left mobile_text_center">';
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

        echo '<span class="pages">';

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems))
            {
                echo ($paged == $i)? "<span class='current'><a>".$i."</a></span>":"<span><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></span>";
            }
        }

        echo '</span>';

        if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
        echo '</div>';
    }
}

add_theme_support( 'post-thumbnails' ); 

function banner_styles(){
    $styles = '';


    $image = '';
    $post_id = get_the_ID();
    if(is_home() || is_month()){ // check if currently on blog page (not home) because wordpress
        $post_id = get_option('page_for_posts');
    }
    if(strlen($image) == 0){
        $image = get_post_meta($post_id, 'banner_image_url', true);
    }
    if(strlen($image) == 0 && has_post_thumbnail($post_id)){
        $image = get_the_post_thumbnail_url($post_id, "large");
    }
    if(strlen($image) == 0){
        $image = catch_first_image();
    }

    if(strlen($image) > 0){
        $styles .= 'background-image: url(' . $image . ');';
    }

    $position = get_post_meta($post_id, 'banner_image_position', true);
    if(strlen($position) > 0){
        $styles .= 'background-position: ' . $position . ';';
    }

    echo 'style="' . $styles . '"';
}

function catch_first_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  if(empty($first_img)) {
    $first_img = '';
  }
  return $first_img;
}

function responsive_wp_caption($x = NULL, $attr, $content) {
    extract( shortcode_atts(
        array(
         'id' => '',
         'align' => 'alignnone',
         'width' => '',
         'caption' => '',
        ),
        $attr
      )
    );

    if ( intval( $width ) < 1 || empty( $caption ) ) {
        return $content;
    }

    $id = $id ? ('id="' . $id . '" ') : '';

    $ret = '<div ' . $id . 'class="wp-caption ' . $align . '" style="max-width: ' . $width . 'px; width: 100%;">';
    $ret .= do_shortcode( $content );
    $ret .= '<div class="wp-caption-wrapper"><p class="wp-caption-text">' . $caption . '</p>';
    $ret .= '</div>';
    $ret .= '</div>';

    return $ret;
}
add_filter( 'img_caption_shortcode', 'responsive_wp_caption', 10, 3 );

function init_sidebars() {
    register_sidebar( array(
        'name' => 'Post Sidebar',
        'id' => 'post_sidebar',
        'description' => 'The post sidebar appears next to posts.'
    ) );
    register_sidebar( array(
        'name' => 'Blog Index Sidebar',
        'id' => 'index_sidebar',
        'description' => 'Appears on the blog index page.'
    ) );
    register_sidebar( array(
        'name' => 'Narrow Page Sidebar',
        'id' => 'narrow_sidebar',
        'description' => 'Appears on pages set up using the "narrow" template.'
    ) );
    register_widget( 'FacebookWidget' );
}

add_action( 'widgets_init', 'init_sidebars' );

class FacebookWidget extends WP_Widget {
    function __construct() {
        parent::__construct( false, 'Facebook Page Plugin' );
    }

    function widget() {
        $facebook_url = get_theme_mod("footer_facebookurl");
        $fb_contents = '<div class="fb-page" data-href="https://www.facebook.com/BerkeleyCalSol" data-tabs="timeline" data-height="800" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="' .  $facebook_url . '"><a href="' . $facebook_url . '"></a></blockquote></div></div>'; ?>
        <script>
            // debounced facebook widget re-render on page resize
            var facebook_resize_timeout = null;
            $(window).resize(function(){
                $wrapper = $('#fb_pageplugin_wrapper');
                $parent = $wrapper.parent();
                if(facebook_resize_timeout != null)
                    clearTimeout(a);
                else
                    $parent.animate({opacity: 0},1000);
                facebook_resize_timeout = setTimeout(function(){
                    $wrapper.html('<?php echo $fb_contents; ?>');
                    FB.XFBML.parse(document, function(){
                        $parent.animate({opacity: 1},1500);
                        a = null;
                    });
                },1000);
            });
        </script>
        <li id="fb_pageplugin_wrapper">
            <?php echo $fb_contents; ?>
        </li>
        <?php
    }
}

function officer_func($atts) {
    $a = shortcode_atts( array(
        'photo' => 'http://placekitten.com/g/500/500',
        'name' => 'Muffins',
        'position' => 'Placeholder Title'
    ), $atts );

    return '
        <div class="officer">
        <img class="photo" src="' . $a['photo'] . '">
        <span class="name">' . $a['name'] . '</span>
        <span class="position">' . $a['position'] . '</span>
        </div>
    ';
}
add_shortcode('officer', 'officer_func');

function subscribe_form_func($atts) {
    $output = '';

    if (isset($_POST) && isset($_POST['list']) && isset($_POST['email'])) {
        $to = addslashes($_POST['list']) . '-join@listlink.berkeley.edu';
        $from = addslashes($_POST['email']);

        // TODO: double check if this success/failure system actually works
        if (mail($to,'', '','From: ' . $from))
            $output .= 'Successfully subscribed "' . $from . '"<br />';
        else
            $output .= 'Subscription failure for "' . $from . '"<br />';
    }

    $action = get_permalink( $post->ID );
    $output .= '<form method="POST" action="' . $action . '">';
    $output .= '
        <input placeholder="Email Address" name="email" type="text" size="49" maxlength="50"/>
        <div style="display: inline-block">
            <select name="list">
                <option value="calsol-prospective">General Prospectives</option>
                <option disabled>Mechanical</option>
                <option value="calsol-shell">&raquo; Shell</option>
                <option value="calsol-suspension-chassis">&raquo; Suspension/Chassis</option>
                <option value="calsol-controls">&raquo; Driver Controls</option>
                <option value="calsol-motor">&raquo; Motor</option>
                <option disabled>Electrical</option>
                <option value="calsol-power">&raquo; Power</option>
                <option value="calsol-solar">&raquo; &raquo; Solar</option>
                <option value="calsol-eleccontrols">&raquo; Electrical Controls</option>
                <option value="calsol-data">&raquo; Data</option>
                <option disabled>Support</option>
                <option value="calsol-it">&raquo; IT</option>
                <option value="calsol-ops">&raquo; Operations</option>
                <option value="calsol-strategy">&raquo; Race Strategy</option>
            </select>
            <input type="submit" value="Subscribe" />
        </div>
    ';
    $output .= '</form>';

    return $output;
}

add_shortcode('subscribe_form', 'subscribe_form_func');

?>
