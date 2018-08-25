<?php
/**
* All the custom filters & action for Lifestone Theme.
* @author    Prajwal Shrestha <https://np.linkedin.com/in/prajwalstha>
* @since    1.0
*/

if(!function_exists('lifestone_get_custom_logo')){

    /**
     * @param $html
     * @return mixed
     */
function lifestone_get_custom_logo($html)
{

    $to_remove = array('itemprop="url"', 'itemprop="logo"');

    $html = str_replace($to_remove, '', $html);

    return $html;
}

    add_filter( 'get_custom_logo', 'lifestone_get_custom_logo');
}

if(!function_exists('lifestone_get_the_archive_title')) {

    /**
     * @param $title
     * @return mixed
     */
    function lifestone_get_the_archive_title($title)
    {
        $to_remove = array('<span class="vcard">', '</span>');

        $title = str_replace($to_remove, '', $title);

        return $title;

    }

    add_filter('get_the_archive_title', 'lifestone_get_the_archive_title');
}

if(!function_exists('lifestone_exclude_pages_from_search')) {

    /**
     * @param $query
     * @return mixed
     * Remove pages from search results
     */
    function lifestone_exclude_pages_from_search($query)
    {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }

    add_filter('pre_get_posts', 'lifestone_exclude_pages_from_search');
}

if(!function_exists('lifestone_comment_post')) {

    // This will occur when the comment is posted
    /**
     * @param $incoming_comment
     * @return mixed
     */
    function lifestone_comment_post($incoming_comment)
    {
        // convert everything in a comment to display literally
        $incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']);
        // the one exception is single quotes, which cannot be #039; because WordPress marks it as spam
        $incoming_comment['comment_content'] = str_replace("'", '&apos;', $incoming_comment['comment_content']);
        return ($incoming_comment);
    }
    add_filter( 'preprocess_comment', 'lifestone_comment_post', '', 1 );

}


if(!function_exists('lifestone_comment_display')) {
    // This will occur before a comment is displayed
    /**
     * @param $comment_to_display
     * @return mixed
     */
    function lifestone_comment_display($comment_to_display)
    {
        // Put the single quotes back in
        $comment_to_display = str_replace('&apos;', "'", $comment_to_display);
        return $comment_to_display;
    }

    add_filter( 'comment_text', 'lifestone_comment_display', '', 1 );
    add_filter( 'comment_text_rss', 'lifestone_comment_display', '', 1 );
    add_filter( 'comment_excerpt', 'lifestone_comment_display', '', 1 );
    // This stops WordPress from trying to automatically make hyperlinks on text:
    remove_filter( 'comment_text', 'make_clickable', 9 );
}

if(!function_exists('lifestoneCostumizeBodyClass')) {
    function lifestoneCostumizeBodyClass( $classes )
    {
        $classes[] = 'full-page';
        return $classes;
    }

    add_filter('body_class', 'lifestoneCostumizeBodyClass');
}