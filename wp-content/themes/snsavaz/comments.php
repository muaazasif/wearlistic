<div class="sns-comments">
<?php 
if ( post_password_required() ) { ?>
    <p class="no-comments">
    <?php esc_html_e('This post is password protected. Enter the password to view comments.', 'snsavaz'); ?>
    </p>
    <?php 
    return; 
}
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
//Custom Fields
$fields =  array(
    'author'=> '<div class="row text-field"><div class="col-md-4"><input name="author" type="text" placeholder="' . esc_html__('Name *', 'snsavaz') . '" size="30"' . $aria_req . ' /></div>',
    'email' => '<div class="col-md-4"><input name="email" type="text" placeholder="' . esc_html__('E-Mail *', 'snsavaz') . '" size="30"' . $aria_req . ' /></div>',
    'url'   => '<div class="col-md-4"><input name="url" type="text" placeholder="' . esc_html__('Your website', 'snsavaz') . '" size="30" /></div></div>',
);
//Comment Form Args
$comments_args = array(
    'fields' => $fields,
    'title_reply'=>'<span>'. esc_html__('Leave a comment', 'snsavaz') .'</span>',
    'comment_field' => '<div class="row"><div class="col-md-12"><textarea id="comment" name="comment" placeholder="' . esc_html__('Your comment', 'snsavaz') . '" aria-required="true" cols="58" rows="8" tabindex="4"></textarea></div></div>',
    'label_submit' => esc_html__('Submit comment','snsavaz') ,
	'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . esc_html__( 'Your email address will not be published.', 'snsavaz' ) . '</span>' . esc_html__( ' Required fields are marked ', 'snsavaz' ) . '<span class="required">*</span></p>',
    'comment_notes_after' => ''
    /*'comment_notes_after' => '<p class="form-allowed-tags">' . sprintf( wp_kses(__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'snsavaz' ), array(
                                        'abbr' => array(
                                            'title' => array()
                                        ),
                                    )), ' <code>' . allowed_tags() . '</code>' ) . '</p>'*/
);

if ( have_comments() && comments_open() ) : ?>
    <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
    <h3 id="comments"><span><?php comments_number(esc_html__('Leave a Comment','snsavaz'), esc_html__('(1) Comment','snsavaz'), '(%)' . esc_html__(' Comments','snsavaz') );?></span></h3>
    <ul class="commentlist">
        <?php wp_list_comments('callback=snsavaz_comment'); ?>
    </ul>
    <div class="navigation">
        <?php paginate_comments_links(); ?> 
    </div>
    <?php comment_form($comments_args); ?>
<?php 
else :
    if ( comments_open() ) : ?>
    <?php comment_form($comments_args); ?>
    <?php
    endif;
endif; ?>
</div>