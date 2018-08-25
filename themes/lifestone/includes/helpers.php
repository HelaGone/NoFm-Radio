<?php if ( ! defined( 'ABSPATH' ) ) exit;


if(!function_exists('pre')) {
    function pre()
    {
        array_map(function ($data) {
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }, func_get_args()
        );
        exit;
    }
}

// option tree: knowing if enabled or not
if(!function_exists('lifestone_is_enabled')) {

    function lifestone_is_enabled($key)
    {
        if(class_exists('OT_Loader')) {
            if (ot_get_option($key, 'on') == 'on') {
                return true;
            }
        }
        return false;
    }
}

// Meta box option: knowing if enabled or not
if(!function_exists('lifestone_is_enabled_meta')) {

    function lifestone_is_enabled_meta($meta_key)
    {
        global $post;
        if (get_post_meta($post->ID, $meta_key, true) == 'on') {
            return true;
        }
        return false;
    }
}

if(!function_exists('lifestone_search_posts')) {
    function lifestone_search_posts()
    {
        wp_reset_postdata();
        global $wp_query;
        return $wp_query->found_posts;
    }
}

if(!function_exists('lifestone_max_num_pages')) {

    function lifestone_max_num_pages()
    {
        global $wp_query;
        return $wp_query->max_num_pages;
    }
}

if(!function_exists('lifestone_get_image_id')) {

    function lifestone_get_image_id($image_url)
    {
        global $wpdb;
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url));
        return $attachment[0];
    }
}

if(!function_exists('lifestone_categories')){
    function lifestone_categories()
    {
        global $post;
        $postCategories = get_the_category();
        if(!empty($postCategories)){
            $output = '';
            foreach ($postCategories as $category) {
                $output .= '<a class="category-link" href="'. esc_url( get_category_link( $category->term_id ) ).'"><span class="category-label">' . esc_html( $category->name ). '</span></a>';

            }
            return $output;
        }
        return false;

    }
}

if(!function_exists('lifestone_categories_colored_label')){
    function lifestone_categories_colored_label()
    {

        global $post;
        $color = array('purple', 'yellow', 'red', 'blue', 'green', 'turquoise', 'black');
        $postCategories = get_the_category();
        if(!empty($postCategories)){
            $output = '';
            foreach ($postCategories as $category) {
                $keys = array_rand($color, 1);
                $output .= '<a class="category-link" href="'. esc_url( get_category_link( $category->term_id ) ).'"><span class="category-label label-'.$color[$keys].'">' . esc_html( $category->name ). '</span></a>';

            }
            return $output;
        }
        return false;

    }
}


if(!function_exists('lifestone_tags')){

    function lifestone_tags()
    {
        global $post;
        $posttags = get_the_tags($post->ID);
        $output = '';
        if ($posttags) {
            foreach ($posttags as $tag) {
                $link = get_term_link( $tag, 'post_tag' );
                if ( is_wp_error( $link ) )
                    return $link;
                $output .= '<a class="category-link" href="'.$link.'"><span class="category-label">' . $tag->name . '</span></a>';

            }
            return $output;
        }
        return false;
    }
}

if(!function_exists('lifestone_categories_tabs'))
{
    function lifestone_categories_tabs()
    {

        $categories = get_categories();
        if (!empty($categories)) { ?>
            <ul>
                <li class="select-filter"><a href="javascript:void(0)" data-filter="*"
                                             id="all"><?php echo esc_html__('all', 'lifestone'); ?></a></li>

                <?php foreach ($categories as $category) {
                    if ($category->count > 0) {
                        ?>

                        <li><a href="javascript:void(0)"
                               data-filter=".<?php echo esc_attr($category->slug); ?>"><?php echo esc_attr($category->name); ?> </a>
                        </li>

                    <?php }
                }?>
            </ul>
            <?php
        }
    }

}

/**
 * get youtube video ID from URL
 *
 * @param string $url
 * @return string Youtube video id or FALSE if none found.
 */
if(!function_exists('lifestone_youtube_id_from_url')) {

    function lifestone_youtube_id_from_url($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);

        $headers = get_headers('https://www.youtube.com/oembed?format=json&url=http://www.youtube.com/watch?v=' . $my_array_of_vars['v']);

        if(is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$headers[0]) : false){
            return $my_array_of_vars['v'];
        }
        return false;
    }
}

if(!function_exists('lifestone_error_page_search_form')){

    function lifestone_error_page_search_form()
    {
        $output =  '<div class="search-box">
            <form role="search" method="get" class="search-form" action="'.esc_url(home_url( '/' )).'">
                <input type="search" class="search-field" value="Try Another Search" name="s" title="'. esc_html__('Search for:', 'lifestone') .'" onfocus="if (this.value == \'Try Another Search\')
                    this.value = \'\';" onblur="if (this.value == \'\')
                    this.value = \'Try Another Search\';" placeholder="">
                <button type="submit" class="search-submit" value="Search">'. esc_html__("Search", "lifestone"). '</button></form>
        </div>';
        return $output;
    }

}

if(!function_exists('lifestone_get_category')){

    function lifestone_get_category($taxonomy = 'category') {
        $_categories = get_terms($taxonomy);
        $categories = array();
        if( count($_categories) > 0 ){
            $counter = 1;
            foreach ($_categories as $_category) {

                if($counter == 1){
                    $categories['Select Category'] = '';
                }
                $categories[$_category->name] = $_category->term_id;
                $counter++;
            }
        }
        return $categories;
    }
}


// when visual composer is enabled
// for setting shortcode default attribute value
if(!function_exists('lifestone_set_default')) {

    function lifestone_set_default($param_name, $default_value, $atts)
    {
        $value = (!isset($atts[$param_name])) ? '' : 'value is there';
        if (empty($value)) {
            $atts[$param_name] = $default_value;
        }
        return $atts;
    }
}

if(!function_exists('lifestone_truncate')) {

    function lifestone_truncate($string, $length = 100)
    {
        $string = trim($string);

        if (strlen($string) > $length) {
            $string = wordwrap($string, $length);
            $string = explode("\n", $string, 2);
            $string = $string[0];
        }

        return $string;
    }
}

if(!function_exists('lifestone_verify_youtube_video')){

    function lifestone_verify_youtube_video( $key ){
        $headers = get_headers('https://www.youtube.com/oembed?format=json&url=http://www.youtube.com/watch?v=' . $key);

        if(is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$headers[0]) : false){
            return false;
        }
        return true;
    }
}

if(!function_exists('lifestone_get_video_thumbnail')) {

    /**
     * Retrieves the thumbnail from a youtube or vimeo video
     * @param $src : the url of the "player"
     * @return string
     **/
    function lifestone_get_video_thumbnail($src)
    {
        $thumbnail = '';

        $url_pieces = explode('/', $src);

        if ($url_pieces[2] == 'player.vimeo.com') { // If Vimeo

            $id = $url_pieces[4];

            $hash = unserialize(wp_remote_get('http://vimeo.com/api/v2/video/' . $id . '.php'));

            $thumbnail = $hash[0]['thumbnail_medium'];

        } elseif ($url_pieces[2] == 'www.youtube.com') { // If Youtube

            $extract_id = explode('?', $url_pieces[4]);

            $id = $extract_id[0];

            $thumbnail = 'http://img.youtube.com/vi/' . $id . '/mqdefault.jpg';
        }

        return $thumbnail;
    }
}


if(!function_exists('lifestone_get_post_share_url')){
    /**
     * @param $social_media
     * @return string
     */
    function lifestone_get_post_share_url( $social_media )
    {
        global $post;

        $permalink = urlencode(get_the_permalink(get_the_ID()));

        $title = str_replace( ' ', '%20', get_the_title(get_the_ID()));

        $thumb     = get_post_thumbnail_id( $post );
        if(!empty($thumb)) {
            $imgUrl = wp_get_attachment_url($thumb, 'full');
        } else {
            $imgUrl = get_template_directory_uri() . '/images/logo.png';
        }
        $imgUrl = urlencode($imgUrl);

        $link = '';

        switch($social_media) {
            case 'facebook':
                $link = "https://www.facebook.com/sharer/sharer.php?s=100&amp;p[title]=$title&amp;p[summary]=$title&amp;p[url]=$permalink&amp;p[images][0]=$imgUrl";
                break;

            case 'twitter':
                $link = "https://twitter.com/intent/tweet?url=$permalink";
                break;

            case 'google-plus':
                $link = "https://plus.google.com/share?url=". $permalink;
                break;

            case 'linkedin':
                $link = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $permalink . '&amp;title=' . $title;
                break;

            case 'pinterest':
                $link = "javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());";
                break;

        }

        return $link;

    }
}

/**
 * Query Lifestone Package activation
 */
if(!function_exists('lifestone_is_package_activated')) {

    function lifestone_is_package_activated()
    {
        return class_exists('LifestonePackage') ? true : false;
    }

}

if ( ! function_exists( 'lifestone_get_option' ) ) {

    function lifestone_get_option( $option_id, $default = '' ) {

        if(class_exists('OT_Loader')) {

            /* get the saved options */
            $options = get_option(ot_options_id());

            /* look for the saved value */
            if (isset($options[$option_id]) && '' != $options[$option_id]) {

                return ot_wpml_filter($options, $option_id);

            }

            return $default;
        }
        return false;

    }

}