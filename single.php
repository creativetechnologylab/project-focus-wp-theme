<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

$reply_title = 'Start this conversation';
if(wp_count_comments($post->ID)->approved > 0){
  $reply_title = 'Contribute to this conversation';
}

$reply_suffix = '<p>Your comment may have to be moderated before appearing live on this site.</p>';
if(!is_user_logged_in()){
  $reply_suffix = '<p>We ask for your email address and name to prevent abuse of this mechanism. We will not publish your email address or use this to send you any unsolicited emails.</p>';
}

$context['form_config'] = array(
  'title_reply'         => $reply_title,
  'comment_notes_before' => '',
  'comment_field'       => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
  'comment_notes_after' => $reply_suffix
);

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
