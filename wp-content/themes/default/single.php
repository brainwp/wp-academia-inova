<?php
get_header();
setPostViews(get_the_ID());
?>
<div class="theme_page relative">
	<div class="page_layout clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1><?php the_title(); ?></h1>
				<h4><?php echo get_post_meta(get_the_ID(), $themename. "_subtitle", true); ?></h4>
			</div>
			<div class="page_header_right">
				<?php
				get_sidebar('header');
				?>
			</div>
		</div>
		<ul class="bread_crumb clearfix">
			<!-- <li><?php _e('You are here:', $themename); ?></li> -->
			<li>
				<a href="<?php echo get_home_url(); ?>" title="<?php _e('Home', $themename); ?>">
					<?php _e('Home', $themename); ?>
				</a>
			</li>
			<li class="separator icon_small_arrow right_black">
				&nbsp;
			</li>
			<li>
				<?php the_title(); ?>
			</li>
		</ul>
		<div class="page_left">
			<ul class="blog clearfix">
				<?php
				if(have_posts()) : while (have_posts()) : the_post();
				?>
					<li <?php post_class('class'); ?>>
						<div class="comment_box">
							<div class="first_row">
								<?php the_time("d"); ?><span class="second_row"><?php echo strtoupper(get_the_time("M")); ?></span>
							</div>
							<a class="comments_number" href="<?php comments_link(); ?>" title="<?php comments_number('0 ' . __('Comments', $themename)); ?>">
								<?php comments_number('0 ' . __('Comments', $themename)); ?>
							</a>
						</div>
						<div class="post_content">
							<?php
							if(has_post_thumbnail()):
								$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
								$large_image_url = $attachment_image[0];
							?>
							<a class="post_image fancybox" href="<?php echo $large_image_url; ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail("blog-post-thumb", array("alt" => get_the_title(), "title" => "")); ?>
							</a>
							<?php
							endif;
							?>
							<h2>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>
							<div class="text">
								<?php the_content(); ?>
							</div>
							<div class="post_footer">
								<ul class="categories">
									<li class="posted_by"><?php _e('Posted by', $themename); ?> <a class="author" href="<?php the_author_link(); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a></li>
									<?php
									$categories = get_the_category();
									foreach($categories as $key=>$category)
									{
										?>
										<li>
											<a href="<?php echo get_category_link($category->term_id ); ?>" title="<?php echo (empty($category->description) ? sprintf(__('View all posts filed under %s', $themename), $category->name) : esc_attr(strip_tags(apply_filters('category_description', $category->description, $category)))); ?>">
												<?php echo $category->name; ?>
											</a>
										</li>
									<?php
									}
									?>
								</ul>
							</div>
						</div>
					</li>
				<?php
				endwhile; endif;
				?>
			</ul>
			<?php
			comments_template();
			require_once("comments-form.php");
			?>
		</div>
		<div class="page_right">
			<?php
			if(is_active_sidebar('blog'))
				get_sidebar('blog');
			?>
		</div>
	</div>
</div>
<?php
get_footer(); 
?>