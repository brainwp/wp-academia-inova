<?php
get_header();
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
		<div class="page_left page_margin_top">
			<?php woocommerce_content(); ?>
		</div>
		<div class="page_right page_margin_top">
			<?php
			if(is_active_sidebar('right'))
				?>
				<ul class="sidebar-right">
				<?php
				get_sidebar('right');
				?>
				</ul>
		</div>
	</div>
</div>
<?php
get_footer(); 
?>