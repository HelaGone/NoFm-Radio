<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lifestone
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
ob_start();
$commenter = wp_get_current_commenter();
$req       = get_option( 'require_name_email' );
$aria_req  = ( $req ) ? " aria-required='true'" : '';
$html_req  = ( $req ) ? " required='required'" : '';
$html5     = ( 'html5' === current_theme_supports( 'html5', 'comment-form' ) ) ? 'html5' : 'xhtml'; ?>

<?php
if ( have_comments() ) :?>
<div class="post-comment">
    <div class="comment-title">
        <h2>
            <?php
            printf( // WPCS: XSS OK.
                esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'lifestone' ) ),
                number_format_i18n( get_comments_number() ),
                '<span>' . get_the_title() . '</span>'
            );
            ?>
        </h2>
    </div>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
        <nav id="comment-nav-above" class="navigation comment-navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'lifestone' ); ?></h2>
            <div class="nav-links">

                <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'lifestone' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'lifestone' ) ); ?></div>

            </div><!-- .nav-links -->
        </nav><!-- #comment-nav-above -->
    <?php endif; // Check for comment navigation. ?>
    <div id="comments">
        <ul>
            <?php
            wp_list_comments( array( 'callback' => 'lifestone_shape_comment' ) ); ?>
        </ul><!-- .comment-list -->
    </div> <!-- end of comments -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
        <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'lifestone' ); ?></h2>
            <div class="nav-links">

                <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'lifestone' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'lifestone' ) ); ?></div>

            </div><!-- .nav-links -->
        </nav><!-- #comment-nav-below -->
        <?php
    endif; // Check for comment navigation.

    endif; // Check for have_comments().


    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

    <div class="no-comments"><?php esc_html_e( 'Comments are closed.', 'lifestone' ); ?></div>
</div>
<?php
endif; ?>


<?php
$args = array(
    'logged_in_as'          => '<p class="logged-in-as col-md-12">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'lifestone' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
    'comment_notes_before'  => '',
    'comment_notes_after'   => '',
    'title_reply_before'    => '<div class="comment-title"><h2>',
    'title_reply'           => esc_html__('Comment', 'lifestone'),
    'title_reply_after'     => '</h2></div>',
    'fields'                => apply_filters(
        'comment_form_default_fields', array(
            'author' =>'<div class="col-lg-6 col-md-6"><div class="form-group"><p class="help-block text-danger"></p>'. ( $req ? '<span class="error hidden">*Please Enter a valid name</span>' : '' ) . '<input type="text" autocomplete="off" class="form-control" placeholder="Your name" id="name" data-validation-required-message="Please enter your name." value="'.esc_attr( $commenter['comment_author'] ) .'"'.  $html_req . $aria_req. '></div>',

            'email'  => '<div class="form-group"><p class="help-block text-danger"></p>' . ( $req ? '<span class="error hidden">*Please Enter a Valid Email Address</span>' : '' )  . '<input id="email" class="form-control" placeholder="Your Email"  autocomplete="off" name="email"' . ( $html5 ? ' type="email"' : ' type="text"' ) .  ' data-validation-required-message="Please enter your email address." value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30"'  . $html_req . $aria_req . '/></div>',
            'title'  =>   '<div class="form-group"><p class="help-block text-danger"></p>'. ( $req ? '<span class="error hidden">*Please Enter a title</span>': '' )  .'<input type="text" autocomplete="off" class="form-control" placeholder="'. esc_attr__('Title of your review', 'lifestone') .'" id="review"></div></div>',
        )
    ),
    'comment_field' => '<div class="col-lg-6 col-md-6"><div class="form-group">
                             <p class="help-block text-danger"></p>' .
        '<textarea class="form-control" id="comment" name="comment" placeholder="Comment" required="required"></textarea>' .
        '</div></div>',
    'id_form'       => 'comment_form',
    'class_form'    => 'row',
    'label_submit'  => esc_html__( 'Submit', 'lifestone' ),
    'class_submit'  => 'send_btn',
    'submit_field'  => '<div class="col-lg-12 col-md-12">%1$s %2$s</div>',
    'id_submit'     => 'comment_submit'
); ?>
<div class="post-comment">
    <?php comment_form( $args );
    $comment_form = ob_get_contents();
    ob_end_clean();

    echo str_replace( 'novalidate', '', $comment_form ); ?>
</div><!-- post-comment -->