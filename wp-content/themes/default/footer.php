		<?php global $theme_options; ?>
		<div class="footer_container">
			<div class="footer">
				<ul class="footer_banner_box_container clearfix">
					<?php
					if(is_active_sidebar('footer-top'))
						get_sidebar('footer-top');
					?>
				</ul>
				<div class="footer_box_container clearfix">
					<?php
					if(is_active_sidebar('footer-bottom'))
						get_sidebar('footer-bottom');
					?>
				</div>
				<?php if($theme_options["footer_text_left"]!="" || $theme_options["footer_text_right"]!=""): ?>
				<div class="copyright_area">
					<?php if($theme_options["footer_text_left"]!=""): ?>
					<div class="copyright_left">
						<?php echo do_shortcode($theme_options["footer_text_left"]); ?>
					</div>
					<?php 
					endif;
					if($theme_options["footer_text_right"]!=""): ?>
					<div class="copyright_right">
						<?php echo do_shortcode($theme_options["footer_text_right"]); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43828279-1', 'academiainova.com.br');
  ga('send', 'pageview');
</script>
		<?php wp_footer(); ?>

	</body>
</html>