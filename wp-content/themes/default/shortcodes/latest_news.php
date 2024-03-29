<?php
//latest news
function theme_latest_news($atts, $content)
{
	global $themename;
	extract(shortcode_atts(array(
		"count" => 2,
		"category" => "",
		"order" => "DESC"
	), $atts));
	
	query_posts(array( 
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => 2,
		'cat' => $category,
		'order' => $order
	));
	
	$output = '<ul class="blog clearfix">';
	if(have_posts()) : while (have_posts()) : the_post();
		$post_classes = get_post_class("post");
		$output .= '<li class="';
		foreach($post_classes as $key=>$post_class)
			$output .= $post_class . ($key+1<count($post_classes) ? ' ' : '');
		$output .= '">
						<div class="comment_box">
							<div class="first_row">
								' . get_the_time("d") . '<span class="second_row">' . strtoupper(get_the_time("M")) . '</span>
							</div>';
							$comments_count = get_comments_number();
		$output .= '		<a class="comments_number" href="' . get_comments_link() . '" title="' . $comments_count . ($comments_count==1 ? ' ' . __('Comment', $themename) : ' ' . __('Comments', $themename)) . '">' . $comments_count . ($comments_count==1 ? ' ' . __('Comment', $themename) : ' ' . __('Comments', $themename)) . '</a>
						</div>
						<div class="post_content">';
						if(has_post_thumbnail())
							$output .= '<a class="post_image" href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_post_thumbnail(get_the_ID(), "blog-post-thumb", array("alt" => get_the_title(), "title" => "")) . '</a>';
		$output .= '		<h2>
								<a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a>
							</h2>
							<div class="text">
								' . apply_filters('the_excerpt', get_the_excerpt()) . '
							</div>
							<div class="post_footer">
								<ul class="categories">
									<li class="posted_by">' . __('Posted by', $themename) . ' <a class="author" href="' . get_the_author_link() . '" title="' . get_the_author() . '">' . get_the_author() . '</a></li>';
									$categories = get_the_category();
									foreach($categories as $key=>$category)
									{
										$output .= '<li>
											<a href="' . get_category_link($category->term_id ) . '" ';
										if(empty($category->description))
											$output .= 'title="' . sprintf(__('View all posts filed under %s', $themename), $category->name) . '"';
										else
											$output .= 'title="' . esc_attr(strip_tags(apply_filters('category_description', $category->description, $category))) . '"';
										$output .= '>' . $category->name . '</a>
										</li>';
									}
		$output .= '			</ul>
								<a class="more icon_small_arrow margin_right_white" href="' . get_permalink() . '" title="' . __("More", $themename) . '">' . __("More", $themename) . '</a>
							</div>
						</div>
					</li>';
	endwhile; endif;
	$output .= '</ul>';
	
	//Reset Query
	wp_reset_query();
	return $output;
}
add_shortcode("latest_news", "theme_latest_news");
?>
