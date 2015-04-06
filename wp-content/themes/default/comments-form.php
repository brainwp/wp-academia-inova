<?php 
global $themename;
if(comments_open())
{
	?>
<div class="comment_form_container">
	<h3 class="box_header">
		<?php _e("Leave a reply", $themename); ?>
	</h3>
	<form class="comment_form" id="comment_form" method="post" action="">
	<?php
	if(get_option('comment_registration') && !is_user_logged_in())
	{
	?>
	<p>You must be <a href="<?php echo wp_login_url(get_permalink()); ?>">logged in</a> to post a comment.</p>
	<?php
	}
	else
	{
	?>
		<fieldset class="left">
			<div class="block">
				<input class="text_input" name="name" type="text" value="<?php _e('Your name', $themename); ?>" placeholder="<?php _e('Your name', $themename); ?>" />
			</div>
			<div class="block">
				<input class="text_input" name="email" type="text" value="<?php _e('Your email', $themename); ?>" placeholder="<?php _e('Your email', $themename); ?>" />
			</div>
			<div class="block">
				<input class="text_input" name="website" type="text" value="<?php _e('Website (optional)', $themename); ?>" placeholder="<?php _e('Website (optional)', $themename); ?>" />
			</div>
		</fieldset>
		<fieldset class="right">
			<div class="block">
				<textarea name="message" placeholder="<?php _e('Message', $themename); ?>"><?php _e('Message', $themename); ?></textarea>
			</div>
			<input name="submit" type="submit" value="<?php _e('Send', $themename); ?>" />
			<a href="#cancel" id="cancel_comment" title="<?php _e('Cancel reply', $themename); ?>"><?php _e('Cancel reply', $themename); ?></a>
			<input type="hidden" name="action" value="theme_comment_form" />
			<input type="hidden" name="comment_parent_id" value="0" />
			<input type="hidden" name="paged" value="1" />
		</fieldset>
	<?php
	}
	?>
		<fieldset>
			<input type="hidden" name="post_id" value="<?php echo esc_attr(get_the_ID()); ?>" />
		</fieldset>
	</form>
</div>
<?php
}
?>